<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class AuthenticationTest
 *
 * This class contains unit tests for the authentication functionality of the application.
 * It includes tests for rendering the login screen, user authentication, failed login attempts,
 * and user logout.
 */
class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the login screen can be rendered.
     *
     * This test sends a GET request to the login route and checks that the response status code is 200.
     */
    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * Test that users can authenticate using the login screen.
     *
     * This test creates a user in the database, sends a POST request to the login route with valid credentials,
     * and checks that the user is authenticated and redirected to the dashboard route.
     */
    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    /**
     * Test that users cannot authenticate with an invalid password.
     *
     * This test creates a user in the database, sends a POST request to the login route with an invalid password,
     * and checks that the user is not authenticated.
     */
    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user
