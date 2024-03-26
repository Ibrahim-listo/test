<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase, DatabaseTransactions, WithFaker;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get(Route::route('register')->uri());

        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    public function test_new_users_can_register(): void
    {
        $password = $this->faker->password(8);

        $response = $this->post(Route::route('register')->uri(), [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(Route::route('dashboard')->uri());
    }
}
