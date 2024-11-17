<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run all seeders at once.
        $this->call(CategoriesTableSeeder::class);
        $this->call(PublishersTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(MembersTableSeeder::class);
        $this->call(MemberTypesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
