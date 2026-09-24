<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Obat;

class KategoriObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Obat::whereNull('kategori')->orWhere('kategori', '')->update([
            'kategori' => 'Tablet'
        ]);
    }
}
