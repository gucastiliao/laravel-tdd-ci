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
}
