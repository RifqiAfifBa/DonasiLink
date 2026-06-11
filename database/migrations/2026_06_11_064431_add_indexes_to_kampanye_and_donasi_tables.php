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
        Schema::table('kampanye', function (Blueprint $table) {
            $table->index('status');
            $table->index('created_at');
        });

        Schema::table('donasi', function (Blueprint $table) {
            $table->index('status');
            $table->index('email_donatur');
            $table->index('donatur_id');
        });
    }

    public function down(): void
    {
        Schema::table('kampanye', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('donasi', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['email_donatur']);
            $table->dropIndex(['donatur_id']);
        });
    }
};
