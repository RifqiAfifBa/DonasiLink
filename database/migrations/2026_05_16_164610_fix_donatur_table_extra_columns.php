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
        Schema::table('donatur', function (Blueprint $table) {
            if (Schema::hasColumn('donatur', 'phone')) {
                $table->string('phone', 20)->nullable()->default(null)->change();
            }
            if (Schema::hasColumn('donatur', 'shelter_id')) {
                $table->unsignedBigInteger('shelter_id')->nullable()->default(null)->change();
            }
            if (Schema::hasColumn('donatur', 'amount')) {
                $table->unsignedBigInteger('amount')->nullable()->default(null)->change();
            }
            if (Schema::hasColumn('donatur', 'payment_method')) {
                $table->string('payment_method', 50)->nullable()->default(null)->change();
            }
        });
    }

    public function down(): void
    {
        Schema::table('donatur', function (Blueprint $table) {
            if (Schema::hasColumn('donatur', 'phone')) {
                $table->string('phone', 20)->nullable(false)->change();
            }
            if (Schema::hasColumn('donatur', 'shelter_id')) {
                $table->unsignedBigInteger('shelter_id')->nullable(false)->change();
            }
            if (Schema::hasColumn('donatur', 'amount')) {
                $table->unsignedBigInteger('amount')->nullable(false)->change();
            }
            if (Schema::hasColumn('donatur', 'payment_method')) {
                $table->string('payment_method', 50)->nullable(false)->change();
            }
        });
    }
};
