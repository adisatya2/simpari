<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Kelas::truncate();
        Schema::enableForeignKeyConstraints();

        Kelas::insert([
            ['nama_kelas' => 'Kelas III'],
            ['nama_kelas' => 'Kelas II'],
            ['nama_kelas' => 'Kelas I'],
            ['nama_kelas' => 'Deluxe'],
            ['nama_kelas' => 'Eksekutif'],
            ['nama_kelas' => 'Suite Room'],
            ['nama_kelas' => 'One Day Care'],
            ['nama_kelas' => 'KBBL'],
            ['nama_kelas' => 'ICU'],
            ['nama_kelas' => 'ICU Isolasi'],
            ['nama_kelas' => 'HCU'],
            ['nama_kelas' => 'HCU Isolasi'],
            ['nama_kelas' => 'NICU'],
            ['nama_kelas' => 'NICU Isolasi'],
            ['nama_kelas' => 'PICU'],
            ['nama_kelas' => 'PICU Isolasi'],
            ['nama_kelas' => 'PERINA'],
            ['nama_kelas' => 'PERINA Isolasi'],
            ['nama_kelas' => 'Kamar Bersalin (VK)'],
            ['nama_kelas' => 'VK Eksekutif'],
            ['nama_kelas' => 'Kamar Bersalin Observasi'],
            ['nama_kelas' => 'Kamar Operasi'],
            ['nama_kelas' => 'Kamar PreOperasi'],
            ['nama_kelas' => 'Kamar Pemulihan (RR)'],
            ['nama_kelas' => 'Isolasi'],
            ['nama_kelas' => 'Isolasi Tekanan Negatif'],
        ]);
    }
}
