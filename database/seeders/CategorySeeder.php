<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::factory()
            ->count(3)
            ->has(
                \App\Models\Theme::factory()
                    ->count(4)
                    ->has(
                        \App\Models\Card::factory()->count(5)
                    )
            )
            ->create();
    }
}
