<?php

namespace Database\Migrations;

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
        // Create users table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // Create password_reset_tokens table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->id(); // Use id as primary key
            $table->string('email')->index(); // Add index for email column
            $table->string('token');
            $table->timestamp('created_at')->nullable();

            // Add foreign key constraint
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
        });

        // Create sessions table
        Schema::create('sessions', function (Blueprint $table) {
            $table->id(); // Use id as primary key
            $table->foreignId('user_id')->nullable()->index(); // Add index for user_id column
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();

            // Add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
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
