<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

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
     * @throws QueryException
     */
    public static function createProject(array $attributes): Project
    {
        try {
            return static::create($attributes);
        } catch (QueryException $e) {
            report($e);
            // Handle the exception here, e.g. by logging the error or showing a user-friendly message
            abort(500, 'An error occurred while creating the project.');
        }
    }
}
