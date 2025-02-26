<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bantuan', function (Blueprint $table) {
            $table->id();
            $table->string('token_bantuan')->unique();
            $table->foreignId('disabilitas_id')->constrained('data_disabilitas')->onDelete('cascade');
            $table->string('jenis_bantuan');
            $table->enum('type_bantuan', ['tunai', 'barang']);
            $table->float('nominal')->nullable();
            $table->string('nama_barang')->nullable();
            $table->bigInteger('jumlah_barang')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bantuan');
    }
};
