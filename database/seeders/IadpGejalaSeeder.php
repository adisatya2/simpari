<?php

namespace Database\Seeders;

use App\Models\IadpGejala;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IadpGejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        IadpGejala::truncate();
        Schema::enableForeignKeyConstraints();

        IadpGejala::insert([
            ['gejala' => 'Demam (≥38 °C)'],
            ['gejala' => 'Hipothermi (<36 °C)'],
            ['gejala' => 'Hasil Kultur Darah Mikroba (+) dan Tidak Berhubungan dengan Infeksi di Bagian dari Tubuh Pasien'],
            ['gejala' => 'Apneu'],
            ['gejala' => 'Bradikardi'],
        ]);
    }
}
