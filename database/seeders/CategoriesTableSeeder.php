<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Komputer']);
        Category::create(['name' => 'Kesehatan']);
        Category::create(['name' => 'Fiksi Ilmiah']);
        Category::create(['name' => 'Improvisasi Diri']);
        Category::create(['name' => 'Novel']);
        Category::create(['name' => 'Anak-anak']);
    }
}
