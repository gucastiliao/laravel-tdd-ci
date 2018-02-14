<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        User::create(
            [
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'password' => bcrypt(123456)
            ]
        );

        $this->assertDatabaseHas(
            'users',
            [
                'email' => 'admin@admin.com'
            ]
        );
    }
}
