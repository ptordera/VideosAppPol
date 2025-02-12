<?php

namespace Tests\Feature\Videos;

use App\Models\Videos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_can_view_videos()
    {
        // Arrange: Crear un video per a que estigui disponible
        $video = Videos::create([
            'title' => 'Video de prueba',
            'description' => 'Descripción del video',
            'url' => 'https://www.youtube.com/watch?v=video1',
            'published_at' => now(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
        ]);

        // Act: Realitzar la petición per a veure el video
        $response = $this->get(route('videos.show', $video->id));

        // Assert: Verificar que la respuesta sea exitosa y contenga los datos del video
        $response->assertStatus(200);
        $response->assertSee($video->title);
        $response->assertSee($video->description);
    }

    /** @test */
    public function users_cannot_view_not_existing_videos()
    {
        // Arrange: Definir un ID de video que no existeix
        $nonExistentVideoId = 99999;

        // Act: Realizar la petición para ver el video
        $response = $this->get(route('videos.show', $nonExistentVideoId));

        // Assert: Verificar que la resposta sigui un error 404
        $response->assertStatus(404);
    }
}
