<?php

namespace Tests\Feature\Users;

use App\Helpers\UserHelpers;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        (new \App\Helpers\UserHelpers)->create_permissions();
    }

    public function test_user_with_permissions_can_manage_users()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $user3 = User::factory()->create();

        $superAdmin = $this->loginAsSuperAdmin();

        $response = $this->actingAs($superAdmin)->get(route('users.manage.index'));

        $response->assertStatus(200);

        $response->assertSee($user1->name);
        $response->assertSee($user2->name);
        $response->assertSee($user3->name);
    }

    public function test_regular_users_cannot_manage_users()
    {
        $regularUser = $this->loginAsRegularUser();

        $response = $this->actingAs($regularUser)->get(route('users.manage.index'));

        $response->assertStatus(403);
    }

    public function test_guest_users_cannot_manage_users()
    {
        $response = $this->get(route('users.manage.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_superadmins_can_manage_users()
    {
        $superAdmin = $this->loginAsSuperAdmin();

        $response = $this->actingAs($superAdmin)->get(route('users.manage.index'));

        $response->assertStatus(200);
    }

    public function test_user_with_permissions_can_see_add_users()
    {
        $superAdmin = $this->loginAsSuperAdmin();

        $response = $this->actingAs($superAdmin)->get(route('users.manage.create'));

        $response->assertStatus(200);
    }

    public function test_user_without_permissions_cannot_see_add_users()
    {
        $regularUser = $this->loginAsRegularUser();

        $response = $this->actingAs($regularUser)->get(route('users.manage.create'));

        $response->assertStatus(403);
    }

    public function test_user_with_permissions_can_store_users()
    {
        $userData = [
            'name' => 'Nuevo Usuario',
            'email' => 'nuevo@usuario.com',
            'password' => 'password123',
        ];

        $superAdmin = $this->loginAsSuperAdmin();

        $response = $this->actingAs($superAdmin)->post(route('users.manage.store'), $userData);

        $response->assertStatus(302);
        $response->assertRedirect(route('users.manage.index'));

        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'email' => $userData['email'],
        ]);
    }

    public function test_user_without_permissions_cannot_store_users()
    {
        $userData = [
            'name' => 'Nuevo Usuario',
            'email' => 'nuevo@usuario.com',
            'password' => 'password123',
        ];

        $regularUser = $this->loginAsRegularUser();

        $response = $this->actingAs($regularUser)->post(route('users.manage.store'), $userData);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('users', [
            'name' => $userData['name'],
            'email' => $userData['email'],
        ]);
    }

    public function test_user_with_permissions_can_destroy_users()
    {
        $superAdmin = $this->loginAsSuperAdmin();

        $user = User::factory()->create();

        $response = $this->actingAs($superAdmin)->delete(route('users.manage.destroy', $user->id));

        $response->assertRedirect(route('users.manage.index'));

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    public function test_user_without_permissions_cannot_destroy_users()
    {
        $regularUser = $this->loginAsRegularUser();

        $user = User::factory()->create();

        $response = $this->actingAs($regularUser)->delete(route('users.manage.destroy', $user->id));

        $response->assertStatus(403);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);
    }

    public function test_user_with_permissions_can_see_edit_users()
    {
        $superAdmin = $this->loginAsSuperAdmin();

        $user = User::factory()->create();

        $response = $this->actingAs($superAdmin)->get(route('users.manage.edit', $user->id));

        $response->assertStatus(200);
        $response->assertSee($user->name);
    }

    public function test_user_without_permissions_cannot_see_edit_users()
    {
        $regularUser = $this->loginAsRegularUser();

        $user = User::factory()->create();

        $response = $this->actingAs($regularUser)->get(route('users.manage.edit', $user->id));

        $response->assertStatus(403);
    }

    public function test_user_with_permissions_can_update_users()
    {
        $superAdmin = $this->loginAsSuperAdmin();

        $user = User::factory()->create();

        $response = $this->actingAs($superAdmin)->put(route('users.manage.update', $user->id), [
            'name' => 'Nombre actualizado',
            'email' => 'actualizado@usuario.com',
            'password' => 'newpassword123',
        ]);

        $response->assertStatus(302);

        $updatedUser = User::find($user->id);
        $this->assertEquals('Nombre actualizado', $updatedUser->name);
        $this->assertEquals('actualizado@usuario.com', $updatedUser->email);
    }

    public function test_user_without_permissions_cannot_update_users()
    {
        $regularUser = $this->loginAsRegularUser();

        $user = User::factory()->create();

        $response = $this->actingAs($regularUser)->put(route('users.manage.update', $user->id), [
            'name' => 'Nombre actualizado',
            'email' => 'actualizado@usuario.com',
            'password' => 'newpassword123',
        ]);

        $response->assertStatus(403);

        $updatedUser = User::find($user->id);
        $this->assertNotEquals('Nombre actualizado', $updatedUser->name);
        $this->assertNotEquals('actualizado@usuario.com', $updatedUser->email);
    }

    private function loginAsSuperAdmin()
    {
        $user = (new \App\Helpers\UserHelpers)->create_superadmin_user();
        $user->save();

        $user->assignRole('super_admin');
        return $user;
    }

    private function loginAsRegularUser()
    {
        $user = (new \App\Helpers\UserHelpers)->create_regular_user();
        $user->save();

        $user->assignRole('regular');
        return $user;
    }
}
