<?php

namespace Tests\Unit;

use App\Helpers\DefaultVideosHelper;
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
        // Arrange: Crear equipos separados para cada usuario
        $teamForDefaultUser = Team::factory()->create();
        $teamForProfessorUser = Team::factory()->create();

        // Act: Crear usuarios utilizando helpers
        $defaultUser = $this->createUserFromConfig('users.default_user', $teamForDefaultUser);
        $professorUser = $this->createUserFromConfig('users.default_teacher', $teamForProfessorUser);

        // Assert: Verificar que los usuarios se crean correctamente
        $this->assertNotNull($defaultUser);
        $this->assertNotNull($professorUser);

        $this->assertTrue(Hash::check(config('users.default_user.password'), $defaultUser->password));
        $this->assertTrue(Hash::check(config('users.default_teacher.password'), $professorUser->password));

        $this->assertEquals($teamForDefaultUser->id, $defaultUser->current_team_id);
        $this->assertEquals($teamForProfessorUser->id, $professorUser->current_team_id);
    }

    private function createUserFromConfig(string $configKey, Team $team)
    {
        // Crear un usuario basado en configuraciones
        $config = config($configKey);

        return User::create([
            'name' => $config['name'],
            'email' => $config['email'],
            'password' => Hash::make($config['password']),
            'current_team_id' => $team->id,
        ]);
    }

    public function test_create_default_video()
    {
        // Crear un video per defecte usant el helper
        $video = DefaultVideosHelper::createDefaultVideo();

        // Verificar que el video es crea correctament a la base de dades
        $this->assertDatabaseHas('videos', [
            'title' => 'Video per defecte',
            'description' => 'Descripció del video per defecte.',
            'url' => 'https://youtu.be/a-4923Uyu54',
        ]);

        // Verificar que el model retornat té els mateixos valors
        $this->assertEquals('Video per defecte', $video->title);
        $this->assertEquals('Descripció del video per defecte.', $video->description);
        $this->assertEquals('https://youtu.be/a-4923Uyu54', $video->url);
    }
}

