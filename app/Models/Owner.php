<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $hidden = [
        'password'
    ];

    public function shops()
    {
        return $this->hasMany(Shop::class, 'owner_id', 'id');
    }
}
