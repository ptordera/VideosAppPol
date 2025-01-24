<?php
namespace App\Helpers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserHelpers {

    public static function createDefaultUser()
    {
        // Crear usuario con datos de configuración
        $user = User::create([
            'name' => config('users.default_user.name'),
            'email' => config('users.default_user.email'),
            'password' => Hash::make(config('users.default_user.password')),
        ]);

        // Crear un equipo único y asociarlo al usuario
        $team = Team::factory()->create(['user_id' => $user->id]);

        // Asignar el equipo como el equipo actual del usuario
        $user->current_team_id = $team->id;
        $user->save();

        return $user;
    }

    public static function createDefaultTeacher()
    {
        // Crear profesor con datos de configuración
        $teacher = User::create([
            'name' => config('users.default_teacher.name'),
            'email' => config('users.default_teacher.email'),
            'password' => Hash::make(config('users.default_teacher.password')),
        ]);

        // Crear un equipo único y asociarlo al profesor
        $team = Team::factory()->create(['user_id' => $teacher->id]);

        // Asignar el equipo como el equipo actual del profesor
        $teacher->current_team_id = $team->id;
        $teacher->save();

        return $teacher;
    }

}
