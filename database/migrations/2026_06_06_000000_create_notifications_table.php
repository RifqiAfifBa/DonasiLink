<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            // Recipient (one of these will be set)
            $table->foreignId('donatur_id')->nullable()->constrained('donatur')->onDelete('cascade');
            $table->foreignId('shelter_id')->nullable()->constrained('shelter')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->constrained('admin')->onDelete('cascade');

            // Notification content
            $table->enum('type', [
                'penarikan_disetujui',      // Withdrawal approved
                'bukti_diunggah',           // Proof uploaded
                'rekonsiliasi_selesai',     // Reconciliation complete
                'donasi_berhasil',          // Donation successful
                'kampanye_selesai',         // Campaign completed
                'dampak_diunggah',          // Impact evidence uploaded
                'penarikan_ditolak',        // Withdrawal rejected
                'notifikasi_dampak',        // Impact notification to donor
            ]);
            $table->string('title');
            $table->text('message');

            // Reference to related model
            $table->string('related_model')->nullable(); // e.g., 'Penarikan', 'Donasi', 'Kampanye'
            $table->unsignedBigInteger('related_id')->nullable();

            // Additional data (JSON)
            $table->json('data')->nullable();

            // Read status
            $table->timestamp('read_at')->nullable();

            $table->timestamps();

            // Indexes for performance
            $table->index('donatur_id');
            $table->index('shelter_id');
            $table->index('admin_id');
            $table->index('type');
            $table->index('read_at');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
