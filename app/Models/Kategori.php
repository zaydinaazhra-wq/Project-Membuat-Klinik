<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    public function run(): void
    {
        Kategori::create(['nama_kategori' => 'Tablet']);
        Kategori::create(['nama_kategori' => 'Sirup']);
    }
}
