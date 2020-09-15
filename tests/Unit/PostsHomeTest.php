<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class PostsHomeTest extends TestCase
{
    /**
     * Unit test for get POSTS on Home.
     *
     * @return void
     */
    public function testgetPostsOnHome()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewHas('posts');
    }
}
