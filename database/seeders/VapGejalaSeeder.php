<?php

namespace Database\Seeders;

use App\Models\VapGejala;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VapGejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        VapGejala::truncate();
        Schema::enableForeignKeyConstraints();

        VapGejala::insert([
            ['gejala' => 'Demam (≥38 °C) tanpa ditemui penyebab lainnya'],
            ['gejala' => 'Leukopenia (<4000 WBC/mm³)'],
            ['gejala' => 'Leukositosis (<12000 SDP/mm³)'],
            ['gejala' => 'Tanda Radiologis Pneumonia'],
        ]);
    }
}
