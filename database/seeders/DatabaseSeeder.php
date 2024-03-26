<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $adminUser = User::factory()->create([
            'id' => 1,
            'name' => 'ibrahim',
            'email' => 'ibrahim@example.com',
            'password' => bcrypt('123.321A'),
            'email_verified_at' => now()
        ]);

        // Assign role to admin user
        // ... (code to assign role to user)

        // Create regular user
        $regularUser = User::factory()->create([
            'id' => 2,
            'name' => 'ahmed',
            'email' => 'ahmed@example.com',
            'password' => bcrypt('123.321A'),
            'email_verified_at' => now()
        ]);

        // Assign role to regular user
        // ... (code to assign role to user)

        // Create projects with tasks
        Project::factory()
            ->count(30)
            ->hasTasks(30)
            ->create();
    }
}
