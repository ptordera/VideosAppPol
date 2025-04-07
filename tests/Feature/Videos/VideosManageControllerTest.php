<?php

namespace Tests\Feature\Videos;

use App\Helpers\DefaultVideosHelper;
use App\Models\User;
use App\Models\Videos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;
use App\Helpers\UserHelpers;  // Agregar esta línea para importar UserHelpers

class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase;

    // Ejecutar create_permissions() antes de cada prueba
    public function setUp(): void
    {
        parent::setUp();
        (new \App\Helpers\UserHelpers)->create_permissions();
    }

    public function test_user_with_permissions_can_manage_videos()
    {
        $video1 = (new DefaultVideosHelper())->createDefaultVideo();
        $video2 = (new DefaultVideosHelper())->createDefaultVideo();
        $video3 = (new DefaultVideosHelper())->createDefaultVideo();

        $videoManager = $this->loginAsVideoManager();

        $response = $this->actingAs($videoManager)->get(route('videos.manage.index'));

        $response->assertStatus(200);

        $response->assertSee($video1->title);
        $response->assertSee($video2->title);
        $response->assertSee($video3->title);
    }

    public function test_regular_users_cannot_manage_videos()
    {
        $regularUser = $this->loginAsRegularUser();

        $response = $this->actingAs($regularUser)->get(route('videos.manage.index'));

        $response->assertStatus(403); // Forbidden
    }

    public function test_guest_users_cannot_manage_videos()
    {
        $response = $this->get(route('videos.manage.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_superadmins_can_manage_videos()
    {
        $superAdmin = $this->loginAsSuperAdmin();

        $response = $this->actingAs($superAdmin)->get(route('videos.manage.index'));

        $response->assertStatus(200);
    }

    // Funciones de login para cada tipo de usuario
    private function loginAsVideoManager()
    {
        $user = (new UserHelpers)->create_video_manager_user();
        $user->save();

        // Asignar rol video_manager
        $user->assignRole('video_manager');

        return $user;
    }

    private function loginAsSuperAdmin()
    {
        $user = (new UserHelpers)->create_superadmin_user();
        $user->save();

        // Asignar rol super_admin
        $user->assignRole('super_admin');
        return $user;
    }

    private function loginAsRegularUser()
    {
        $user = (new UserHelpers)->create_regular_user();
        $user->save();

        // Asignar rol regular
        $user->assignRole('regular');
        return $user;
    }

    public function manage()
    {
        if (auth()->user()->can('manage-videos')) {
            return view('videos.manage');
        }

        abort(403, 'No tens permisos per gestionar vídeos');
    }

    public function test_user_with_permissions_can_see_add_videos()
    {
        $videoManager = $this->loginAsVideoManager();

        $response = $this->actingAs($videoManager)->get(route('videos.manage.create'));

        $response->assertStatus(200);
    }

    public function test_user_without_permissions_cannot_see_add_videos()
    {
        $regularUser = $this->loginAsRegularUser();

        $response = $this->actingAs($regularUser)->get(route('videos.manage.create'));

        $response->assertStatus(403);
    }

    public function test_user_with_permissions_can_store_videos()
    {
        $videoData = [
            'title' => 'Nou Video de Prova',
            'description' => 'Descripció del vídeo de prova.',
            'url' => 'https://www.youtube.com/watch?v=example',
            'published_at' => now(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
        ];

        $videoManager = $this->loginAsVideoManager();

        $response = $this->actingAs($videoManager)->post(route('videos.manage.store'), $videoData);

        $response->assertStatus(302);
        $response->assertRedirect(route('videos.manage.index'));

        $this->assertDatabaseHas('videos', [
            'title' => $videoData['title'],
            'description' => $videoData['description'],
            'url' => $videoData['url'],
        ]);
    }

    public function test_user_without_permissions_cannot_store_videos()
    {
        $videoData = [
            'title' => 'Nou Video de Prova',
            'description' => 'Descripció del vídeo de prova.',
            'url' => 'https://www.youtube.com/watch?v=example',
            'published_at' => now(),
        ];

        $regularUser = $this->loginAsRegularUser();

        $response = $this->actingAs($regularUser)->post(route('videos.manage.store'), $videoData);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('videos', [
            'title' => $videoData['title'],
            'description' => $videoData['description'],
            'url' => $videoData['url'],
        ]);
    }

    public function test_user_with_permissions_can_destroy_videos()
    {
        $video = Videos::create([
            'title' => 'Video de prova',
            'description' => 'Descripció del vídeo de prova.',
            'url' => 'https://www.youtube.com/watch?v=example',
            'published_at' => now(),
        ]);

        $videoManager = $this->loginAsVideoManager();

        $response = $this->actingAs($videoManager)->delete(route('videos.manage.destroy', $video->id));

        $response->assertRedirect(route('videos.manage.index'));

        $this->assertDatabaseMissing('videos', [
            'id' => $video->id,
        ]);
    }

    public function test_user_without_permissions_cannot_destroy_videos()
    {

        $videoManager = $this->loginAsVideoManager();

        $video = Videos::create([
            'title' => 'Video de prova',
            'description' => 'Descripció del vídeo de prova.',
            'url' => 'https://www.youtube.com/watch?v=example',
            'published_at' => now(),
            'user_id' => $videoManager->id,
        ]);

        $regularUser = $this->loginAsRegularUser();

        $response = $this->actingAs($regularUser)->delete(route('videos.manage.destroy', $video->id));

        $response->assertStatus(403);

        $this->assertDatabaseHas('videos', [
            'id' => $video->id,
        ]);
    }

    public function test_user_with_permissions_can_see_edit_videos()
    {
        // Crear un vídeo de prova
        $video = Videos::create([
            'title' => 'Video de prova',
            'description' => 'Descripció del vídeo de prova.',
            'url' => 'https://www.youtube.com/watch?v=example',
            'published_at' => now(),
        ]);

        // Login com a usuari amb permisos per gestionar vídeos
        $videoManager = $this->loginAsVideoManager();

        // Fer la petició GET per accedir a la pàgina d'editar el vídeo
        $response = $this->actingAs($videoManager)->get(route('videos.manage.edit', $video->id));

        // Assert que la resposta sigui correcta
        $response->assertStatus(200);

        // Verificar que la pàgina d'editar vídeo conté el títol del vídeo
        $response->assertSee($video->title);
    }

    public function test_user_without_permissions_cannot_see_edit_videos()
    {
        // Crear un vídeo de prova
        $video = Videos::create([
            'title' => 'Video de prova',
            'description' => 'Descripció del vídeo de prova.',
            'url' => 'https://www.youtube.com/watch?v=example',
            'published_at' => now(),
        ]);

        // Login com a usuari sense permisos per gestionar vídeos
        $regularUser = $this->loginAsRegularUser();

        // Fer la petició GET per accedir a la pàgina d'editar el vídeo
        $response = $this->actingAs($regularUser)->get(route('videos.manage.edit', $video->id));

        // Assert que la resposta sigui 403 (Forbidden), ja que l'usuari no té permisos
        $response->assertStatus(403);
    }

    public function test_user_with_permissions_can_update_videos()
    {
        // Crear un vídeo de prova
        $video = Videos::create([
            'title' => 'Video de prova',
            'description' => 'Descripció del vídeo de prova.',
            'url' => 'https://www.youtube.com/watch?v=example',
            'published_at' => now(),

        ]);

        // Login com a usuari amb permisos per gestionar vídeos (per exemple, un 'video_manager')
        $videoManager = $this->loginAsVideoManager();

        // Fer la petició PUT per actualitzar el vídeo
        $response = $this->actingAs($videoManager)->put(route('videos.manage.update', $video->id), [
            'title' => 'Títol actualitzat',
            'description' => 'Descripció actualitzada del vídeo.',
            'url' => 'https://www.youtube.com/watch?v=updatedexample',
            'published_at' => now(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
        ]);

        // Assert que la resposta sigui correcta
        $response->assertStatus(302); // Redirecció després d'una actualització exitosa

        // Assert que el vídeo s'ha actualitzat correctament a la base de dades
        $updatedVideo = Videos::find($video->id);
        $this->assertEquals('Títol actualitzat', $updatedVideo->title);
        $this->assertEquals('Descripció actualitzada del vídeo.', $updatedVideo->description);
        $this->assertEquals('https://www.youtube.com/watch?v=updatedexample', $updatedVideo->url);
    }

    public function test_user_without_permissions_cannot_update_videos()
    {
        // Crear un vídeo de prova
        $video = Videos::create([
            'title' => 'Video de prova',
            'description' => 'Descripció del vídeo de prova.',
            'url' => 'https://www.youtube.com/watch?v=example',
            'published_at' => now(),
        ]);

        // Login com a usuari sense permisos per gestionar vídeos (per exemple, un usuari regular)
        $regularUser = $this->loginAsRegularUser();

        // Fer la petició PUT per intentar actualitzar el vídeo
        $response = $this->actingAs($regularUser)->put(route('videos.manage.update', $video->id), [
            'title' => 'Títol actualitzat',
            'description' => 'Descripció actualitzada del vídeo.',
            'url' => 'https://www.youtube.com/watch?v=updatedexample',
            'published_at' => now(),
        ]);

        // Assert que la resposta sigui un error 403 (Forbidden)
        $response->assertStatus(403);

        // Assert que el vídeo no ha estat actualitzat
        $updatedVideo = Videos::find($video->id);
        $this->assertEquals('Video de prova', $updatedVideo->title);
        $this->assertEquals('Descripció del vídeo de prova.', $updatedVideo->description);
        $this->assertEquals('https://www.youtube.com/watch?v=example', $updatedVideo->url);
    }


}
