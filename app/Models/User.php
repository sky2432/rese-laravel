<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'api_token',
    ];


    public function favoriteShops()
    {
        return $this->belongsToMany(Shop::class, 'favorites')
                    ->as('favorite')
                    ->withPivot('id')
                    ->withTimestamps();
    }

    public function shopsReserved()
    {
        return $this->belongsToMany(Shop::class, 'reservations')
                    ->as('reservation')
                    ->withPivot('id', 'visited_on', 'number_of_visiters', 'status');
    }

    public function shopsEvaluated()
    {
        return $this->belongsToMany(Shop::class, 'evaluations')
                    ->as('evaluation')
                    ->withPivot('evaluation');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
