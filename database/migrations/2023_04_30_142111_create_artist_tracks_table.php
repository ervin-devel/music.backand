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
        Schema::create('artist_tracks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('artist_id');
            $table->unsignedBigInteger('track_id');

            $table->index('artist_id', 'artist_track_artist_idx');
            $table->index('track_id', 'artist_track_track_idx');

            $table->foreign('artist_id', 'artist_track_artist_fk')->on('artists')->references('id');
            $table->foreign('track_id', 'artist_track_track_fk')->on('tracks')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_tracks');
    }
};
