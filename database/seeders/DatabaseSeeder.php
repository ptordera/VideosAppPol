<?php

namespace Database\Seeders;

use App\Helpers\DefaultVideosHelper;
use App\Helpers\SeriesHelper;
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

    public function run(): void
    {
        // Crear permisos i rols
        (new \App\Helpers\UserHelpers)->create_permissions();

        $superAdmin = (new \App\Helpers\UserHelpers)->create_superadmin_user();
        $superAdmin->save();
        $regularUser = (new \App\Helpers\UserHelpers)->create_regular_user();
        $regularUser->save();
        $videoManager = (new \App\Helpers\UserHelpers)->create_video_manager_user();
        $videoManager->save();
        $defaultUser = (new \App\Helpers\UserHelpers)->createDefaultUser();
        $defaultUser->save();
        $defaultTeacher = (new \App\Helpers\UserHelpers)->createDefaultTeacher();
        $defaultTeacher->save();


        // Assignar rols als usuaris
        $superAdmin->assignRole('super_admin');
        $regularUser->assignRole('regular');
        $videoManager->assignRole('video_manager');
        $defaultUser->assignRole('regular');
        $defaultTeacher->assignRole('super_admin');

        SeriesHelper::createDefaultSerie1();
        SeriesHelper::createDefaultSerie2();
        SeriesHelper::createDefaultSerie3();

        DefaultVideosHelper::createDefaultVideo();
        DefaultVideosHelper::createDefaultVideo2();
        DefaultVideosHelper::createDefaultVideo3();

        // Definir portes d'accés (Gates)
        (new \App\Helpers\UserHelpers)->define_gates();
    }
}
