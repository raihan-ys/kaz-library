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
            'isbn' => 1,
            'published_year' => 2001,
            'category_id' => 1,
            'publisher_id' => 1,
            'cover_image' => null,
            'stock' => 5,
            'rental_price' => 1000,
            'created_at' => now(),
        ]);
        Book::create([
            'title' => 'Example Book 2',
            'author' => 'Author name 2',
            'isbn' => 2,
            'published_year' => 2002,
            'category_id' => 2,
            'publisher_id' => 2,
            'cover_image' => null,
            'stock' => 5,
            'rental_price' => 2000,
            'created_at' => now(),
        ]);
        Book::create([
            'title' => 'Example Book 3',
            'author' => 'Author name 3',
            'isbn' => 3,
            'published_year' => 2003,
            'category_id' => 3,
            'publisher_id' => 3,
            'cover_image' => null,
            'stock' => 5,
            'rental_price' => 3000,
        ]);
    }
}
