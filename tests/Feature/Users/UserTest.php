<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_without_permissions_can_see_default_users_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('users.index'));

        $response->assertStatus(200);
    }

    public function test_user_with_permissions_can_see_default_users_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('users.index'));

        $response->assertStatus(200);
    }

    public function test_not_logged_users_cannot_see_default_users_page()
    {
        $response = $this->get(route('users.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_user_without_permissions_can_see_user_show_page()
    {
        $user = User::factory()->create();
        $userToShow = User::factory()->create();
        $response = $this->actingAs($user)->get(route('users.show', $userToShow->id));

        $response->assertStatus(200);
    }

    public function test_user_with_permissions_can_see_user_show_page()
    {
        $user = User::factory()->create();
        $userToShow = User::factory()->create();
        $response = $this->actingAs($user)->get(route('users.show', $userToShow->id));

        $response->assertStatus(200);
    }

    public function test_not_logged_users_cannot_see_user_show_page()
    {
        $userToShow = User::factory()->create();

        $response = $this->get(route('users.show', $userToShow->id));

        $response->assertRedirect(route('login'));
    }
}
