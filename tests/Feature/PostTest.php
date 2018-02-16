<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to fetch posts
     *
     * @return void
     */
    public function testFetchPosts()
    {
        factory(\App\Post::class, 5)->create();

        $this->get('/api/posts')
            ->assertStatus(200)
            ->assertJsonCount(5)
            ->assertJsonStructure(
                [
                    '*' => [
                        'id', 'title', 'body', 'author', 'created_at', 'updated_at'
                    ]
                ]
            );
    }

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
}
