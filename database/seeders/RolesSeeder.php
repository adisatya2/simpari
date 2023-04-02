<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Schema::enableForeignKeyConstraints();

        Role::insert([
            ["name" => "DIREKTUR", "guard_name" => "web"],
            ["name" => "WAKIL DIREKTUR UMUM", "guard_name" => "web"],
            ["name" => "WAKIL DIREKTUR MEDIS", "guard_name" => "web"],
            ["name" => "IT SUPPORT", "guard_name" => "web"],
            ["name" => "SEKRETARIS DIREKTUR", "guard_name" => "web"],
            ["name" => "SPI (SATUAN PENGAWAS INTERNAL)", "guard_name" => "web"],
            ["name" => "KOMITE KEPERAWATAN", "guard_name" => "web"],
            ["name" => "KEPALA JAGA", "guard_name" => "web"],
            ["name" => "EKSEKUTIF - MANAJER", "guard_name" => "web"],
            ["name" => "EKSEKUTIF - PELAKSANA", "guard_name" => "web"],
            ["name" => "JKN/CASEMIX - MANAJER", "guard_name" => "web"],
            ["name" => "JKN/CASEMIX - PELAKSANA CODER", "guard_name" => "web"],
            ["name" => "JKN/CASEMIX - PELAKSANA PEMBERKASAN", "guard_name" => "web"],
            ["name" => "KEPERAWATAN - MANAJER", "guard_name" => "web"],
            ["name" => "KEPERAWATAN - KAPER INSTALASI GAWAT DARURAT", "guard_name" => "web"],
            ["name" => "KEPERAWATAN - KAPER KAMAR BERSALIN (VK)", "guard_name" => "web"],
            ["name" => "KEPERAWATAN - KAPER KAMAR OPERASI (OK)", "guard_name" => "web"],
            ["name" => "KEPERAWATAN - KAPER POLIKLINIK", "guard_name" => "web"],
            ["name" => "KEPERAWATAN - KAPER RUANGAN RAWAT INAP", "guard_name" => "web"],
            ["name" => "KEPERAWATAN - PERAWAT IGD", "guard_name" => "web"],
            ["name" => "KEPERAWATAN - PERAWAT POLIKLINIK RAWAT JALAN", "guard_name" => "web"],
            ["name" => "KEPERAWATAN - PERAWAT RUANGAN RAWAT INAP", "guard_name" => "web"],
            ["name" => "KEUANGAN - MANAJER", "guard_name" => "web"],
            ["name" => "KEUANGAN - KAUR", "guard_name" => "web"],
            ["name" => "KEUANGAN - PELAKSANA ADM. RAWAT INAP", "guard_name" => "web"],
            ["name" => "KEUANGAN - PELAKSANA GL/AKUNTANSI", "guard_name" => "web"],
            ["name" => "KEUANGAN - PELAKSANA HONOR DOKTER", "guard_name" => "web"],
            ["name" => "KEUANGAN - PELAKSANA HUTANG", "guard_name" => "web"],
            ["name" => "KEUANGAN - PELAKSANA KASIR", "guard_name" => "web"],
            ["name" => "KEUANGAN - PELAKSANA PAJAK", "guard_name" => "web"],
            ["name" => "KEUANGAN - PELAKSANA PIUTANG", "guard_name" => "web"],
            ["name" => "MARKETING - MANAJER", "guard_name" => "web"],
            ["name" => "MARKETING - KAUR BACK OFFICE", "guard_name" => "web"],
            ["name" => "MARKETING - KAUR FRONT OFFICE", "guard_name" => "web"],
            ["name" => "MARKETING - PELAKSANA BACK OFFICE", "guard_name" => "web"],
            ["name" => "MARKETING - PELAKSANA FRONT OFFICE", "guard_name" => "web"],
            ["name" => "MUTU DAN AKREDITASI - MANAJER", "guard_name" => "web"],
            ["name" => "MUTU DAN AKREDITASI - PELAKSANA", "guard_name" => "web"],
            ["name" => "PELAYANAN MEDIS - MANAJER", "guard_name" => "web"],
            ["name" => "PELAYANAN MEDIS - DOKTER IGD/RUANGAN", "guard_name" => "web"],
            ["name" => "PELAYANAN MEDIS - KAINS INSTALASI GAWAT DARURAT", "guard_name" => "web"],
            ["name" => "PELAYANAN MEDIS - KAINS RAWAT INAP", "guard_name" => "web"],
            ["name" => "PELAYANAN MEDIS - KAINS RAWAT JALAN", "guard_name" => "web"],
            ["name" => "PENUNJANG MEDIS - KAINS/KAUR FARMASI", "guard_name" => "web"],
            ["name" => "PENUNJANG MEDIS - KAINS/KAUR LABORATORIUM", "guard_name" => "web"],
            ["name" => "PENUNJANG MEDIS - KAINS/KAUR RADIOLOGI", "guard_name" => "web"],
            ["name" => "PENUNJANG MEDIS - KAINS/KAUR REKAM MEDIS", "guard_name" => "web"],
            ["name" => "PENUNJANG MEDIS - MANAJER", "guard_name" => "web"],
            ["name" => "PENUNJANG MEDIS - PELAKSANA FARMASI", "guard_name" => "web"],
            ["name" => "PENUNJANG MEDIS - PELAKSANA LABORATORIUM", "guard_name" => "web"],
            ["name" => "PENUNJANG MEDIS - PELAKSANA RADIOLOGI", "guard_name" => "web"],
            ["name" => "PENUNJANG MEDIS - PELAKSANA REKAM MEDIS", "guard_name" => "web"],
            ["name" => "PENUNJANG UMUM - MANAJER", "guard_name" => "web"],
            ["name" => "PENUNJANG UMUM - KAUR GIZI & TATA BOGA", "guard_name" => "web"],
            ["name" => "PENUNJANG UMUM - KAUR LAUNDRY", "guard_name" => "web"],
            ["name" => "PENUNJANG UMUM - KAUR PAM & YANUM", "guard_name" => "web"],
            ["name" => "PENUNJANG UMUM - KAUR TATA GRAHA & KESLING", "guard_name" => "web"],
            ["name" => "PENUNJANG UMUM - KAUR UPSRS", "guard_name" => "web"],
            ["name" => "PENUNJANG UMUM - PELAKSANA GIZI & TATA BOGA", "guard_name" => "web"],
            ["name" => "PENUNJANG UMUM - PELAKSANA LAUNDRY", "guard_name" => "web"],
            ["name" => "PENUNJANG UMUM - PELAKSANA PAM & YANUM", "guard_name" => "web"],
            ["name" => "PENUNJANG UMUM - PELAKSANA TATA GRAHA & KESLING", "guard_name" => "web"],
            ["name" => "PENUNJANG UMUM - TEKNISI ALKES", "guard_name" => "web"],
            ["name" => "PENUNJANG UMUM - TEKNISI ALUM", "guard_name" => "web"],
            ["name" => "PERSONALIA/HRD - MANAJER", "guard_name" => "web"],
            ["name" => "PERSONALIA/HRD - KAUR DIKLAT", "guard_name" => "web"],
            ["name" => "PERSONALIA/HRD - PELAKSANA DIKLAT", "guard_name" => "web"],
            ["name" => "IPCN/PPI", "guard_name" => "web"],
        ]);
    }
}
