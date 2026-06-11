<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kampanye', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shelter_id')->constrained('shelter')->onDelete('cascade');
            $table->string('nama_hewan');
            $table->string('usia_hewan');
            $table->enum('sedang_sakit', ['ya', 'tidak'])->default('tidak');
            $table->string('kebutuhan_hewan');
            $table->text('deskripsi_hewan');
            $table->string('gambar')->nullable();
            $table->decimal('target_donasi', 12, 2)->default(0);
            $table->decimal('total_terkumpul', 12, 2)->default(0);
            $table->enum('status', ['aktif', 'selesai'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kampanye');
    }
};
