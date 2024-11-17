<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('librarian_id');
            $table->datetime('borrow_date');
            $table->datetime('return_date')->nullable();
            $table->enum('status', ['dipinjam', 'dikembalikan']);
            $table->integer('rental_price');
            $table->integer('late_fee')->nullable();

            // Created at and updated at timestamps.
            $table->timestamps();

            // Define foreign keys
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('librarian_id')->references('id')->on('users')->onDelete('cascade');
            
            // Ensure InnoDB engine.
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrowings');
    }
}
