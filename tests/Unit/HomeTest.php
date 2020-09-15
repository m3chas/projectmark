<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * Unit test for home.
     *
     * @return void
     */
    public function testHome()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
