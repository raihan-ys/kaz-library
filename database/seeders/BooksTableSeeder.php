<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Example Book 1',
            'author' => 'Author name 1',
            'isbn' => 1234567891111,
            'published_year' => 2003,
            'category_id' => 3,
            'publisher_id' => 2,
            'cover_image' => null,
            'stock' => 3,
            'rental_price' => 1000,
            'created_at' => now(),
        ]);
        Book::create([
            'title' => 'Example Book 2',
            'author' => 'Author name 2',
            'isbn' => 1234567892222,
            'published_year' => 2017,
            'category_id' => 2,
            'publisher_id' => 2,
            'cover_image' => null,
            'stock' => 10,
            'rental_price' => 2000,
            'created_at' => now(),
        ]);
        Book::create([
            'title' => 'Example Book 3',
            'author' => 'Author name 3',
            'isbn' => 1234567893333,
            'published_year' => 2023,
            'category_id' => 3,
            'publisher_id' => 3,
            'cover_image' => null,
            'stock' => 15,
            'rental_price' => 3000,
        ]);
    }
}
