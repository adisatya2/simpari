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
        Schema::create('surveilans_phlebitis', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('no_registrasi', 20);
            $table->smallInteger('observasi_ke');
            $table->string('id_alatterpasang', 100);
            $table->string('kode_ruangan', 10);
            $table->text('antibiotik');
            $table->text('bundle');
            $table->text('gejala');
            $table->date('tanggal_pemeriksaan_kultur');
            $table->text('hasil_kultur');
            $table->enum('status', ['Ya', 'Tidak']);
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
        Schema::dropIfExists('surveilans_phlebitis');
    }
};
