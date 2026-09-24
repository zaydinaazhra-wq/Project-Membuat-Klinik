<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservasi;

class ReservasiController extends Controller
{
    public function index()
    {
        $reservasis = Reservasi::orderBy('created_at', 'desc')->get();
        return view('back.reservasi.index', compact('reservasis'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,selesai,batal',
        ]);

        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status reservasi berhasil diperbarui!');
    }
}
