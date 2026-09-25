<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index()
    {
        return view('front.reservasi');
    }

    // Menyimpan data reservasi dari pengunjung
    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'kontak'  => 'required|string|max:20',
            'alamat'  => 'required|string',
            'hari'    => 'required|date',
            'jam'     => 'required',
            'keluhan' => 'required|string',
        ]);

        Reservasi::create([
            'nama'    => $request->nama,
            'kontak'  => $request->kontak,
            'alamat'  => $request->alamat,
            'hari'    => $request->hari,
            'jam'     => $request->jam,
            'keluhan' => $request->keluhan,
            'status'  => 'menunggu',
        ]);

        $nomorWA = '6283170325118'; // Nomor WA Admin Klinik

        $pesan  = "*HALO ADMIN HEALTHPOINT CLINIC*\n";
        $pesan .= "Saya ingin mengonfirmasi pendaftaran reservasi online:\n\n";
        $pesan .= "*Nama Lengkap:* " . $request->nama . "\n";
        $pesan .= "*No. WhatsApp:* " . $request->kontak . "\n";
        $pesan .= "*Alamat:* " . $request->alamat . "\n";
        $pesan .= "*Tanggal Kunjungan:* " . date('d-m-Y', strtotime($request->hari)) . "\n";
        $pesan .= "*Jam Kunjungan:* " . date('H:i', strtotime($request->jam)) . " WIB\n";
        $pesan .= "*Keluhan:* " . $request->keluhan . "\n\n";
        $pesan .= "Mohon konfirmasi jadwal reservasi saya. Terima kasih!";

        $urlWhatsApp = "https://wa.me/{$nomorWA}?text=" . urlencode($pesan);

        return redirect()->away($urlWhatsApp);
    }
}
