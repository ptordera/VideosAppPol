<?php

namespace Tests\Unit;

use App\Models\Videos;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class VideosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_formatted_published_at_date()
    {
        // Arrange: Crear un video amb una data de publicació coneguda
        $video = Videos::create([
            'title' => 'Video 1',
            'description' => 'Description 1',
            'url' => 'https://www.youtube.com/watch?v=video1',
            'published_at' => Carbon::create(2025, 1, 21),
        ]);

        // Act: Obtenir el format de la data publicada
        $formattedDate = $video->getFormattedPublishedAtAttribute();

        // Assert: Verificar que el format de la data és el que esperem
        $this->assertEquals('21 Jan 2025', $formattedDate);
    }

    /** @test */
    public function can_get_formatted_published_at_date_when_not_published()
    {
        // Arrange: Crear un video sense data de publicació
        $video = Videos::create([
            'title' => 'Video 2',
            'description' => 'Description 2',
            'url' => 'https://www.youtube.com/watch?v=video2',
            'published_at' => null,
        ]);

        // Act: Obtenir el format de la data publicada quan no hi ha data
        $formattedDate = $video->getFormattedPublishedAtAttribute();

        // Assert: Verificar que el format es buit o no ha de retornar cap valor
        $this->assertNull($formattedDate);
    }
}
