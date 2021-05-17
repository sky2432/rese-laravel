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
                    ->withPivot('id', 'visited_on', 'number_of_visiters', 'status');
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

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'id', 'owner_id');
    }
}
