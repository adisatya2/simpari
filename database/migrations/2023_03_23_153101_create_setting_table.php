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
        Schema::create('setting', function (Blueprint $table) {
            $table->id('id_setting');
            $table->string('nama_rumahsakit')->default(config('app.nama_rs'));
            $table->string('kode_rumahsakit', 5)->default(config('app.kode_rs'));
            $table->string('alias_rumahsakit', 5);
            $table->text('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->string('path_logo_square')->nullable();
            $table->string('path_logo_login')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting');
    }
};
