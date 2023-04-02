<?php

namespace Database\Seeders;

use App\Models\PhlebitisBundle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PhlebitisBundleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        PhlebitisBundle::truncate();
        Schema::enableForeignKeyConstraints();

        PhlebitisBundle::insert([
            ['bundle' => 'Kebersihan Tangan'],
            ['bundle' => 'Nomor IV Catheter sesuai lokasi'],
            ['bundle' => 'Pemilihan Lokasi Daerah Pemasangan Vena'],
            ['bundle' => 'Swab Alkohol Setiap Melakukan Injeksi'],
            ['bundle' => 'Spuit yang Digunakan Disposable'],
            ['bundle' => 'Penutupan Lokasi Insersi Dengan Dressing Transparan'],
            ['bundle' => 'Selang Infus Diganti sesuai Standar / Pergantian Perlengkapan dan Cairan Intravena'],
        ]);
    }
}
