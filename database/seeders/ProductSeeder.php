<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $coffee = Category::where('name', 'Coffee')->value('id');
        $non    = Category::where('name', 'Non Coffee')->value('id');

        // [nama, harga, tingkat gula %, kategori]
        $menu = [
            ['Americano', 13000, 0, $coffee],
            ['Kopi Susu Gula Aren', 15000, 8, $coffee],
            ['Spanish Latte', 15000, 8, $coffee],
            ['Cafe Latte', 15000, 4, $coffee],
            ['Vanilla Latte', 17000, 8, $coffee],
            ['Caramel Latte', 17000, 8, $coffee],
            ['Hazelnut Latte', 17000, 8, $coffee],
            ['Butterscotch Latte', 17000, 8, $coffee],
            ['Salted Caramel Latte', 19000, 12, $coffee],
            ['Sea Salt Butterscotch Latte', 19000, 12, $coffee],
            ['Matcha Salt Butter Cream', 19000, 12, $non],
            ['Matcha Latte', 16000, 8, $non],
            ['Chocolate Latte', 16000, 8, $non],
            ['Salted Caramel Chocolate', 19000, 12, $non],
            ['Chocolate Hazelnut', 17000, 8, $non],
        ];

        foreach ($menu as [$name, $price, $sugar, $categoryId]) {
            Product::updateOrCreate(
                ['name' => $name],
                [
                    'category_id' => $categoryId,
                    'price'       => $price,
                    'sugar_level' => $sugar,
                    'stock'       => 50, // stok awal contoh, ubah sesuai kebutuhan
                    'is_active'   => true,
                ]
            );
        }
    }
}