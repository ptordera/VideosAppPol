<?php

namespace App\Helpers;

use App\Models\Videos;
use Carbon\Carbon;

class DefaultVideosHelper
{
    /**
     * Crear un video por defecto
     *
     * @param array $overrides
     * @return Videos
     */
    public static function createDefaultVideo(array $overrides = [])
    {
        // Establecer valores por defecto
        $defaultData = [
            'title' => 'Video per defecte',
            'description' => 'Descripció del video per defecte.',
            'url' => 'http://default.url/video-defecte',
            'published_at' => Carbon::now()->toDateTimeString(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
        ];

        // Sobrescribir valores si se pasan en el array
        $data = array_merge($defaultData, $overrides);

        // Crear y devolver el video
        return Videos::create($data);
    }
}
