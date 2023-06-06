<?php

namespace Database\Seeders;

use App\Models\CabangHermina;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CabangHerminaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        CabangHermina::truncate();
        Schema::enableForeignKeyConstraints();

        CabangHermina::insert([
            [
                'kode_rs' => '001',
                'nama_cabang' => 'Hermina Jatinegara',
            ],
            [
                'kode_rs' => '002',
                'nama_cabang' => 'Hermina Kemayoran',
            ],
            [
                'kode_rs' => '003',
                'nama_cabang' => 'Hermina Bekasi',
            ],
            [
                'kode_rs' => '004',
                'nama_cabang' => 'Hermina Depok',
            ],
            [
                'kode_rs' => '005',
                'nama_cabang' => 'Hermina Daan Mogot',
            ],
            [
                'kode_rs' => '006',
                'nama_cabang' => 'Hermina Bogor',
            ],
            [
                'kode_rs' => '007',
                'nama_cabang' => 'Hermina Pasteur',
            ],
            [
                'kode_rs' => '008',
                'nama_cabang' => 'Hermina Pandanaran',
            ],
            [
                'kode_rs' => '009',
                'nama_cabang' => 'Hermina Tangkuban Perahu',
            ],
            [
                'kode_rs' => '010',
                'nama_cabang' => 'Hermina Sukabumi',
            ],
            [
                'kode_rs' => '011',
                'nama_cabang' => 'Hermina Tanggerang',
            ],
            [
                'kode_rs' => '012',
                'nama_cabang' => 'Hermina Grand Wisata',
            ],
            [
                'kode_rs' => '013',
                'nama_cabang' => 'Hermina Arcamanik',
            ],
            [
                'kode_rs' => '014',
                'nama_cabang' => 'Hermina Galaxy',
            ],
            [
                'kode_rs' => '015',
                'nama_cabang' => 'Hermina Palembang',
            ],
            [
                'kode_rs' => '016',
                'nama_cabang' => 'Hermina Ciputat',
            ],
            [
                'kode_rs' => '017',
                'nama_cabang' => 'Hermina Mekarsari',
            ],
            [
                'kode_rs' => '018',
                'nama_cabang' => 'Hermina Serpong',
            ],
            [
                'kode_rs' => '019',
                'nama_cabang' => 'Hermina Banyumanik',
            ],
            [
                'kode_rs' => '020',
                'nama_cabang' => 'Hermina Solo',
            ],
            [
                'kode_rs' => '021',
                'nama_cabang' => 'Hermina Serpong',
            ],
            [
                'kode_rs' => '022',
                'nama_cabang' => 'Hermina Yogya',
            ],
            [
                'kode_rs' => '023',
                'nama_cabang' => 'Hermina Bitung',
            ],
            [
                'kode_rs' => '024',
                'nama_cabang' => 'Hermina Makassar',
            ],
            [
                'kode_rs' => '025',
                'nama_cabang' => 'Hermina Balikpapan',
            ],
            [
                'kode_rs' => '026',
                'nama_cabang' => 'Hermina Medan',
            ],
            [
                'kode_rs' => '027',
                'nama_cabang' => 'Hermina Podomoro',
            ],
            [
                'kode_rs' => '028',
                'nama_cabang' => 'Hermina Purwokerto',
            ],
            [
                'kode_rs' => '029',
                'nama_cabang' => 'Hermina Samarinda',
            ],
            [
                'kode_rs' => '030',
                'nama_cabang' => 'Hermina Opi Jakabaring',
            ],
            [
                'kode_rs' => '031',
                'nama_cabang' => 'Hermina Padang',
            ],
            [
                'kode_rs' => '032',
                'nama_cabang' => 'Hermina Lampung',
            ],
            [
                'kode_rs' => '033',
                'nama_cabang' => 'Hermina Pekalongan',
            ],
            [
                'kode_rs' => '034',
                'nama_cabang' => 'Hermina Pekanbaru',
            ],
            [
                'kode_rs' => '035',
                'nama_cabang' => 'Hermina Kendari',
            ],
            [
                'kode_rs' => '036',
                'nama_cabang' => 'Hermina Wonogiri',
            ],
            [
                'kode_rs' => '037',
                'nama_cabang' => 'Hermina Karawang',
            ],
            [
                'kode_rs' => '038',
                'nama_cabang' => 'Hermina Manado',
            ],
            [
                'kode_rs' => '039',
                'nama_cabang' => 'Hermina Periuk Tanggerang',
            ],
            [
                'kode_rs' => '040',
                'nama_cabang' => 'Hermina Salatiga',
            ],
            [
                'kode_rs' => '041',
                'nama_cabang' => 'Hermina Ciledug',
            ],
            [
                'kode_rs' => '042',
                'nama_cabang' => 'Hermina Metland Cibitung',
            ],
            [
                'kode_rs' => '043',
                'nama_cabang' => 'Hermina Cilegon',
            ],
            [
                'kode_rs' => '044',
                'nama_cabang' => 'Hermina Soreang',
            ],
            [
                'kode_rs' => '045',
                'nama_cabang' => 'Hermina Tasikmalaya',
            ],

        ]);
    }
}
