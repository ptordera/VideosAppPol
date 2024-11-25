<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class HelperTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_create_default_user_and_professor()
    {
        // Arrange: Crear un equip per assignar-lo a l'usuari
        $team = Team::factory()->create();

        // Act: Crear usuaris amb l'equip
        $defaultUser = $this->createDefaultUser($team);
        $professorUser = $this->createProfessorUser($team);

        // Assert: Comprovar que els usuaris es creen correctament
        $this->assertNotNull($defaultUser);
        $this->assertNotNull($professorUser);

        $this->assertTrue(Hash::check('password123', $defaultUser->password));
        $this->assertTrue(Hash::check('password123', $professorUser->password));

        $this->assertEquals($team->id, $defaultUser->current_team_id);  // Comprovar que el team ID és correcte
        $this->assertEquals($team->id, $professorUser->current_team_id); // Comprovar que el team ID és correcte
    }

    private function createDefaultUser(Team $team)
    {
        // Crear l'usuari amb el team assignat
        return User::create([
            'name' => config('users.default_user.name'),
            'email' => config('users.default_user.email'),
            'password' => Hash::make(config('users.default_user.password')),
            'current_team_id' => $team->id,  // Assignar l'ID del team
        ]);
    }

    private function createProfessorUser(Team $team)
    {
        // Crear l'usuari professor amb el team assignat
        return User::create([
            'name' => config('users.default_teacher.name'),
            'email' => config('users.default_teacher.email'),
            'password' => Hash::make(config('users.default_teacher.password')),
            'current_team_id' => $team->id,  // Assignar l'ID del team
        ]);
    }
}
