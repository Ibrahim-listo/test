<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the email verification screen can be rendered.
     *
     * This method creates an unverified user and logs them in, then makes a GET request to the email verification notice route.
     * It asserts that the response status is 200, indicating that the screen was successfully rendered.
     */
    public function test_email_verification_screen_can_be_rendered(): void
    {
        $user = User::factory()->unverified()->create();

        $response = $this->actingAs($user)->get(route('verification.notice'));

        $response->assertStatus(200);
    }

    /**
     * Test that the email can be verified.
     *
     * This method creates an unverified user and generates a verification URL with a valid hash. It then makes a GET request to
     * the verification URL and asserts that the Verified event was dispatched, the user's email is now verified, and the
     * response redirects to the dashboard with a verified=1 query parameter.
     */
    public function test_email_can_be_verified(): void
    {
        $user = User::factory()->unverified()->create();

        Event::fake();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        Event::assertDispatched(Verified::class);
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
        $response->assertRedirect(route('dashboard', [], false).'?verified=1');
    }

    /**
     * Test that the email is not verified with an invalid hash.
     *
     * This method creates an unverified user and generates a verification URL with an invalid hash. It then makes a GET request
     * to the verification URL and asserts that the user's email is not verified.
     */
    public function test_email_is_not_verified_with_invalid_hash(): void
    {
        $user = User::factory()->unverified()->create();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1('wrong-email')]
        );

        $this->actingAs($user)->get($verificationUrl);

        $this->assertFalse($user->fresh()->hasVerifiedEmail());
