<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfirmPasswordTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @var User */
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_confirm_password_page_can_be_rendered(): void
    {
        $response = $this->actingAs($this->user)->get(route('password.confirm'));

        $response->assertStatus(200);
    }

    public function test_password_can_be_confirmed(): void
    {
        $password = $this->faker->password;

        $response = $this->actingAs($this->user)->post(route('password.confirm'), [
            'password' => $password,
        ]);

        $response->assertRedirect();
        $response->assertSessionDoesntHaveErrors();
    }

    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        $incorrectPassword = $this->faker->word;

        $response = $this->actingAs($this->user)->post(route('password.confirm'), [
            'password' => $incorrectPassword,
        ]);

        $response->assertSessionHasErrors(['password' => 'The provided password does not match your current password.']);
    }
}
