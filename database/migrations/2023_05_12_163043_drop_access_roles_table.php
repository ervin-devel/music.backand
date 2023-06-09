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
        Schema::dropIfExists('access_roles');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('access _roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->timestamps();

            $table->index('role_id', 'access_role_role_idx');
            $table->foreign('role_id', 'access_role_role_fk')->on('roles')->references('id');
        });
    }
};
