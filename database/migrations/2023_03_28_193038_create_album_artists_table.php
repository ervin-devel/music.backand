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
        Schema::create('album_artists', function (Blueprint $table) {
            $table->unsignedBigInteger('album_id');
            $table->unsignedBigInteger('artist_id');

            $table->index('album_id', 'album_artist_album_idx');
            $table->index('artist_id', 'album_artist_artist_idx');

            $table->foreign('album_id', 'album_artist_album_fk')->on('albums')->references('id')->onDelete('cascade');
            $table->foreign('artist_id', 'album_artist_artist_fk')->on('artists')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_artists');
    }
};
