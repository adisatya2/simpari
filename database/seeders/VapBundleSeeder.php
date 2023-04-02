<?php

namespace Database\Seeders;

use App\Models\VapBundle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VapBundleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        VapBundle::truncate();
        Schema::enableForeignKeyConstraints();

        VapBundle::insert([
            ['bundle' => 'Kebersihan Tangan'],
            ['bundle' => 'Oral Hygine 4-6 Jam'],
            ['bundle' => 'Suction / Manajemen Sekresi'],
            ['bundle' => 'Pengkajian Sedasi dan Extubasi'],
            ['bundle' => 'Profilaksis Peptic Ulcer'],
            ['bundle' => 'Posisi Kepala 30°-40°'],
            ['bundle' => 'DVT Profilaksis'],
            ['bundle' => 'Menyikat Gigi Setiap 12 Jam'],
        ]);
    }
}
