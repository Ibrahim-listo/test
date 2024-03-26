<?php

namespace Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable(); // changed 'longText' to 'text' for simplicity
            $table->string('image_path')->nullable();
            $table->string('status')->default('pending'); // added a default value
            $table->string('priority')->default('medium'); // added a default value
            $table->date('due_date')->nullable(); // changed 'string' to 'date' for simplicity
            $table->foreignId('assigned_user_id')->constrained('users');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->foreignId('project_id')->constrained('projects');
            $table->timestamps();

            // added indexes for foreign keys for better performance
            $table->index('assigned_user_id');
            $table->index('created_by');
            $table->index('updated_by');
            $table->index('project_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

