<?php

namespace Database\Seeders;

use App\Models\JenisCairan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisCairanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        JenisCairan::truncate();
        Schema::enableForeignKeyConstraints();

        JenisCairan::insert([
            ['nama_cairan' => 'Cairan Saline NaCL 0.9 %'],
            ['nama_cairan' => 'Ringer Laktat'],
            ['nama_cairan' => 'Dextrose'],
            ['nama_cairan' => 'Gelatin'],
            ['nama_cairan' => 'Albumin'],
            ['nama_cairan' => 'Dekstran'],
        ]);
    }
}
