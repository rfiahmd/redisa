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
        Schema::create('verifikator_desa', function (Blueprint $table) {
            $table->id();
            $table->string('token_verifikator', 12)->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('desa_id');
            $table->string('jabatan', 100);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('desa_id')->references('id')->on('desa')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikator_desa');
    }
};
