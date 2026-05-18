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
        Schema::create('penarikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shelter_id')->constrained('shelter')->onDelete('cascade');
            $table->string('bank', 50);
            $table->string('nomor_rekening', 50);
            $table->string('nama_rekening', 100);
            $table->decimal('total_penarikan', 15, 2);
            $table->text('keterangan');
            $table->enum('status', ['Diproses', 'Berhasil', 'Gagal'])->default('Diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penarikans');
    }
};
