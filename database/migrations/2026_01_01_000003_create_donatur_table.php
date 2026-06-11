<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donatur', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_telepon', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donatur');
    }
};
