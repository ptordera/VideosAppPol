<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase; // Asegúrate de que esté presente
use Tests\TestCase; // Cambia la importación de PHPUnit\TestCase a Tests\TestCase
use App\Helpers\UserHelpers;

class UserTest extends TestCase // Asegúrate de que extienda TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_is_super_admin_function()
    {
        $superAdmin = (new \App\Helpers\UserHelpers)->create_superadmin_user();

        $this->assertTrue($superAdmin->isSuperAdmin());

        $regularUser = (new \App\Helpers\UserHelpers)->create_regular_user();

        $this->assertFalse($regularUser->isSuperAdmin());
    }
}
