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
        Schema::create('perkembangan_hewan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kampanye_id')->constrained('kampanye')->onDelete('cascade');
            $table->string('judul'); // Judul singkat update, cth: "Operasi selesai"
            $table->text('catatan'); // Catatan / deskripsi perkembangan
            $table->enum('jenis', ['medis', 'pakan', 'perawatan', 'umum'])->default('umum'); // Jenis update
            $table->enum('kondisi', ['membaik', 'stabil', 'kritis', 'sembuh'])->nullable(); // Kondisi terkini hewan
            $table->string('foto_sebelum')->nullable(); // Path foto sebelum
            $table->string('foto_sesudah')->nullable(); // Path foto sesudah/terbaru
            $table->string('nama_dokter')->nullable(); // Nama dokter yang menangani (opsional)
            $table->string('nama_klinik')->nullable(); // Nama klinik (opsional)
            $table->date('tanggal_update'); // Tanggal kejadian/update
            $table->timestamps();

            $table->index('kampanye_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perkembangan_hewan');
    }
};
