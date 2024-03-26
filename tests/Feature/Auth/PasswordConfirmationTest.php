<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class ConfirmPasswordTest
 *
 * This test class contains methods to test the password confirmation functionality
 * of the application. It uses the RefreshDatabase and WithFaker traits to refresh
 * the database before each test and generate fake data as needed.
 */
class ConfirmPasswordTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @var User
     */
    private $user;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Create a user instance for testing
        $this->user = User::factory()->create();
    }

    /**
     * Test that the confirm password page can be rendered.
     *
     * @return void
     */
    public function test_confirm_password_page_can_be_rendered(): void
    {
        // Act as the user and get the confirm password page
        $response = $this->actingAs($this->user)->get(route('password.confirm'));

        // Assert that the response status is 200
        $response->assertStatus(200);
    }

    /**
     * Test that the password can be confirmed.
     *
     * @return void
     */
    public function test_password_can_be_confirmed(): void
    {
        // Generate a fake password
        $password = $this->faker->password;

        // Act as the user and post the confirm password form with the fake password
        $response = $this->actingAs($this->user)->post(route('password.confirm'), [
            'password' => $password,
        ]);

        // Assert that the response redirects and does not have any errors
        $response->assertRedirect();
        $response->assertSessionDoesntHaveErrors();
    }

    /**
     * Test that the password is not confirmed with an invalid password.
     *
     * @return void
     */
   
