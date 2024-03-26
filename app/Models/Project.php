<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Throwable;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the tasks associated with the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Create a new project record in the database.
     *
     * @param  array  $attributes
     * @return Project
     *
     * @throws \Throwable
     */
    public static function createProject(array $attributes): Project
    {
        try {
            // Attempt to create a new project record in the database
            return static::create($attributes);
        } catch (QueryException $e) {
            // If a database query exception occurs, log the error and throw a runtime exception
            report($e);
            throw new \RuntimeException('An error occurred while creating the project.', 500);
        }
    }
}

