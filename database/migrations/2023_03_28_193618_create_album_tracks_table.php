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
        Schema::create('album_tracks', function (Blueprint $table) {
            $table->unsignedBigInteger('album_id');
            $table->unsignedBigInteger('track_id');

            $table->index('album_id', 'album_track_album_idx');
            $table->index('track_id', 'album_track_track_idx');

            $table->foreign('album_id', 'album_track_album_fk')->on('albums')->references('id')->onDelete('cascade');
            $table->foreign('track_id', 'album_track_track_fk')->on('tracks')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_tracks');
    }
};
