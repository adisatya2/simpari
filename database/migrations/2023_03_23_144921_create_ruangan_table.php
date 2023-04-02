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
        Schema::create('ruangan', function (Blueprint $table) {
            //$table->id();
            $table->string('kode_ruangan', 10)->primary();
            $table->string('nama_ruangan', 100);
            $table->smallInteger('lantai');
            $table->tinyInteger('aktif')->default(1);
            $table->string('kode_rs')->default(config('app.kode_rs'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangan');
    }
};
