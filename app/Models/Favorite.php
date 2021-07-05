<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function scopeUnique($query, $request)
    {
        return $query->where('user_id', $request->user_id)->where('shop_id', $request->shop_id);
    }
}
