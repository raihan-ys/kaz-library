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
            'published_year' => 2021,
            'category_id' => 1,
            'publisher_id' => 1,
            'cover_image' => 'path/to/cover/image1.jpg',
            'stock' => 10,
            'rental_price' => 5000,
            'created_at' => now(),
        ]);
        Book::create([
            'title' => 'Example Book 2',
            'author' => 'Author name 2',
            'isbn' => 1234567891111,
            'published_year' => 2022,
            'category_id' => 2,
            'publisher_id' => 2,
            'cover_image' => 'path/to/cover/image2.jpg',
            'stock' => 20,
            'rental_price' => 6000,
            'created_at' => now(),
        ]);
        Book::create([
            'title' => 'Example Book 3',
            'author' => 'Author name 3',
            'isbn' => 1234567891111,
            'published_year' => 2023,
            'category_id' => 3,
            'publisher_id' => 3,
            'cover_image' => 'path/to/cover/image3.jpg',
            'stock' => 30,
            'rental_price' => 7000,
        ]);
    }
}
