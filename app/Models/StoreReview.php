<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreReview extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'message', 'user_id'];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

