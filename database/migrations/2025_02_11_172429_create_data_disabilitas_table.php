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
        Schema::create('data_disabilitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desa')->cascadeOnDelete();
            $table->enum('status', ['diterima', 'ditolak', 'direvisi', 'diproses'])->default('diproses');
            $table->string('nik');
            $table->string('nama');
            $table->enum('kelamin', ['laki-laki', 'perempuan']);
            $table->text('alamat');
            $table->integer('usia');
            $table->string('pendidikan');
            $table->string('tingkat_disabilitas');
            $table->foreignId('id_jenis_disabilitas')->constrained('jenis_disabilitas')->cascadeOnDelete();
            $table->foreignId('id_sub_jenis_disabilitas')->constrained('sub_jenis_disabilitas')->cascadeOnDelete();
            $table->text('keterangan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_disabilitas');
    }
};
