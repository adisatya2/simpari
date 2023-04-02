<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrasirwi', function (Blueprint $table) {
            //$table->id();
            $table->string('no_registrasi', 20)->primary();
            $table->date('tanggal_registrasi');
            $table->dateTime('tanggal_pulang')->nullable()->default(null);
            $table->string('mrn', 10);
            $table->string('umur', 100);
            $table->string('no_kamar', 10);
            $table->string('kode_ruangan', 10);
            $table->string('id_dokter', 11);
            $table->string('diagnosa')->nullable();
            $table->string('jenis_jaminan', 15)->nullable();
            $table->string('nama_jaminan', 100)->nullable();
            $table->string('user');
            $table->string('kode_rs')->default(config('app.kode_rs'));
            $table->foreign('id_dokter')
                ->references('id_dokter')
                ->on('dokter')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrasirwi', function (Blueprint $table) {
            $table->dropForeign('registrasirwi_id_dokter_foreign');
        });
        Schema::dropIfExists('registrasirwi');
    }
};
