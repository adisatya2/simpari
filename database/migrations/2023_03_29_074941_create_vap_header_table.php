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
        Schema::create('vap_header', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('no_registrasi', 20);
            $table->string('ruang_perawatan', 10);
            $table->smallInteger('pemasangan_ke');
            $table->string('ruang_pemasangan', 10);
            $table->date('tanggal_pemasangan');
            $table->date('tanggal_dilepas')->nullable();
            $table->string('user_create', 15);
            $table->string('kode_rs')->default(config('app.kode_rs'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vap_header');
    }
};
