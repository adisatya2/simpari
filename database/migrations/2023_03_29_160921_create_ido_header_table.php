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
        Schema::create('ido_header', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('no_registrasi', 20);
            $table->string('ruang_perawatan', 10)->nullable();
            $table->smallInteger('operasi_ke');
            $table->dateTime('jadwal_operasi');
            $table->enum('jenis_operasi', ['Elektif', 'CITO'])->nullable();
            $table->smallInteger('suhu')->nullable();
            $table->smallInteger('gds')->nullable();
            $table->enum('screening_mrsa', ['Positif', 'Negatif', 'Tidak Dilakukan'])->nullable();
            $table->enum('pencukuran_dengan', ['Cliper', 'Silet', 'Tidak Dilakukan'])->nullable();
            $table->text('antibiotik_profilaksis')->nullable();
            $table->dateTime('waktu_pemberian_profilaksis')->nullable();
            $table->text('riwayat_penyakit')->nullable();
            $table->text('bundle_pre')->nullable();
            $table->string('ruang_operasi', 50)->nullable();
            $table->string('nama_prosedur_operasi', 200)->nullable();
            $table->enum('kualifikasi_daerah_operasi', ['Bersih', 'Bersih Terkontaminasi', 'Terkontaminasi', 'Kotor'])->nullable();
            $table->smallInteger('lama_operasi')->nullable();
            $table->text('antibiotik_tambahan_intra')->nullable();
            $table->text('bundle_intra')->nullable();
            //$table->text('bundle_post')->nullable();
            //$table->text('gejala')->nullable();
            //$table->text('keterangan')->nullable();
            //$table->enum('status', ['Ya', 'Tidak'])->nullable();
            $table->string('user_create', 15);
            $table->string('user_update', 15)->nullable();
            $table->string('user_update_pre', 15)->nullable();
            $table->string('user_update_intra', 15)->nullable();
            // $table->string('user_update_post', 15)->nullable();
            $table->string('kode_rs')->default(config('app.kode_rs'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ido_header');
    }
};
