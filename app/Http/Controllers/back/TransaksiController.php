<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Obat;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->check() && auth()->user()->role !== 'admin') {
                abort(403, 'Maaf, halaman ini khusus untuk Admin.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $transaksis = Transaksi::with(['obats'])->latest()->get();
        return view('back.transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $obats = Obat::where('stok', '>', 0)->get();
        return view('back.transaksi.create', compact('obats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien'          => 'required|string|max:255',
            'nik_pasien'           => 'nullable|string|max:20',
            'umur_pasien'          => 'nullable|numeric',
            'no_wa_pasien'         => 'nullable|string|max:20',
            'kategori_pemeriksaan' => 'nullable|string',
            'kategori_pembayaran'  => 'required|in:UMUM,BPJS',
            'diagnosis'            => 'nullable|string',
            'catatan'              => 'nullable|string',
            'obats'                => 'nullable|array',
            'obats.*.id'           => 'nullable|exists:obats,id',
            'obats.*.qty'          => 'nullable|numeric|min:1',
        ]);

        DB::transaction(function () use ($request, &$transaksi) {
            $transaksi = Transaksi::create([
                'nama_pasien'          => $request->nama_pasien,
                'nik_pasien'           => $request->nik_pasien,
                'umur_pasien'          => $request->umur_pasien,
                'no_wa_pasien'         => $request->no_wa_pasien,
                'kategori_pemeriksaan' => $request->kategori_pemeriksaan,
                'kategori_pembayaran'  => $request->kategori_pembayaran,
                'total_bayar'          => 0,
                'diagnosis'            => $request->diagnosis,
                'catatan'              => $request->catatan,
            ]);

            $totalBayar = $this->attachObatsAndCalculate($transaksi, $request);
            $transaksi->update(['total_bayar' => $totalBayar]);
        });

        return redirect()->route('back.transaksi.index')->with('success', 'Transaksi berhasil disimpan dan stok obat telah berkurang!');
    }

    public function storePublic(Request $request)
    {
        DB::transaction(function () use ($request, &$transaksi) {
            $transaksi = Transaksi::create([
                'nama_pasien'          => $request->nama,
                'nik_pasien'           => $request->nik,
                'umur_pasien'          => $request->umur,
                'no_wa_pasien'         => $request->no_hp,
                'kategori_pemeriksaan' => $request->kategori,
                'kategori_pembayaran'  => $request->kategori_pembayaran ?? 'UMUM',
                'total_bayar'          => $request->total_bayar ?? 0,
                'catatan'              => $request->catatan,
                'diagnosis'            => $request->diagnosis ?? 'Pendaftaran Online Web',
            ]);

            if ($request->has('obats') && is_array($request->obats)) {
                foreach ($request->obats as $item) {
                    if (!empty($item['nama_obat'])) {
                        $obat = Obat::where('nama_obat', 'LIKE', '%' . $item['nama_obat'] . '%')->first();
                        if ($obat) {
                            $qty = $item['qty'] ?? 1;
                            $transaksi->obats()->attach($obat->id, [
                                'qty'   => $qty,
                                'harga' => $obat->harga
                            ]);

                            // POTONG STOK OBAT
                            $obat->decrement('stok', $qty);
                        }
                    }
                }
            }
        });

        return response()->json([
            'status'       => 'success',
            'message'      => 'Data transaksi berhasil disimpan!',
            'transaksi_id' => $transaksi->id
        ]);
    }

    public function show($id)
    {
        $transaksis = Transaksi::with(['obats'])->findOrFail($id);
        return view('back.transaksi.show', compact('transaksis'));
    }

    public function edit($id)
    {
        $transaksis = Transaksi::with(['obats'])->findOrFail($id);
        $obats = Obat::all();

        return view('back.transaksi.edit', compact('transaksis', 'obats'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pasien'          => 'required|string|max:255',
            'nik_pasien'           => 'nullable|string|max:20',
            'umur_pasien'          => 'nullable|numeric',
            'no_wa_pasien'         => 'nullable|string|max:20',
            'kategori_pemeriksaan' => 'nullable|string',
            'kategori_pembayaran'  => 'required|in:UMUM,BPJS',
            'diagnosis'            => 'nullable|string',
            'catatan'              => 'nullable|string',
            'obats'                => 'nullable|array',
            'obats.*.id'           => 'nullable|exists:obats,id',
            'obats.*.qty'          => 'nullable|numeric|min:1',
        ]);

        $transaksi = Transaksi::with('obats')->findOrFail($id);

        DB::transaction(function () use ($request, $transaksi) {
            foreach ($transaksi->obats as $obatLama) {
                $qtyLama = $obatLama->pivot->qty ?? 1;
                $obatLama->increment('stok', $qtyLama);
            }

            $transaksi->update([
                'nama_pasien'          => $request->nama_pasien,
                'nik_pasien'           => $request->nik_pasien,
                'umur_pasien'          => $request->umur_pasien,
                'no_wa_pasien'         => $request->no_wa_pasien,
                'kategori_pemeriksaan' => $request->kategori_pemeriksaan,
                'kategori_pembayaran'  => $request->kategori_pembayaran,
                'diagnosis'            => $request->diagnosis,
                'catatan'              => $request->catatan,
            ]);

            $transaksi->obats()->detach();

            $totalBayar = $this->attachObatsAndCalculate($transaksi, $request);
            $transaksi->update(['total_bayar' => $totalBayar]);
        });

        return redirect()->route('back.transaksi.index')->with('success', 'Data transaksi & stok obat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::with('obats')->findOrFail($id);

        DB::transaction(function () use ($transaksi) {
            foreach ($transaksi->obats as $obat) {
                $qty = $obat->pivot->qty ?? 1;
                $obat->increment('stok', $qty);
            }

            $transaksi->delete();
        });

        return redirect()->route('back.transaksi.index')->with('error', 'Data transaksi berhasil dihapus dan stok obat dikembalikan!');
    }

    public function cetak($id)
    {
        $transaksis = Transaksi::with(['obats'])->findOrFail($id);
        return view('back.transaksi.cetak', compact('transaksis'));
    }

    /**
     * Helper method untuk menyimpan daftar obat ke pivot, memotong stok & menghitung total bayar.
     */
    private function attachObatsAndCalculate(Transaksi $transaksi, Request $request): float
    {
        $totalBayar = 0;

        if ($request->filled('obats')) {
            foreach ($request->obats as $item) {
                if (!empty($item['id'])) {
                    $obat = Obat::find($item['id']);
                    $qty = $item['qty'] ?? 1;
                    $harga = $obat ? $obat->harga : 0;

                    if ($obat) {
                        $transaksi->obats()->attach($item['id'], [
                            'qty'   => $qty,
                            'harga' => $harga,
                        ]);

                        $obat->decrement('stok', $qty);

                        if ($request->kategori_pembayaran === 'UMUM') {
                            $totalBayar += ($harga * $qty);
                        }
                    }
                }
            }
        }

        return $totalBayar;
    }

    public function exportExcel(Request $request)
    {
        $request->validate([
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date|after_or_equal:tgl_awal',
        ]);

        $tglAwal = $request->input('tgl_awal');
        $tglAkhir = $request->input('tgl_akhir');

        $fileName = 'rekap-transaksi-' . $tglAwal . '-s.d-' . $tglAkhir . '.xlsx';

        return Excel::download(new TransaksiExport($tglAwal, $tglAkhir), $fileName);
    }
}
