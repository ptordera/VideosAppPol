<?php

namespace Database\Seeders;

use App\Helpers\DefaultVideosHelper;
use App\Models\User;
use App\Models\Videos;
use App\Helpers\UserHelpers;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
//    public function run(): void
//    {
//        // Crear usuaris per defecte
//        User::create([
//            'name' => 'Admin User',
//            'email' => 'admin@example.com',
//            'password' => bcrypt('Admin1234'),
//        ]);
//
//        User::create([
//            'name' => 'Regular User',
//            'email' => 'user@example.com',
//            'password' => bcrypt('User1234'),
//        ]);
//
//        // Crear vídeos per defecte
//        Videos::create([
//            'title' => 'Video 1',
//            'description' => 'Descripció del primer video',
//            'url' => 'http://default.url/video-1',
//            'published_at' => now(),
//            'previous' => null,
//            'next' => null,
//            'series_id' => null,
//        ]);
//
//        Videos::create([
//            'title' => 'Video 2',
//            'description' => 'Descripció del segon video',
//            'url' => 'http://default.url/video-2',
//            'published_at' => now(),
//            'previous' => null,
//            'next' => null,
//            'series_id' => null,
//        ]);
//    }

    public function run(): void
    {

        UserHelpers::createDefaultUser();
        UserHelpers::createDefaultTeacher();
        DefaultVideosHelper::createDefaultVideo();
    }
}
