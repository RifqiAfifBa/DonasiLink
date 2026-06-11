<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donasi', function (Blueprint $table) {
            $table->foreignId('donatur_id')->nullable()->after('kampanye_id')
                  ->constrained('donatur')->nullOnDelete();
        });

        // Backfill: link donasi lama ke donatur berdasarkan kecocokan username/email.
        $donaturs = DB::table('donatur')->select('id', 'username', 'email')->get();
        foreach ($donaturs as $d) {
            DB::table('donasi')
                ->whereNull('donatur_id')
                ->where(function ($q) use ($d) {
                    $q->where('email_donatur', $d->email)
                      ->orWhereRaw('LOWER(nama_donatur) = ?', [strtolower($d->username)]);
                })
                ->update(['donatur_id' => $d->id]);
        }
    }

    public function down(): void
    {
        Schema::table('donasi', function (Blueprint $table) {
            $table->dropForeign(['donatur_id']);
            $table->dropColumn('donatur_id');
        });
    }
};
