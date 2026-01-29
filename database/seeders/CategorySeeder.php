<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Kerusakan Bangunan',
            'description' => 'Pengaduan terkait kerusakan bangunan'
        ]);

        Category::create([
            'name' => 'Peralatan Rusak',
            'description' => 'Pengaduan terkait peralatan yang rusak'
        ]);
    }
}
