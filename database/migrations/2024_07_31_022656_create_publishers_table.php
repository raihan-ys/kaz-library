<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('publishers', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            // Created at and updated at timestamps.
            $table->timestamps();

            // Adding 'deleted_at' column for soft deletes.
            $table->softDeletes();

            // Ensure InnoDB engine.
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publishers');
        // Dropping 'deleted_at' column for soft deletes.
        Schema::table('publishers', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
