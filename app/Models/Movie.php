<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model {
    public function viewers() {
        return $this->belongsToMany(User::class, 'user_movies')->withTimestamps();
    }
}