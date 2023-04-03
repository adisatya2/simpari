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
        Schema::create('kamar', function (Blueprint $table) {
            //$table->id();
            $table->string('no_kamar', 10)->primary();
            $table->string('kode_ruangan', 10);
            $table->unsignedBigInteger('id_kelas');
            $table->string('no_registrasi', 20)->nullable();
            $table->string('mrn', 10)->nullable();
            $table->string('nama_pasien', 100)->nullable();
            $table->string('diagnosa', 100)->nullable();
            $table->string('id_dokter', 11)->nullable();
            $table->string('hak_pasien', 100)->nullable();
            $table->string('bed_hinai', 15)->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->dateTime('tanggal_pindah')->nullable();
            $table->tinyInteger('flagbor')->default(1);
            $table->tinyInteger('flagsetting')->default(0);
            $table->text('keterangan_fo')->nullable()->default(null);
            $table->text('keterangan_perawat')->nullable()->default(null);
            $table->tinyInteger('aktif')->default(1);
            $table->string('user_create', 15)->nullable();
            $table->string('user_edit', 15)->nullable();
            $table->string('user_input', 15)->nullable();
            $table->string('user_pindah', 15)->nullable();
            $table->string('kode_rs')->default(config('app.kode_rs'));

            $table->foreign('kode_ruangan')
                ->references('kode_ruangan')
                ->on('ruangan')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('id_kelas')
                ->references('id')
                ->on('kelas')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('id_dokter')
                ->references('id_dokter')
                ->on('dokter')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('no_registrasi')
                ->references('no_registrasi')
                ->on('registrasirwi')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kamar', function (Blueprint $table) {
            $table->dropForeign('kamar_kode_ruangan_foreign');
            $table->dropForeign('kamar_id_kelas_foreign');
            $table->dropForeign('kamar_id_dokter_foreign');
            $table->dropForeign('kamar_no_registrasi_foreign');
        });
        Schema::dropIfExists('kamar');
    }
};
