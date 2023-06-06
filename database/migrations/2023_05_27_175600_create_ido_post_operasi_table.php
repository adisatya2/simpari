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
        Schema::create('ido_post_operasi', function (Blueprint $table) {
            $table->id();
            $table->string('id_header', 100);
            $table->smallInteger('observasi_ke');
            $table->date('tanggal_observasi')->nullable();
            $table->string('no_registrasi', 20);
            $table->string('ruang_perawatan', 10)->nullable();
            $table->text('bundle_post')->nullable();
            $table->text('gejala')->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('status', ['Ya', 'Tidak'])->nullable();
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
        Schema::dropIfExists('ido_post_operasi');
    }
};
