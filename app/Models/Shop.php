<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function usersAddedToFavorites()
    {
        return $this->belongsToMany(User::class, 'favorites')
                    ->as('favorite');
    }

    public function usersReserved()
    {
        return $this->belongsToMany(User::class, 'reservations')
                    ->as('reservation')
                    ->withPivot('date', 'number');
    }

    public function usersEvaluated()
    {
        return $this->belongsToMany(User::class, 'evaluations')
                    ->as('evaluation')
                    ->withPivot('evaluation');
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
