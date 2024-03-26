<?php

namespace Tests\Feature\Auth;

use App\Models\User; // Using User model from App\Models
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash; // Using Hash facade for password hashing
use Tests\TestCase; // Extending TestCase base class for testing

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase; // Using RefreshDatabase trait to reset the database after each test

    /**
     * Test to check if the user's password can be updated.
     *
     * @return void
     */
    public function test_password_can_be_updated(): void
    {
        $user = User::factory()->create(); // Creating a user using the factory

        $response = $this->actingAs($user) // Authenticating the user
            ->from('/profile') // Setting the base URL for redirection
            ->put('/password', [ // Sending a PUT request to update the password
                'current_password' => $user->password, // Current password of the user
                'password' => 'new-password', // New password provided by the user
                'password_confirmation' => 'new-password', // Confirmation of the new password
            ]);

        $response // Asserting the response status
            ->assertSessionHasNoErrors() // Checking if there are no validation errors
            ->assertRedirect('/profile'); // Checking if the user is redirected to the profile page

        // Checking if the password has been updated in the database
        $this->assertTrue(Hash::check('new-password', $user->fresh()->password));
    }

    /**
     * Test to check if the correct password must be provided to update the password.
     *
     * @return void
     */
    public function test_correct_password_must_be_provided_to_update_password(): void
    {
        $user = User::factory()->create(); // Creating a user using the factory

        $response = $this->actingAs($user) // Authenticating the user
            ->from('/profile') // Setting the base URL for redirection
            ->put('/password', [ // Sending a PUT request to update the password
                'current_password' => 'wrong-password', // Incorrect current password provided by the user
                'password' => 'new-password', // New password provided by the user
                'password_confirmation' => 'new-password', // Confirmation of the new password
            ]);

        $response // Asserting the response status
            ->assertSessionHasErrors('current_password') // Checking if there is a validation error for the current password
            ->assertRedirect('/profile'); // Checking if the user is redirected to the profile page

        // Checking if the password has not been updated in the database
        $this->assertTrue(Hash::check($user->password, $user->fresh()->password));
    }

    /**
     * Test to check if the password must be confirmed.
     *
     * @return void
     */
    public function test_password_must_be_confirmed(): void
    {
        $user = User::factory()->
