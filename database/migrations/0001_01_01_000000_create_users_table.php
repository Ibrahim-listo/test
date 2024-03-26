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
     * This method is responsible for creating three tables: users, password_reset_tokens, and sessions.
     * The users table contains user data with necessary columns like id, name, email, email_verified_at,
     * password, remember_token, and timestamps. The password_reset_tokens table is used to store email
     * and token for password reset functionality. The sessions table stores user sessions with user_id,
     * ip_address, user_agent, payload, and last_activity.
     */
    public function up(): void
    {
        // Create users table
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Use id as primary key
            $table->string('name'); // User's name
            $table->string('email')->unique(); // User's email, must be unique
            $table->timestamp('email_verified_at')->nullable(); // Email verification timestamp
            $table->string('password'); // User's password
            $table->rememberToken(); // Remember token for user's session
            $table->timestamps(); // Timestamps for created_at and updated_at
        });

        // Create password_reset_tokens table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->id(); // Use id as primary key
            $table->string('email')->index(); // Add index for email column
            $table->string('token'); // Token for password reset
            $table->timestamp('created_at')->nullable(); // Timestamp for token creation

            // Add foreign key constraint
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
        });

        // Create sessions table
        Schema::create('sessions', function (Blueprint $table) {
            $table->id(); // Use id as primary key
            $table->foreignId('user_id')->nullable()->index(); // Add index for user_id column
            $table->string('ip_address', 45)->nullable(); // User's IP address
            $table->text('user_agent')->nullable(); // User's user_agent
            $table->longText('payload'); // Payload for user's session
            $table->integer('last_activity')->index(); // Timestamp for user's last activity

            // Add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method is responsible for dropping the three tables: users, password_reset_tokens, and sessions.
     */
    public function down(): void
    {
        // Drop sessions table
        Schema::dropIfExists('sessions');

        // Drop password_reset_tokens table
        Schema::dropIfExists('password_reset_tokens');

        // Drop users table
        Schema::dropIfExists('users');
    }
};

