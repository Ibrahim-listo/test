<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Specify the table name (if it's different from the default)
    protected $table = 'tasks';

    // Specify the timestamps configuration
    public $timestamps = true;

    // If you want to disable created_at and updated_at columns
    // const CREATED_AT = null;
    // const UPDATED_AT = null;

    // If you want to customize created_at and updated_at columns
    // const CREATED_AT = 'created_date';
    // const UPDATED_AT = 'updated_date';

    // Add any additional attributes, mutators, or accessors here
    // For example, to format the created_at timestamp as a string:
    // protected $appends = ['formatted_created_at'];
    // public function getFormattedCreatedAtAttribute()
    // {
    //     return $this->created_at->format('m/d/Y h:i A');
    // }
}
