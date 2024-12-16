<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;

class User extends Authenticatable
{
    use HasFactory, Notifiable, CanResetPassword;

    // Specify the table name (optional if table name follows Laravel's convention)
    protected $table = 'users';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'first_name',
        'mobile_no',
        'email',
        'password',
    ];

    // If you want to hide sensitive attributes like password when converting to an array
    protected $hidden = [
        'password',
    ];

    // If you need to cast certain attributes to specific types (e.g. date)
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Custom logic for password hashing
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }

    // Relationship with the IP table
    public function ips()
    {
        return $this->hasMany(Ip::class, 'user_id', 'id'); // A user has many IP entries
    }
}

