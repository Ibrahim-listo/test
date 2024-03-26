<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\UserProject;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $adminUser = User::factory()
            ->create([
                'id' => 1, // Assign a specific ID for the admin user
                'name' => 'ibrahim',
                'email' => 'ibrahim@example.com',
                'password' => Hash::make('123.321A'),
                'email_verified_at' => Carbon::now(),
            ])
            ->assignRole(UserRole::Admin); // Assign the Admin role to the user

        // Create regular user
        $regularUser = User::factory()
            ->create([
                'id' => 2, // Assign a specific ID for the regular user
                'name' => 'ahmed',
                'email' => 'ahmed@example.com',
                'password' => Hash::make('123.321A'),
                'email_verified_at' => Carbon::now(),
            ])
            ->assignRole(UserRole::User); // Assign the User role to the user

        // Create projects with tasks
        Project::factory()
            ->count(30) // Create 30 projects
            ->has(Task::factory()->count(30), 'tasks') // Each project has 30 tasks
            ->create() // Create the projects and tasks
            ->each(function (Project $project) {
                // Attach both the admin and regular users to each project
                $project->users()->attach([$adminUser->id, $regularUser->id]);
            });
    }
}

