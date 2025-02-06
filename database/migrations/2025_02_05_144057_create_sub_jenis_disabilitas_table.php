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
        Schema::create('sub_jenis_disabilitas', function (Blueprint $table) {
            $table->id();
            $table->string('token_sub_jenis')->unique();
            $table->foreignId('jenis_disabilitas_id')->constrained('jenis_disabilitas');
            $table->string('nama_sub_jenis');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_jenis_disabilitas');
    }
};
