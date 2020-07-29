<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIfHomePageStatus()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/');

        $response->assertStatus(200)->assertSee('Home')->assertSee('Archives');
    }

}
