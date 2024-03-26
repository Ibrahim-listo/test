<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Throwable;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

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
            return static::create($attributes);
        } catch (QueryException $e) {
            report($e);
            // Handle the exception here, e.g. by logging the error or showing a user-friendly message
            throw new \RuntimeException('An error occurred while creating the project.', 500);
        }
    }
}

