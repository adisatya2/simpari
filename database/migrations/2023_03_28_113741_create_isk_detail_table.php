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
        Schema::create('isk_detail', function (Blueprint $table) {
            $table->id();
            $table->string('id_header', 100);
            $table->smallInteger('observasi_ke');
            $table->date('tanggal_observasi')->nullable();
            $table->text('antibiotik')->nullable();
            $table->text('bundle')->nullable();
            $table->text('gejala')->nullable();
            $table->date('tanggal_pemeriksaan_kultur')->nullable();
            $table->text('hasil_kultur')->nullable();
            $table->enum('status', ['Ya', 'Tidak']);
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
        Schema::dropIfExists('isk_detail');
    }
};
