<?php

namespace Tests\Feature;

use Tests\TestCase;

class WeatherApiTest extends TestCase
{
    /** @test */
    public function api_cuaca_mengembalikan_data_dengan_benar()
    {
        $response = $this->get('/api/weather');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'temperature',
            'windspeed',
            'weathercode'
        ]);
    }
}
