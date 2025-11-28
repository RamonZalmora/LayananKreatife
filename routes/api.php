<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/weather', function () {

    // Lokasi Pekanbaru
    $latitude = 0.5071;
    $longitude = 101.4478;

    $response = Http::withHeaders([
        'User-Agent' => 'Mozilla/5.0'
    ])->get('https://api.open-meteo.com/v1/forecast', [
        'latitude' => $latitude,
        'longitude' => $longitude,
        'current_weather' => true,
    ]);

    if ($response->failed()) {
        return [
            'error' => true,
            'message' => 'Tidak bisa mengambil cuaca'
        ];
    }

    $data = $response->json();

    if (!isset($data['current_weather'])) {
        return [
            'error' => true,
            'message' => 'Data cuaca tidak tersedia'
        ];
    }

    return [
        'temperature' => $data['current_weather']['temperature'],
        'windspeed'   => $data['current_weather']['windspeed'],
        'weathercode' => $data['current_weather']['weathercode'] ?? null
    ];
});


Route::get('/server-time', function () {
    return response()->json([
        'time' => now()->format('H:i:s'),
        'date' => now()->format('d M Y')
    ]);
});
