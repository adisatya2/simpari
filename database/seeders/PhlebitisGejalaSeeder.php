<?php

namespace Database\Seeders;

use App\Models\PhlebitisGejala;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PhlebitisGejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        PhlebitisGejala::truncate();
        Schema::enableForeignKeyConstraints();

        PhlebitisGejala::insert([
            ['gejala' => 'Demam (≥38 °C)'],
            ['gejala' => 'Nyeri Sepanjang Jalur Kanula'],
            ['gejala' => 'Kemerahan di Sekitar Vena'],
            ['gejala' => 'Pembengkakan'],
            ['gejala' => 'Vena Teraba Keras'],
            ['gejala' => 'Keluar Cairan Bernanah'],
        ]);
    }
}
