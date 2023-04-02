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
        Schema::create('master_pasien', function (Blueprint $table) {
            //$table->id();
            $table->string('mrn', 10)->primary();
            $table->string('nik', 16)->nullable();
            $table->string('nama_pasien');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir');
            $table->enum('jk', ['Laki-Laki', 'Perempuan']);
            $table->string('no_telp', 16)->nullable();
            $table->string('alamat')->nullable();
            $table->string('agama', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_pasien');
    }
};
