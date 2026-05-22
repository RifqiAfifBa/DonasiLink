<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penarikan', function (Blueprint $table) {
            $table->foreignId('kampanye_id')->nullable()->after('shelter_id')
                  ->constrained('kampanye')->nullOnDelete();
            $table->string('bukti_pengeluaran')->nullable()->after('keterangan');
            $table->text('deskripsi_penggunaan')->nullable()->after('bukti_pengeluaran');
            $table->timestamp('tanggal_disetujui')->nullable()->after('status');
            $table->timestamp('tanggal_selesai')->nullable()->after('tanggal_disetujui');
        });

        // SQLite tidak men-support ALTER ENUM. Karena tabel pakai enum status,
        // kita simulasikan dengan menambah nilai "Selesai" via aplikasi (status string).
        // Existing 'Berhasil' tetap valid; "Selesai" akan ditangani di app layer.
        // Untuk MySQL, ALTER enum bisa ditambah jika perlu. Kita biarkan kolom status apa adanya.
    }

    public function down(): void
    {
        Schema::table('penarikan', function (Blueprint $table) {
            $table->dropForeign(['kampanye_id']);
            $table->dropColumn([
                'kampanye_id',
                'bukti_pengeluaran',
                'deskripsi_penggunaan',
                'tanggal_disetujui',
                'tanggal_selesai',
            ]);
        });
    }
};
