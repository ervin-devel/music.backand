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
        Schema::create('category_tracks', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->index();
            $table->unsignedBigInteger('track_id')->index();

            $table->foreign('category_id', 'category_track_category_fk')->on('categories')->references('id')->onDelete('cascade');
            $table->foreign('track_id', 'category_track_track_fk')->on('tracks')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_tracks');
    }
};
