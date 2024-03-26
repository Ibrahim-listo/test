<?php

namespace Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// This class represents a database migration for creating a 'tasks' table.
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This method contains the logic for creating the 'tasks' table in the database.
     * It defines the columns, their data types, and any additional properties such as default values, indexes, and foreign key constraints.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            // The 'id' column is the primary key of the table, which will be auto-incremented.
            $table->id();

            // The 'name' column is a required string column that will store the name of the task.
            $table->string('name');

            // The 'description' column is an optional text column that will store a detailed description of the task.
            $table->text('description')->nullable();

            // The 'image_path' column is an optional string column that will store the file path of the task's image.
            $table->string('image_path')->nullable();

            // The 'status' column is an enumerated column that can take one of three values: 'pending', 'in_progress', or 'completed'.
            // It has a default value of 'pending'.
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');

            // The 'priority' column is an enumerated column that can take one of three values: 'low', 'medium', or 'high'.
            // It has a default value of 'medium'.
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');

            // The 'due_date' column is an optional date column that will store the due date of the task.
            $table->date('due_date')->nullable();

            // The 'assigned_user_id' column is a foreign key column that references the 'id' column of the 'users' table.
            // It is constrained to ensure referential integrity.
            $table->foreignId('assigned_user_id')->constrained('users');

            // The 'created_by' column is a foreign key column that references the 'id' column of the 'users'
