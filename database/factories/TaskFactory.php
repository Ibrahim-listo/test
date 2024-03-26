<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 *
 * This class is a factory for creating Task models with realistic data.
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
     * This method returns an array of attribute values that will be used to create
     * a new Task instance.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(), // Generates a random sentence for the task name.
            'description' => $this->faker->realText(), // Generates a random paragraph for the task description.
            'due_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d H:i:s'), // Generates a random date and time within the next year for the task due date.
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed']), // Generates a random task status.
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']), // Generates a random task priority.
            'image_path' => $this->faker->imageUrl(), // Generates a random image URL for the task.
            'assigned_user_id' => $this->faker->randomElement(User::pluck('id')) ?? 1, // Generates a random user ID for the task assignee.
            'created_by' => 1, // Sets the user ID of the user who created the task.
            'updated_by' => 1, // Sets the user ID of the user who last updated the task.
            'created_at' => Carbon::now()->format('
