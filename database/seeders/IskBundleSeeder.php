<?php

namespace Database\Seeders;

use App\Models\IskBundle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IskBundleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        IskBundle::truncate();
        Schema::enableForeignKeyConstraints();

        IskBundle::insert([
            ['bundle' => 'Pemasangan Kateter Sesuai Indikasi'],
            ['bundle' => 'Kebersihan Tangan'],
            ['bundle' => 'Pemasangan Menggunakan Alat Steril'],
            ['bundle' => 'Menggunakan APD yang Tepat'],
            ['bundle' => 'Tidak Meletakkan Urine Bag di Lantai'],
            ['bundle' => 'Segera Lepas Jika Tidak Indikasi'],
            ['bundle' => 'Lakukan Vulva dan Penis Hygine Saat Pasien Mandi'],
        ]);
    }
}
