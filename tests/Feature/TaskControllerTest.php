<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function halaman_task_bisa_diakses()
    {
        $response = $this->get('/tasks');
        $response->assertStatus(200);
    }

    /** @test */
    public function bisa_menambah_task_baru()
    {
        $response = $this->post('/tasks', [
            'title' => 'Belajar Laravel Testing',
            'status' => 'pending'
        ]);

        $response->assertStatus(302); // redirect setelah store

        $this->assertDatabaseHas('tasks', [
            'title' => 'Belajar Laravel Testing'
        ]);
    }
}
