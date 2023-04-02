<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AlatInvasif;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AgamaSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(ProfilaksisSeeder::class);
        $this->call(AlatInvasifSeeder::class);
        $this->call(IadpBundleSeeder::class);
        $this->call(IadpGejalaSeeder::class);
        $this->call(IdoBundleSeeder::class);
        $this->call(IdoGejalaSeeder::class);
        $this->call(IskBundleSeeder::class);
        $this->call(IskGejalaSeeder::class);
        $this->call(PhlebitisBundleSeeder::class);
        $this->call(PhlebitisGejalaSeeder::class);
        $this->call(VapBundleSeeder::class);
        $this->call(VapGejalaSeeder::class);
        $this->call(LokasiCatheterSeeder::class);
        $this->call(JenisCairanSeeder::class);
    }
}
