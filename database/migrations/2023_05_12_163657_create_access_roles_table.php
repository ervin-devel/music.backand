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
        Schema::create('access_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('access_id')->index();
            $table->unsignedBigInteger('role_id')->index();

            $table->foreign('access_id', 'access_role_access_fk')->on('accesses')->references('id');
            $table->foreign('role_id', 'access_role_role_fk')->on('roles')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_roles');
    }
};
