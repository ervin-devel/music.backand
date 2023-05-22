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
        Schema::create('track_related', function (Blueprint $table) {
            $table->unsignedBigInteger('track_id');
            $table->unsignedBigInteger('track_related_id');

            $table->index('track_id', 'track_related_track_idx');
            $table->index('track_related_id', 'track_related_track_related_idx');

            $table->foreign('track_id', 'track_related_track_fk')->on('tracks')->references('id');
            $table->foreign('track_related_id', 'track_related_track_related_fk')->on('tracks')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('track_related');
    }
};
