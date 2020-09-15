<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Unit test for user login.
     *
     * @return void
     */
    public function testUserLogin()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/home');
        $response->assertStatus(200);
    }
}
