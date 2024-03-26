<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// This class represents a migration for creating two tables: 'cache_entries' and 'cache_locks'
// The migration class is used to manage database schema changes in Laravel, an PHP framework
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This method creates the 'cache_entries' and 'cache_locks' tables using Laravel's schema builder
     * The 'cache_entries' table stores cache data, while the 'cache_locks' table manages cache locks
     */
    public function up(): void
    {
        Schema::create('cache_entries', function (Blueprint $table) {
            // The 'key' column is the primary key for the 'cache_entries' table
            $table->string('key')->primary();

            // The 'value' column stores the serialized cache value as medium text
            $table->mediumText('value');

            // The 'expiration' column stores the expiration time for each cache entry as an integer
            $table->integer('expiration');

            // A unique index is added on the 'key' and 'expiration' columns to enforce the limit of one row per key with the same expiration time
            $table->unique('key', 'expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            // The 'key' column is the primary key for the 'cache_locks' table
            $table->string('key')->primary();

            // The 'owner' column stores the identifier of the process that acquired the lock
            $table->string('owner');

            // The 'expiration' column stores the expiration time for each cache lock as an integer
            $table->integer('expiration');

            // A unique index is added on the 'key' and 'expiration' columns to enforce the limit of one row per key with the same expiration time
            $table->unique(['key', 'expiration']);

            // An index is added on the 'owner' column for faster lookups
            $table->index('owner');
        });

