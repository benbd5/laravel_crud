<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{ Film, Category };

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Film::factory(10)->create();

        // Pour chaque catégorie, 4 films sont associés
        Category::factory()
            ->has(Film::factory()->count(4)) // 4 films par catégorie
            ->count(10) // 10 catégories
            ->create();
    }
}
