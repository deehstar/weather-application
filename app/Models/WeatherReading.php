<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherReading extends Model
{
    protected $fillable = [
        'location_id', // Foreign key   
        'temp_c',
        'condition_text',
        'condition_icon',
        'wind_kph',
        'wind_dir',
        'last_updated',
    ];
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}