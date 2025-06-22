<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('address');
            $table->string('phone')->unique();
            $table->string('email');
            $table->string('profile_photo')->nullable();

            // FK to member type.
            $table->unsignedBigInteger('type_id')->after('full_name');

            // Define foreign key.
            $table->foreign('type_id')->references('id')->on('member_types')->onDelete('cascade');

            // Created at and updated at timestamps.
            $table->timestamps();

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
        Schema::dropIfExists('members');
    }
}
