<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase, WithFaker;


    public function test_login_displays_validation_errors()
    {
        $response = $this->post('/login', []);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }


    public function test_user_login()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $response->assertStatus(302);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
    }


    public function test_user_registration()
    {
        $name = $this->faker->name;
        $email = $this->faker->safeEmail;
        $password = $this->faker->password(8);

        $response = $this->post('register', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
            "subscription" => true
        ]);

        $response->assertRedirect(route('home'));
        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email
        ]);
    }


    public function test_user_registration_validation_error()
    {
        $name = $this->faker->name;
        $password = $this->faker->password(8);

        $response = $this->post('register', [
            'name' => $name,
            'password_confirmation' => $password,
            "subscription" => true
        ]);
        $response->assertSessionHasErrors(["email", 'password']);

    }
}
