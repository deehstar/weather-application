<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\WeatherReading;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('region')->nullable();
            $table->string('country');
            $table->timestamps();
        });
        // Seed the locations table with some initial data
        DB::table('locations')->insert([
            [
                'name' => 'Odense',
                'region' => 'Syddanmark',
                'country' => 'Denmark',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Copenhagen',
                'region' => 'Hovedstaden',
                'country' => 'Denmark',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aarhus',
                'region' => 'Midtjylland',
                'country' => 'Denmark',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aalborg',
                'region' => 'Nordjylland',
                'country' => 'Denmark',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Esbjerg',
                'region' => 'Syddanmark',
                'country' => 'Denmark',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
