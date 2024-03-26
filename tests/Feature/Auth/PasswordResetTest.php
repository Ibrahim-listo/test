<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the reset password link screen can be rendered.
     *
     * @return void
     */
    public function test_reset_password_link_screen_can_be_rendered(): void
    {
        // Send a GET request to the password reset link screen route
        $response = $this->get(route('password.request'));

        // Assert that the response status code is 200 (OK)
        $response->assertStatus(200);
    }

    /**
     * Test that a reset password link can be requested.
     *
     * @return void
     */
    public function test_reset_password_link_can_be_requested(): void
    {
        // Fake sending of notifications
        Notification::fake();

        // Create a user
        $user = User::factory()->create();

        // Send a POST request to the password reset link request route
        // with the user's email address
        $response = $this->post(route('password.email'), ['email' => $user->email]);

        // Assert that the response status code is 200 (OK)
        $response->assertStatus(200);

        // Assert that a password reset notification was sent to the user
        Notification::assertSentTo($user, ResetPassword::class);
    }

    /**
     * Test that the reset password screen can be rendered.
     *
     * @return void
     */
    public function test_reset_password_screen_can_be_rendered(): void
    {
        // Fake sending of notifications
        Notification::fake();

        // Create a user
        $user = User::factory()->create();

        // Send a POST request to the password reset link request route
        // with the user's email address
        $response = $this->post(route('password.email'), ['email' => $user->email]);

        // Assert that the response status code is 200 (OK)
        $response->assertStatus(200);

        // Assert that a password reset notification was sent to the user
        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            // Get the token from the notification
            $token = $notification->token;

            // Send a GET request to the password reset route with the token
            $response = $this->get(route('password.reset', ['token' => $token]));

            // Assert that the response status code is 200 (OK)
            $response->assertStatus(200);

            // Return true to indicate that the callback function was successful
            return true;
        });
    }

    /**
     * Test that a password can be reset with a valid token.
     *
     * @return void
     */
    public function test_password_can_be_reset_with_valid_token(): void
    {
        // Fake sending of notifications
        Notification::fake();

        // Create a user
        $user = User::factory()->create();

        // Send a POST request to the password reset link request route
        // with the user's email address
        $response = $this->post(route('password.email'), ['email' => $user->email]);

        // Assert that the response status code is 200 (OK)
