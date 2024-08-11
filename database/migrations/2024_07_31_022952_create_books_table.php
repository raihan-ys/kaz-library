<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            // PK.
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->integer('published_year');
             // FK to category.
            $table->unsignedBigInteger('category_id');
            // FK to publisher.
            $table->unsignedBigInteger('publisher_id');
            $table->string('isbn');
            $table->string('cover_image')->nullable();
            $table->integer('stock');
            $table->integer('rental_price');
            // Created at and updated at timestamps.
            $table->timestamps();

            // Define foreign keys.
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('cascade');

            // Ensure InnoDB engine.
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book');
    }
};
