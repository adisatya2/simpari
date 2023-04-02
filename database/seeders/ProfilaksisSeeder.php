<?php

namespace Database\Seeders;

use App\Models\Profilaksis;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfilaksisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Profilaksis::truncate();
        Schema::enableForeignKeyConstraints();

        Profilaksis::insert([
            [
                'nama_obat' => 'Amoxicillin',
                'golongan' => 'Penisilin'
            ],
            [
                'nama_obat' => 'Ampicillin',
                'golongan' => 'Penisilin'
            ],
            [
                'nama_obat' => 'Oxacillin',
                'golongan' => 'Penisilin'
            ],
            [
                'nama_obat' => 'Penicillin G',
                'golongan' => 'Penisilin'
            ],
            [
                'nama_obat' => 'Penicillin VK',
                'golongan' => 'Penisilin'
            ],
            [
                'nama_obat' => 'Cefaclor',
                'golongan' => 'Sefalosporin'
            ],
            [
                'nama_obat' => 'Cefadroxil',
                'golongan' => 'Sefalosporin'
            ],
            [
                'nama_obat' => 'Cefdinir',
                'golongan' => 'Sefalosporin'
            ],
            [
                'nama_obat' => 'Cefprozil',
                'golongan' => 'Sefalosporin'
            ],
            [
                'nama_obat' => 'Cefepime',
                'golongan' => 'Sefalosporin'
            ],
            [
                'nama_obat' => 'Cefotaxime',
                'golongan' => 'Sefalosporin'
            ],
            [
                'nama_obat' => 'Ceftaroline',
                'golongan' => 'Sefalosporin'
            ],
            [
                'nama_obat' => 'Ceftazidime',
                'golongan' => 'Sefalosporin'
            ],
            [
                'nama_obat' => 'Cefuroxime',
                'golongan' => 'Sefalosporin'
            ],
            [
                'nama_obat' => 'Ceftriaxone',
                'golongan' => 'Sefalosporin'
            ],
            [
                'nama_obat' => 'Cephalexin',
                'golongan' => 'Sefalosporin'
            ],
            [
                'nama_obat' => 'Cefazolin',
                'golongan' => 'Sefalosporin'
            ],
            [
                'nama_obat' => 'Cefixime',
                'golongan' => 'Sefalosporin'
            ],
            [
                'nama_obat' => 'Cefoperazone',
                'golongan' => 'Sefalosporin'
            ],
            [
                'nama_obat' => 'Cefditoren',
                'golongan' => 'Sefalosporin'
            ],
            [
                'nama_obat' => 'Paromomycin',
                'golongan' => 'Aminoglikosida'
            ],
            [
                'nama_obat' => 'Amikacin',
                'golongan' => 'Aminoglikosida'
            ],
            [
                'nama_obat' => 'Gentamicin',
                'golongan' => 'Aminoglikosida'
            ],
            [
                'nama_obat' => 'Tobramycin',
                'golongan' => 'Aminoglikosida'
            ],
            [
                'nama_obat' => 'Kanamycin',
                'golongan' => 'Aminoglikosida'
            ],
            [
                'nama_obat' => 'Neomycin',
                'golongan' => 'Aminoglikosida'
            ],
            [
                'nama_obat' => 'Demeclocycline',
                'golongan' => 'Tetrasiklin'
            ],
            [
                'nama_obat' => 'Doxycycline',
                'golongan' => 'Tetrasiklin'
            ],
            [
                'nama_obat' => 'Minocycline',
                'golongan' => 'Tetrasiklin'
            ],
            [
                'nama_obat' => 'Oxytetracycline',
                'golongan' => 'Tetrasiklin'
            ],
            [
                'nama_obat' => 'Tetracycline HCl',
                'golongan' => 'Tetrasiklin'
            ],
            [
                'nama_obat' => 'Tigecycline',
                'golongan' => 'Tetrasiklin'
            ],
            [
                'nama_obat' => 'Azithromycin',
                'golongan' => 'Makrolid'
            ],
            [
                'nama_obat' => 'Clarithromycin',
                'golongan' => 'Makrolid'
            ],
            [
                'nama_obat' => 'Erythromycin',
                'golongan' => 'Makrolid'
            ],
            [
                'nama_obat' => 'Ciprofloxacin',
                'golongan' => 'Quinolone'
            ],
            [
                'nama_obat' => 'Levofloxacin',
                'golongan' => 'Quinolone'
            ],
            [
                'nama_obat' => 'Moxifloxacin',
                'golongan' => 'Quinolone'
            ],
            [
                'nama_obat' => 'Norfloxacin',
                'golongan' => 'Quinolone'
            ],
            [
                'nama_obat' => 'Ofloxacin',
                'golongan' => 'Quinolone'
            ],
            [
                'nama_obat' => 'Sulfamethoxazole',
                'golongan' => 'Sulfa atau Sulfonamida'
            ],
            [
                'nama_obat' => 'Sulfadiazine',
                'golongan' => 'Sulfa atau Sulfonamida'
            ],
            [
                'nama_obat' => 'Sulfacetamide',
                'golongan' => 'Sulfa atau Sulfonamida'
            ],
            [
                'nama_obat' => 'Cotrimoxazole',
                'golongan' => 'Sulfa atau Sulfonamida'
            ],
            [
                'nama_obat' => 'Clindamycin',
                'golongan' => 'Lincosamide'
            ],
            [
                'nama_obat' => 'Lincomycin',
                'golongan' => 'Lincosamide'
            ],
            [
                'nama_obat' => 'Vancomycin',
                'golongan' => 'Glicopeptide'
            ],
            [
                'nama_obat' => 'Meropenem',
                'golongan' => 'Carbapenem'
            ],
            [
                'nama_obat' => 'Ertapenem',
                'golongan' => 'Carbapenem'
            ],
            [
                'nama_obat' => 'Imipenem-Cilastatin',
                'golongan' => 'Carbapenem'
            ],
            [
                'nama_obat' => 'Doripenem',
                'golongan' => 'Carbapenem'
            ],
            [
                'nama_obat' => 'Biapenem',
                'golongan' => 'Carbapenem'
            ],
        ]);
    }
}
