<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('member_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            // Adding 'deleted_at' column for soft deletes.
            $table->softDeletes();

            // Created at and updated at timestamps.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_types');
        // Dropping 'deleted_at' column for soft deletes.
        Schema::table('member_types', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
