<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\ObatRequest;
use App\Http\Requests\UpdateObatRequest; // Jika menggunakan Request khusus update
use App\Models\Obat;
use Illuminate\Support\Facades\Storage;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obats = Obat::latest()->get();
        return view('back.obat.index', compact('obats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ObatRequest $request)
    {
        $data = $request->validated();

        // Proses simpan foto jika ada yang diupload
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('obats', 'public');
        }

        Obat::create($data);

        return redirect()->route('back.obat.index')->with('success', 'Obat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $obats = Obat::findOrFail($id);
        return view('back.obat.show', compact('obats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $obat = Obat::findOrFail($id);
        return view('back.obat.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateObatRequest $request, string $id)
    {
        $data = $request->validated();
        $obat = Obat::findOrFail($id);

        if ($request->hasFile('foto')) {
            // Hapus foto lama dari storage jika ada
            if ($obat->foto && Storage::disk('public')->exists($obat->foto)) {
                Storage::disk('public')->delete($obat->foto);
            }
            // Simpan foto baru
            $data['foto'] = $request->file('foto')->store('obats', 'public');
        } else {
            // JIKA TIDAK ADA FOTO BARU: Pertahankan foto lama
            $data['foto'] = $obat->foto;
        }

        $obat->update($data);

        return redirect()->route('back.obat.index')->with('success', 'Data obat berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obat = Obat::findOrFail($id);

        // Hapus foto dari storage saat data dihapus
        if ($obat->foto && Storage::disk('public')->exists($obat->foto)) {
            Storage::disk('public')->delete($obat->foto);
        }

        $obat->delete();

        return redirect()->route('back.obat.index')->with('error', 'Data obat berhasil dihapus!');
    }

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->check() && auth()->user()->role !== 'admin') {
                abort(403, 'Maaf, halaman ini khusus untuk Admin.');
            }
            return $next($request);
        });
    }
}
