<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenagaMedis extends Model
{
    protected $fillable =
    [
        'nama',
        'posisi',
        'spesialis',
        'jadwal_praktek',
        'foto'
  ];
}
