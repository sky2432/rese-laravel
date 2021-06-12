<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    public function shops()
    {
        return $this->hasMany(Shop::class, 'genre_id', 'id');
    }
}
