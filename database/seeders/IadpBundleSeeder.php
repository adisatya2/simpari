<?php

namespace Database\Seeders;

use App\Models\IadpBundle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IadpBundleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        IadpBundle::truncate();
        Schema::enableForeignKeyConstraints();

        IadpBundle::insert([
            ['bundle' => 'Kebersihan Tangan'],
            ['bundle' => 'Menggunakan APD Lengkap Saat Pemasangan Kateter Vena Sentral'],
            ['bundle' => 'Antiseptik Kulit Menggunakan Chlorhexidine'],
            ['bundle' => 'Pemilihan Lokasi Daerah Pemasangan Vena'],
            ['bundle' => 'Swab Alkohol Setiap Melakukan Injeksi'],
            ['bundle' => 'Spuit yang Digunakan Disposable'],
            ['bundle' => 'Penutupan Lokasi Insersi Dengan Dressing Transparan'],
            ['bundle' => 'Selang Infus Diganti sesuai Standar / Pergantian Perlengkapan dan Cairan Intravena'],
            ['bundle' => 'Kaji Setiap Hari Apakah CVC Masih Dibutuhkan'],
        ]);
    }
}
