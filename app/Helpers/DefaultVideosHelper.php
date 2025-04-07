<?php

namespace App\Helpers;

use App\Models\User;
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

        $defaultUserId = User::first()->id ?? User::factory()->create()->id;

        $defaultData = [
            'title' => 'Video per defecte',
            'description' => 'Descripció del video per defecte.',
            'url' => 'https://youtu.be/a-4923Uyu54',
            'published_at' => Carbon::now()->toDateTimeString(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
            'user_id' => $defaultUserId,
        ];

        // Sobrescribir valores si se pasan en el array
        $data = array_merge($defaultData, $overrides);

        // Crear y devolver el video
        return Videos::create($data);
    }

    public static function createDefaultVideo2(array $overrides = [])
    {

        $defaultUserId = User::first()->id ?? User::factory()->create()->id;

        $defaultData = [
            'title' => 'Video per defecte 2',
            'description' => 'Descripció del video per defecte 2.',
            'url' => 'https://youtu.be/PGQxIILBb7M',
            'published_at' => Carbon::now()->toDateTimeString(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
            'user_id' => $defaultUserId,
        ];

        // Sobrescribir valores si se pasan en el array
        $data = array_merge($defaultData, $overrides);

        // Crear y devolver el video
        return Videos::create($data);
    }

    public static function createDefaultVideo3(array $overrides = [])
    {
        $defaultUserId = User::first()->id ?? User::factory()->create()->id;

        $defaultData = [
            'title' => 'Video per defecte 3',
            'description' => 'Descripció del video per defecte 3.',
            'url' => 'https://youtu.be/_sw61Ew1FHQ',
            'published_at' => Carbon::now()->toDateTimeString(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
            'user_id' => $defaultUserId,
        ];

        // Sobrescribir valores si se pasan en el array
        $data = array_merge($defaultData, $overrides);

        // Crear y devolver el video
        return Videos::create($data);
    }
}
