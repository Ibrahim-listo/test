<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CustomUser extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * The $fillable property is an array that specifies which fields can be mass-assigned
     * via the create method. In this case, the 'name', 'email', and 'password' fields
     * can be mass-assigned.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * The $hidden property is an array that specifies which fields should be hidden
     * when the model is converted to an array or JSON. In this case, the 'password'
     * and 'remember_token' fields are hidden.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * The $casts property is an array that specifies which fields should be cast
     * to other data types. In this case, the 'email_verified_at' field is cast to a
     * Carbon\Carbon instance, and the 'password' field is cast to a hashed string.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Add any custom methods or properties here

    /**
     * Get the user's full name.
     *
     * The getFullNameAttribute method returns the user's full name by concatenating
     * the 'first_name' and 'last_name' fields.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Check if the user has a role.
     *
     * The hasRole method checks if the user has a specific role. It takes a role string
     * as an argument and returns a boolean value based on whether the user has that role.

