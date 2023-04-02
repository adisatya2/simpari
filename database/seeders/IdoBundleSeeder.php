<?php

namespace Database\Seeders;

use App\Models\IdoBundle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IdoBundleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        IdoBundle::truncate();
        Schema::enableForeignKeyConstraints();

        IdoBundle::insert([
            [
                'waktu' => 'Pre Operasi',
                'bundle' => 'Pencukuran Menggunakan Cliper Jika Menggangu Jalannya Operasi',
            ],
            [
                'waktu' => 'Pre Operasi',
                'bundle' => 'Antibiotik Profilaksis 30-60 Menit Sebelum Insisi',
            ],
            [
                'waktu' => 'Pre Operasi',
                'bundle' => 'Mandi Sebelum Tindakan Menggunakan Antiseptik',
            ],
            [
                'waktu' => 'Pre Operasi',
                'bundle' => 'Kadar Gula Darah Terkontrol',
            ],
            [
                'waktu' => 'Intra Operasi',
                'bundle' => 'Kebersihan Tangan Dengan Surgical Antiseptik',
            ],
            [
                'waktu' => 'Intra Operasi',
                'bundle' => 'Sterilisasi Alat Instrumen Bedah Steril',
            ],
            [
                'waktu' => 'Intra Operasi',
                'bundle' => 'Menggunakan Antiseptik Untuk Skin Preparasi',
            ],
            [
                'waktu' => 'Intra Operasi',
                'bundle' => 'Batasi Jumlah Orang Yang Masuk di Kamar Bedah',
            ],
            [
                'waktu' => 'Intra Operasi',
                'bundle' => 'Pertahankan Tekanan Positif di Kamar Bedah',
            ],
            [
                'waktu' => 'Post Operasi',
                'bundle' => 'Luka Ditutup 2x24 Jam Pasca Bedah',
            ],
            [
                'waktu' => 'Post Operasi',
                'bundle' => 'Rawat Luka Dengan Teknik Septik dan Aseptik',
            ],
            [
                'waktu' => 'Post Operasi',
                'bundle' => 'Penkes Tentang Gizi, Mobilisasi, Kebersihan Diri dan Perawatan Luka',
            ],
            [
                'waktu' => 'Post Operasi',
                'bundle' => 'Menggunakan APD Saat Merawat Luka',
            ],
        ]);
    }
}
