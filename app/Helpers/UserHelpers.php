<?php
namespace App\Helpers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Ya importado correctamente
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;

class UserHelpers {

    public static function createDefaultUser()
    {
        // Crear usuario con datos de configuración
        $user = User::create([
            'name' => config('users.default_user.name'),
            'email' => config('users.default_user.email'),
            'password' => Hash::make(config('users.default_user.password')), // Usar Hash::make
        ]);

        (new \App\Helpers\UserHelpers) -> add_personal_team($user, 'Default Team');

        return $user;
    }

    public static function createDefaultTeacher()
    {
        // Crear profesor con datos de configuración
        $teacher = User::create([
            'name' => config('users.default_teacher.name'),
            'email' => config('users.default_teacher.email'),
            'password' => Hash::make(config('users.default_teacher.password')), // Usar Hash::make
            'super_admin' => true,
        ]);

        // Crear un equipo único y asociarlo al profesor
        $team = Team::factory()->create(['user_id' => $teacher->id]);

        // Asignar el equipo como el equipo actual del profesor
        $teacher->current_team_id = $team->id;
        $teacher->save();

        (new \App\Helpers\UserHelpers) -> add_personal_team($teacher, 'Default Team');

        return $teacher;
    }

    public function add_personal_team(User $user, string $teamName): void
    {
        // Crear un equipo personal y asociarlo al usuario
        $team = Team::create([
            'name' => $teamName,
            'user_id' => $user->id,
        ]);

        // Asignar el equipo como el equipo actual del usuario
        $user->team()->associate($team);
        $user->save();
    }

    function create_regular_user() {
        return \App\Models\User::create([
            'name' => 'Regular',
            'email' => 'regular@videosapp.com',
            'password' => Hash::make('123456789') // Usar Hash::make
        ]);
    }

    function create_video_manager_user()
    {
        $user = User::create([
            'name' => 'Video Manager',
            'email' => 'videosmanager@videosapp.com',
            'password' => Hash::make('123456789'), // Usar Hash::make
        ]);
        return $user;
    }

    function create_superadmin_user()
    {
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@videosapp.com',
            'password' => Hash::make('123456789'), // Usar Hash::make
            'super_admin' => true,
        ]);
        return $user;
    }

    function define_gates()
    {
        Gate::define('manage-videos', function (\App\Models\User $user) {
            return $user->hasRole('video_manager') || $user->isSuperAdmin();
        });

        Gate::define('manage-users', function (\App\Models\User $user) {
            return $user->isSuperAdmin();
        });
    }

    function create_permissions()
    {
        $permissions = [
            'create videos',
            'edit videos',
            'delete videos',
            'manage users'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $roles = [
            'regular' => [],
            'video_manager' => ['create videos', 'edit videos', 'delete videos'],
            'super_admin' => Permission::pluck('name')->toArray(),
        ];

        foreach ($roles as $role => $perms) {
            $roleInstance = Role::firstOrCreate(['name' => $role]);
            $roleInstance->syncPermissions($perms);
        }
    }

}
