<?php

namespace Database\Factories; // The namespace declaration for the ProjectFactory class

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 *
 * This line indicates that the ProjectFactory class extends the Factory class and is used to generate data for the App\Models\Project model.
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
     * This method sets the default state of the model when a new record is created.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(), // Generates a random sentence for the project name
            'description' => $this->faker->realText(), // Generates a random paragraph for the project description
            'due_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'), // Generates a random date and time within the next year and formats it as a string in the format 'Y-m-d'
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed']), // Generates a random string from the given array for the project status
            'image_path' => $this->faker->imageUrl(), // Generates a random image URL for the project image path
            'created_by' => User::factory()->create(), // Creates a new user record and assigns it to the 'created_by' field
            'updated_by' => User::factory()->create(), // Creates a new user record and assigns it to the 'updated_by' field
            'created_at' => Carbon::now(), // Sets the current date and time as the 'created_at' value
            'updated_at' => Carbon::now(), // Sets the current date and time as the 'updated_at' value
        ];
    }
