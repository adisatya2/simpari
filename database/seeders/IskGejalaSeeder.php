<?php

namespace Database\Seeders;

use App\Models\IskGejala;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IskGejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        IskGejala::truncate();
        Schema::enableForeignKeyConstraints();

        IskGejala::insert([
            ['gejala' => 'Demam (≥38 °C)'],
            ['gejala' => 'Urgensi / Anyang-anyangan'],
            ['gejala' => 'Frekuensi / Sering BAK'],
            ['gejala' => 'Dysuria / Nyeri Saat BAK'],
            ['gejala' => 'Nyeri Suprapubik'],
            ['gejala' => 'Muntah'],
        ]);
    }
}
