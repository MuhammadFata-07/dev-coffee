<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::firstOrCreate(['name' => 'Coffee'], ['description' => 'Minuman berbasis kopi']);
        Category::firstOrCreate(['name' => 'Non Coffee'], ['description' => 'Minuman tanpa kopi']);
    }
}