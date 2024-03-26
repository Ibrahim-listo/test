<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the 'projects' table
        Schema::create('projects', function (Blueprint $table) {
            // Define the 'id' column as the primary key
            $table->id();

            // Define the 'name' column as a string
            $table->string('name');

            // Define the 'description' column as a long text, allowing null values
            $table->longText('description')->nullable();

            // Define the 'due_date' column as a timestamp, allowing null values
            $table->timestamp('due_date')->nullable();

            // Define the 'status' column as a string
            $table->string('status');

            // Define the 'image_path' column as a string, allowing null values
            $table->string('image_path')->nullable();

            // Define the 'created_by' column as a foreign key, referencing the 'id' column of the 'users' table
            $table->foreignId('created_by')
                ->constrained('users')
                ->onDelete('cascade') // Added onDelete constraint
                ->onUpdate('cascade'); // Added onUpdate constraint

            // Define the 'updated_by' column as a foreign key, referencing the 'id' column of the 'users' table
            $table->foreignId('updated_by')
                ->constrained('users')
                ->onDelete('cascade') // Added onDelete constraint
                ->onUpdate('cascade'); // Added onUpdate constraint

            // Define the 'created_at' and 'updated_at' columns as timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the 'projects' table if it exists
        Schema::dropIfExists('projects');
    }
};
