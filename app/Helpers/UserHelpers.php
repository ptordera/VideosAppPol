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

        $user->save();

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

        $teacher->save();

        // Crear un equipo único y asociarlo al profesor
        $team = Team::factory()->create(['user_id' => $teacher->id]);

        // Asignar el equipo como el equipo actual del profesor
        $teacher->current_team_id = $team->id;
        $teacher->save();

        (new \App\Helpers\UserHelpers) -> add_personal_team($teacher, 'Default Team');

        return $teacher;
    }

    public function add_personal_team(User $user, string $teamName)
    {
        $user->save();

        // Crear un equipo personal y asociarlo al usuario
        $team = Team::create([
            'name' => $teamName,
            'user_id' => $user->id,
            'personal_team' => true,
        ]);

        // Asignar el equipo como el equipo actual del usuario
        $user->current_team_id = $team->id;
        $user->save();
    }

    function create_regular_user() {
        $regularUser = \App\Models\User::create([
            'name' => 'Regular',
            'email' => 'regular@videosapp.com',
            'password' => Hash::make('123456789') // Usar Hash::make
        ]);

        $team = Team::factory()->create(['user_id' => $regularUser->id]);

        // Asignar el equipo como el equipo actual del profesor
        $regularUser->current_team_id = $team->id;
        $regularUser->save();

        (new \App\Helpers\UserHelpers) -> add_personal_team($regularUser, 'Default Team');

        return $regularUser;
    }

    function create_video_manager_user()
    {
        $videoManager = User::create([
            'name' => 'Video Manager',
            'email' => 'videosmanager@videosapp.com',
            'password' => Hash::make('123456789'), // Usar Hash::make
        ]);

        $team = Team::factory()->create(['user_id' => $videoManager->id]);

        $videoManager->current_team_id = $team->id;
        $videoManager->save();

        (new \App\Helpers\UserHelpers) -> add_personal_team($videoManager, 'Default Team');

        return $videoManager;
    }

    function create_superadmin_user()
    {
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@videosapp.com',
            'password' => Hash::make('123456789'), // Usar Hash::make
            'super_admin' => true,
        ]);

        $team = Team::factory()->create(['user_id' => $superAdmin->id]);

        $superAdmin->current_team_id = $team->id;
        $superAdmin->save();

        (new \App\Helpers\UserHelpers) -> add_personal_team($superAdmin, 'Default Team');

        return $superAdmin;
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
            'manage-videos',
            'manage-users',
            'manage-series',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $roles = [
            'regular' => [],
            'video_manager' => ['manage-videos'],
            'super_admin' => Permission::pluck('name')->toArray(),
        ];

        foreach ($roles as $role => $perms) {
            $roleInstance = Role::firstOrCreate(['name' => $role]);
            $roleInstance->syncPermissions($perms);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $superAdmin->syncPermissions(Permission::all());
    }

}
