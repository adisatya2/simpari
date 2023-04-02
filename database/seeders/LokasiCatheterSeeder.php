<?php

namespace Database\Seeders;

use App\Models\LokasiCatheter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LokasiCatheterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        LokasiCatheter::truncate();
        Schema::enableForeignKeyConstraints();

        LokasiCatheter::insert([
            [
                'lokasi' => 'Vena Subclavia',
                'lokasi2' => 'di dada',
            ],
            [
                'lokasi' => 'Vena Jugularis Interna',
                'lokasi2' => 'di leher',
            ],
            [
                'lokasi' => 'Vena Mediana Cubiti',
                'lokasi2' => 'di lengan bawah',
            ],
            [
                'lokasi' => 'Vena Dorsalis Superfisialis',
                'lokasi2' => 'di punggung tangan yang berasal dari gabungan vena-vena digitalis yang berasal dari jari-jari tangan',
            ],
            [
                'lokasi' => 'Vena Digitalis',
                'lokasi2' => 'di punggung tangan yang mengalir di sepanjang sisi lateral jari tangan',
            ],
            [
                'lokasi' => 'Vena Sefalika',
                'lokasi2' => 'di lengan bagian bawah pada posisi radial lengan yang posisinya sejajar dengan ibu jari',
            ],
            [
                'lokasi' => 'Vena Basilika',
                'lokasi2' => 'sisi ulnaris lengan bawah',
            ],
            [
                'lokasi' => 'Vena Umbilikalis',
                'lokasi2' => 'di tali pusat alias umbilical cord',
            ],
            [
                'lokasi' => 'Vena Femoralis',
                'lokasi2' => 'di paha bagian atas dan rongga panggul',
            ],
            [
                'lokasi' => 'Vena Dorsalis Pedis',
                'lokasi2' => 'di bagian lateral dari tendon extensor midfoot',
            ],
        ]);
    }
}
