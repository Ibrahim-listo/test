<?php

namespace Tests\Feature;

use App\Models\User; // Importing User model
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash; // Importing Hash facade
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase, WithFaker; // Using RefreshDatabase and WithFaker traits

    // Test to check if the profile page is displayed
    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create(); // Creating a user using the factory

        $response = $this->actingAs($user)->get('/profile'); // Getting the profile page while acting as the user

        $response->assertStatus(200); // Checking if the response status is 200
    }

    // Test to check if the profile information can be updated
    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create(); // Creating a user using the factory

        $response = $this->actingAs($user)->patch('/profile', [ // Updating the profile information
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $response->assertSessionDoesntHaveErrors()->assertRedirect('/profile'); // Checking if there are no errors and the redirection is to the profile page

        $user->refresh(); // Refreshing the user data

        $this->assertSame('Test User', $user->name); // Checking if the name is updated
        $this->assertSame('test@example.com', $user->email); // Checking if the email is updated
        $this->assertNull($user->email_verified_at); // Checking if the email verification status is null
    }

    // Test to check if the email verification status is unchanged when the email address is unchanged
    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->verified()->create(); // Creating a verified user using the factory

        $response = $this->actingAs($user)->patch('/profile', [ // Updating the profile information
            'name' => 'Test User',
            'email' => $user->email,
        ]);

        $response->assertSessionDoesntHaveErrors()->assertRedirect('/profile'); // Checking if there are no errors and the redirection is to the profile page

        $user->refresh(); // Refreshing the user data

        $this->assertNotNull($user->email_verified_at); // Checking if the email verification status is not null
    }

    // Test to check if the user can delete their account
    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->verified()->create(); // Creating a verified user using the factory

        $response = $this->actingAs($user)->delete('/profile', [ // Deleting the user account
            'password' => $user->password,
        ]);

        $response->assertSessionDoesntHaveErrors()->assertRedirect('/'); // Checking if there are no errors and the redirection is to the home page

        $this->assertGuest(); // Checking if the user is a guest (logged out)
        $this->assertNull(User::find($user->id)); // Checking if the user is deleted
    }

    // Test to check if the correct password must be provided to delete account
    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->verified()->create(); // Creating a verified user using the factory

        $response = $this->actingAs($user)->from('/profile')->delete('/profile', [ // Trying to delete the user account with a wrong password
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors('password')->assertRedirect('/profile'); // Checking if there is an error with the password and the redirection is to the profile page

        $this->assertNotNull(User::find($user->id)); // Checking if the user is not deleted
    }

    // Method to generate fake user data with email verification
    protected function userFactory(): User
    {
        return User::factory()->verified()->make();
    }

    // Method to generate fake user data with email verification and a password
    protected function userFactoryWithPassword(string $password
