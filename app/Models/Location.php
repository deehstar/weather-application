<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'region',
        'country',
        'localtime',
    ];
    public function weatherReadings()
    {
        return $this->hasMany(WeatherReading::class);
    }
}
