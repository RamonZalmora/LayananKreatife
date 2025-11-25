<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        Task::create([
            'user_id' => 1,
            'category_id' => 1,
            'title' => 'Belajar Laravel Breeze',
            'description' => 'Pelajari login, register, middleware.',
            'status' => 'pending',
            'priority' => 'high',
            'deadline' => now()->addDays(3),
        ]);
    }
}
