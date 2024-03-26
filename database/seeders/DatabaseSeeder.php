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
                'id' => 1,
                'name' => 'ibrahim',
                'email' => 'ibrahim@example.com',
                'password' => Hash::make('123.321A'),
                'email_verified_at' => Carbon::now(),
            ])
            ->assignRole(UserRole::Admin);

        // Create regular user
        $regularUser = User::factory()
            ->create([
                'id' => 2,
                'name' => 'ahmed',
                'email' => 'ahmed@example.com',
                'password' => Hash::make('123.321A'),
                'email_verified_at' => Carbon::now(),
            ])
            ->assignRole(UserRole::User);

        // Create projects with tasks
        Project::factory()
            ->count(30)
            ->has(Task::factory()->count(30), 'tasks')
            ->create()
            ->each(function (Project $project) {
                $project->users()->attach([$adminUser->id, $regularUser->id]);
            });
    }
}
