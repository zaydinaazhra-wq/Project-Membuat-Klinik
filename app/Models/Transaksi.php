<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pasien',
        'nik_pasien',
        'umur_pasien',
        'no_wa_pasien',
        'kategori_pemeriksaan',
        'obat_id',
        'qty_obat',
        'kategori_pembayaran',
        'total_bayar',
        'catatan',
        'diagnosis',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }

    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'transaksi_obat')
                    ->withPivot('qty', 'harga')
                    ->withTimestamps();
    }
}
