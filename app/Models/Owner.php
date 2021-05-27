<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Owner extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email'
    ];

    protected $hidden = [
        'password'
    ];

    public function shop()
    {
        return $this->hasOne(Shop::class);
    }
}
