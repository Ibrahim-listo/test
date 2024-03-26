<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This method is called when the `migrate` command is executed. It creates three tables: `jobs`, `job_batches`, and `failed_jobs`.
     * Each table has a specific purpose in managing and tracking jobs within the Laravel framework.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing primary key for the jobs table
            $table->string('queue')->index(); // Creates a string-based column for the queue name and indexes it for faster searching
            $table->longText('payload'); // Creates a column to store the serialized JSON payload of the job
            $table->unsignedTinyInteger('attempts'); // Creates a column to store the number of attempts made to run the job
            $table->unsignedInteger('reserved_at')->nullable(); // Creates a column to store the timestamp when the job was reserved (nullable)
            $table->unsignedInteger('available_at'); // Creates a column to store the timestamp when the job becomes available
            $table->unsignedInteger('created_at'); // Creates a column to store the timestamp when the job was created
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary(); // Creates a string-based primary key for the job_batches table
            $table->string('name'); // Creates a string-based column for the name of the job batch
            $table->integer('total_jobs'); // Creates a column to store the total number of jobs in the batch
            $table->integer('pending_jobs'); // Creates a column to store the number of pending jobs in the batch
            $table->integer('failed_jobs'); // Creates a column to store the number of failed jobs in the batch
            $table->longText('failed_job_ids'); // Creates a column to store the IDs of the failed jobs (serialized JSON)
            $table->mediumText('options')->nullable(); // Creates a column to store optional settings for the job batch (nullable)
            $table->integer('cancelled_at')->nullable(); // Creates a column to store the timestamp when the job batch was cancelled (nullable)
            $table->integer('created_at'); // Creates a column to store the timestamp when the job batch was created
            $table->integer('finished_at')->nullable(); // Creates a column to store the timestamp when the job batch was finished (nullable)
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing primary key for the failed_jobs table
            $table->string('uuid')->unique(); // Creates a string-based unique column for the UUID of the failed job
            $table->text('
