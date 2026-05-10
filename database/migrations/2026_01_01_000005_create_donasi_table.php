<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kampanye_id')->constrained('kampanye')->onDelete('cascade');
            $table->string('nama_donatur');
            $table->string('email_donatur');
            $table->string('no_telepon', 20);
            $table->decimal('jumlah', 12, 2);
            $table->enum('metode_pembayaran', ['bank_transfer', 'e_wallet', 'credit_card']);
            $table->enum('status', ['pending', 'berhasil', 'gagal'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donasi');
    }
};
