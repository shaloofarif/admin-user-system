<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'ip_address', 'logged_in_at'];

    // Define relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
