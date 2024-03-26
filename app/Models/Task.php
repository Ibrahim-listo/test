<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'tasks';

    // Specify the timestamps configuration
    public $timestamps = true;

    // If you want to disable created_at and updated_at columns
    // public $timestamps = false;

    // If you want to customize created_at and updated_at columns
    // const CREATED_AT = 'created_date';
    // const UPDATED_AT = 'updated_date';
}
