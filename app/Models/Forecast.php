<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    protected $fillable = [
        'location_id', // Foreign key
        'forecast_time',
        'temp_c',
        'condition_icon',
        'chance_of_rain',
        'feelslike_c',
    ];
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
