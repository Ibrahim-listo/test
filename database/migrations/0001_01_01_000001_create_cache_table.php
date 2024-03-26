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
        Schema::create('cache_entries', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');

            // Add a unique index on the `expiration` column to enforce the limit of one row per key with the same expiration time
            $table->unique('key', 'expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');

            // Add a unique index on the `expiration` column to enforce the limit of one row per key with the same expiration time
            $table->unique(['key', 'expiration']);

            // Add an index on the `owner` column for faster lookups
            $table->index('owner');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache_entries');
        Schema::dropIfExists('cache_locks');
    }
};

