<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 *
 * This class represents a factory for creating User model instances in Laravel.
 * It contains methods for defining the default state of a User model, as well
 * as methods for customizing the User model's attributes before it is created.
 */
class UserFactory extends Factory
{
    /**
     * The attributes to be set on the model instance.
     *
     * @var array
     *
     * This array contains the default attributes that will be set on the User
     * model instance when it is created. These attributes include the user's
     * email address, name, and encrypted password.
     */
    protected $attributes = [
        'email_verified_at' => null,
        'remember_token' => Str::random(10),
    ];

    /**
     * The current password being used by the factory.
     *
     * @var string
     *
     * This variable stores the password that will be used by the factory when
     * creating a new User model instance. By default, this is set to the
     * string 'password'.
     */
    protected static string $password = 'password';

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
     * This method defines the default state of the User model instance that
     * will be created by the factory. It returns an array of attribute key-
     * value pairs that will be set on the User model instance.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make(static::$password),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     *
     * This method sets the '
