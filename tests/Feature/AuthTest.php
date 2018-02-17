<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test JWT authentication
     *
     * @return void
     */
    public function testAuthenticateUser()
    {
        $user = factory(\App\User::class)->create(
            [
                'password' => bcrypt('secret')
            ]
        );

        $this->post(
            '/api/authenticate',
            [
                'email' => $user->email,
                'password' => 'secret'
            ]
        )->assertJsonStructure(['token']);
    }

    /**
     * Test JWT refresh token
     *
     * @return void
     */
    public function testRefreshToken()
    {
        $user = factory(\App\User::class)->create(
            [
                'password' => bcrypt('secret')
            ]
        );

        $this->get(
            '/api/token/refresh',
            $this->headers($user)
        )->assertStatus(200)->assertJsonStructure(
            [
                'refreshed',
                'token'
            ]
        );
    }
}
