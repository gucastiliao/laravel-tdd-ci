<?php

namespace Tests\Unit;

use Tests\TestCase;

class DingoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testApi()
    {
        $response = $this->json('GET', '/api');

        $response
            ->assertStatus(200)
            ->assertJson([
                'Dingo works!'
            ]);
    }
}
