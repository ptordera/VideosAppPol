<?php
use App\Models\Team;
function createDefaultUser()
{
    // Crear usuario con datos predeterminados
    $user = \App\Models\User::create([
        'name' => env('DEFAULT_USER_NAME'),
        'email' => env('DEFAULT_USER_EMAIL'),
        'password' => bcrypt(env('DEFAULT_USER_PASSWORD')),
    ]);

    // Crear un equipo por defecto y asociarlo al usuario
    $team = Team::create([
        'name' => 'Default Team',
        'user_id' => $user->id,  // Asegúrate de asignar el user_id
    ]);

    // Asociar el equipo al usuario (esto es opcional si ya lo asociamos en la creación del equipo)
    $user->team()->associate($team);
    $user->save();

    return $user;
}

function createDefaultTeacher()
{
    // Crear profesor con datos predeterminados
    $teacher = \App\Models\User::create([
        'name' => env('DEFAULT_TEACHER_NAME'),
        'email' => env('DEFAULT_TEACHER_EMAIL'),
        'password' => bcrypt(env('DEFAULT_TEACHER_PASSWORD')),
    ]);

    // Crear un equipo por defecto y asociarlo al profesor
    $team = Team::create([
        'name' => 'Default Teacher Team',
        'user_id' => $teacher->id,  // Asegúrate de asignar el user_id
    ]);

    // Asociar el equipo al profesor (esto es opcional si ya lo asociamos en la creación del equipo)
    $teacher->team()->associate($team);
    $teacher->save();

    return $teacher;
}
