<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Belajar', 'Pekerjaan', 'Penting', 'Proyek', 'Lainnya'];

        foreach ($categories as $c) {
            Category::create(['name' => $c]);
        }
    }
}
