<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Location extends Model
{
    protected $fillable = [
        'name',
        'region',
        'country',
    ];
    public function weatherReadings()
    {
        return $this->hasMany(WeatherReading::class);
    }
    public function latestWeatherReading(): HasOne
    {
        return $this->hasOne(WeatherReading::class)->latestOfMany();
    }
}
