<?php

namespace Tests\Feature;

use Tests\TestCase;

class PostTest extends TestCase
{
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
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id', 'title', 'body', 'author', 'created_at', 'updated_at'
                        ]
                    ]
                ]
            );
    }

    /**
     * Test create a post with auth
     *
     * @return void
     */
    public function testCreatePost()
    {
        $user = factory(\App\User::class)->create(
            [
                'password' => bcrypt('secret')
            ]
        );

        $post = [
            'title' => 'Post title',
            'body' => 'Post body',
            'author' => 'Post author'
        ];

        $this->post(
            '/api/posts',
            $post,
            $this->headers($user)
        )->assertStatus(201)->assertJsonStructure(
            [
                'title',
                'body',
                'author'
            ]
        );
    }
}
