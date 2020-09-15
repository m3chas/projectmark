<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;

class PostsUserTest extends TestCase
{
    /**
     * Unit test to get users posts on home of logged in users.
     *
     * @return void
     */
    public function testGetUserPosts()
    {
        $user = User::find(1);

        // Let's login as user 1, admin.
        $response = $this->actingAs($user)
                        ->withSession(['foo' => 'bar'])
                        ->get('/home')
                        ->assertStatus(200)
                        ->assertViewHas('posts');
    }
}
