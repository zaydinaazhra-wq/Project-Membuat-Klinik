<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\TenagaMedisRequest;
use App\Http\Requests\UpdateTenagaMedisRequest;
use App\Models\TenagaMedis;
use Illuminate\Support\Facades\Storage;

class TenagaMedisController extends Controller
{
    public function index()
    {
        $tenagaMedis = TenagaMedis::latest()->get();
        return view('back.tenaga_medis.index', compact('tenagaMedis'));
    }

    public function create()
    {
        return view('back.tenaga_medis.create');
    }

    public function store(TenagaMedisRequest $request)
    {
        $data = $request->validated([
            'nama' => 'required',
            'posisi' => 'required',
            'jadwal_praktek' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('tenaga_medis', 'public');
        }

        TenagaMedis::create($data);

        return redirect()->route('back.tenaga-medis.index')->with('success', 'Data berhasil disimpan!');
    }

    public function show($id)
    {
        $tenagaMedis = TenagaMedis::findOrFail($id);
        return view('back.tenaga_medis.show', compact('tenagaMedis'));
    }

    public function edit(string $id)
    {
        $tenagaMedis = TenagaMedis::findOrFail($id);
        return view('back.tenaga_medis.edit', compact('tenagaMedis'));
    }

    public function update(UpdateTenagaMedisRequest $request, string $id)
    {
        $data = $request->validated([
            'nama' => 'required',
            'posisi' => 'required',
            'jadwal_praktek' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $tenagaMedis = TenagaMedis::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($tenagaMedis->foto) {
                Storage::disk('public')->delete($tenagaMedis->foto);
            }
            $data['foto'] = $request->file('foto')->store('tenaga_medis', 'public');
        }

        $tenagaMedis->update($data);

        return redirect()->route('back.tenaga-medis.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $tenagaMedis = TenagaMedis::findOrFail($id);

        if ($tenagaMedis->foto) {
            Storage::disk('public')->delete($tenagaMedis->foto);
        }

        $tenagaMedis->delete();

        return redirect()->route('back.tenaga-medis.index')->with('error', 'Data berhasil dihapus!');
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
