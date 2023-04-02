<?php

namespace Database\Seeders;

use App\Models\AlatInvasif;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlatInvasifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        AlatInvasif::truncate();
        Schema::enableForeignKeyConstraints();

        AlatInvasif::insert([
            ['nama_alat' => 'UC (Urine Cateter)'],
            ['nama_alat' => 'IVL (Intra Vena Line)'],
            ['nama_alat' => 'ETT/VENTI (Endotracheal Tube/Ventilator)'],
        ]);
    }
}
