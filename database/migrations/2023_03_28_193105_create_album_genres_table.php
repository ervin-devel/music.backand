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
        Schema::create('album_genres', function (Blueprint $table) {
            $table->unsignedBigInteger('album_id');
            $table->unsignedBigInteger('genre_id');

            $table->index('album_id', 'album_genre_album_idx');
            $table->index('genre_id', 'album_genre_genre_idx');

            $table->foreign('album_id', 'album_genre_album_fk')->on('albums')->references('id')->onDelete('cascade');
            $table->foreign('genre_id', 'album_genre_genre_fk')->on('genres')->references('id')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_genres');
    }
};
