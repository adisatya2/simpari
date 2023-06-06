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
        Schema::create('gizi', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi', 20)->nullable();
            $table->text('keterangan')->nullable();
            $table->string('user_create', 15);
            $table->string('user_update', 15)->nullable();
            $table->string('kode_rs')->default(config('app.kode_rs'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gizi');
    }
};
