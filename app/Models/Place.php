<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
    'name',
    'slug',
    'latitude',
    'longitude',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('is_favorite', 'send_forecast');
    }
}
