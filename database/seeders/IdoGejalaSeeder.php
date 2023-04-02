<?php

namespace Database\Seeders;

use App\Models\IdoGejala;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IdoGejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        IdoGejala::truncate();
        Schema::enableForeignKeyConstraints();

        IdoGejala::insert([
            ['gejala' => 'Demam (≥38 °C)'],
            ['gejala' => 'Nyeri'],
            ['gejala' => 'Bengkak Pada Daerah Operasi'],
            ['gejala' => 'Kemerahan Pada Sekitar Daerah Operasi'],
            ['gejala' => 'Keluar Cairan Prulen dari Luka Operasi'],
            ['gejala' => 'Luka Terbuka'],
        ]);
    }
}
