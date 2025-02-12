<?php

namespace Tests\Feature\Videos;

use App\Helpers\DefaultVideosHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DefaultVideosHelperTest extends TestCase
{
    use RefreshDatabase; // Ens assegurem que la base de dades es reinicia després de cada prova

    /**
     * Testa la creació d'un video per defecte.
     *
     * @return void
     */
    public function test_create_default_video()
    {
        // Crear un video per defecte usant el helper
        $video = DefaultVideosHelper::createDefaultVideo();

        // Verificar que el video es crea correctament a la base de dades
        $this->assertDatabaseHas('videos', [
            'title' => 'Video per defecte',
            'description' => 'Descripció del video per defecte.',
            'url' => 'http://default.url/video-defecte',
        ]);

        // Verificar que el model retornat té els mateixos valors
        $this->assertEquals('Video per defecte', $video->title);
        $this->assertEquals('Descripció del video per defecte.', $video->description);
        $this->assertEquals('http://default.url/video-defecte', $video->url);
    }
}
