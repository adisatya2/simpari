<?php

namespace Database\Seeders;

use App\Models\Agama;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Agama::truncate();
        Schema::enableForeignKeyConstraints();

        Agama::insert([
            ['nama_agama' => 'ISLAM'],
            ['nama_agama' => 'KRISTEN'],
            ['nama_agama' => 'KATOLIK'],
            ['nama_agama' => 'HINDU'],
            ['nama_agama' => 'BUDHA'],
            ['nama_agama' => 'KONGHUCU'],
        ]);
    }
}
