<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;

class PostNewTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = User::find(1);

        // Let's login as user 1, admin.
        $response = $this->actingAs($user)
                        ->withSession(['foo' => 'bar'])
                        ->get('/posts/create')
                        ->assertStatus(200)
                        ->assertViewHas('user');
    }
}
