<?php

namespace Database\Seeders;

use App\Models\Addon;
use Illuminate\Database\Seeder;

class AddonSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Extra Shot', 'Extra Syrup', 'Extra Sauce / Caramel'] as $name) {
            Addon::updateOrCreate(['name' => $name], ['price' => 2000, 'is_active' => true]);
        }
    }
}