<?php

namespace Tests\Feature;

use App\Events\VideoCreated;
use App\Models\User;
use App\Notifications\VideoCreatedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use App\Helpers\DefaultVideosHelper;
class VideoNotificationsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Comprova que l'event VideoCreated es dispara quan es crea un vídeo.
     *
     * @return void
     */
    public function test_video_created_event_is_dispatched()
    {
        // Mock de l'event
        Event::fake();

        $video = DefaultVideosHelper::createDefaultVideo();

        Event::assertDispatched(VideoCreated::class, function ($event) use ($video) {
            return $event->video->id === $video->id;
        });
    }

    /**
     * Comprova que s'envia una notificació push quan es crea un vídeo.
     *
     * @return void
     */
    public function test_push_notification_is_sent_when_video_is_created()
    {
        Notification::fake();

        $admin = User::factory()->create([
            'super_admin' => true
        ]);

        $video = DefaultVideosHelper::createDefaultVideo();

        event(new VideoCreated($video));

        Notification::assertSentTo(
            $admin,
            VideoCreatedNotification::class,
            function ($notification, $channels) use ($video) {
                return $notification->video->id === $video->id;
            }
        );
    }
}
