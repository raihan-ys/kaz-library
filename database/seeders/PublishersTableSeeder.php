<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publisher;

class PublishersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Publisher::create(['name' => 'Elex Media Komputindo']);
        Publisher::create(['name' => 'Kompas Gramedia']);
        Publisher::create(['name' => 'Penerbit Andi']);
    }
}
