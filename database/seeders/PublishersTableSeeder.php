<?php

namespace Database\Seeders;

use App\Models\Publisher;

use Illuminate\Database\Seeder;

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
        Publisher::create(['name' => 'Bandung Informatika']);
        Publisher::create(['name' => 'Jubilee Enterprise']);
        Publisher::create(['name' => 'Grasindo']);
    }
}
