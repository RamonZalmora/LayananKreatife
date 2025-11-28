<?php

namespace Tests\Feature;

use Tests\TestCase;

class ServerTimeTest extends TestCase
{
    /** @test */
    public function api_waktu_server_mengembalikan_format_yang_benar()
    {
        $response = $this->get('/api/server-time');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'time',
            'date'
        ]);
    }
}
