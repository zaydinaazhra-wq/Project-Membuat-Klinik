@extends('back.layout.template')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="fa-solid fa-circle-info me-2"></i>Detail Transaksi Pasien</h1>
        <div>
            <a href="{{ route('back.transaksi.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Kembali</a>
            <a href="{{ route('back.transaksi.cetak', $transaksis->id) }}" class="btn btn-success" target="_blank"><i class="fa-solid fa-receipt me-1"></i> Lihat Bukti Pembayaran</a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h3 class="fw-bold text-primary mb-0">{{ $transaksis->nama_pasien }}</h3>
                    <small class="text-muted">Tanggal Transaksi: {{ $transaksis->created_at ? $transaksis->created_at->format('d F Y - H:i') . ' WIB' : '-' }}</small>
                </div>
                <span class="badge bg-warning fs-6 px-3 py-2 text-dark">Kategori: {{ $transaksis->kategori_pembayaran }}</span>
            </div>

            <hr>

            <div class="row g-4">
                <!-- Informasi Pasien -->
                <div class="col-md-5">
                    <h5 class="fw-bold"><i class="fa-solid fa-user me-2"></i>Informasi Pasien</h5>
                    <table class="table table-borderless mt-3">
                        <tr>
                            <td class="fw-bold" style="width: 40%;">NIK</td>
                            <td>: {{ $transaksis->nik_pasien ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Umur</td>
                            <td>: {{ $transaksis->umur_pasien ? $transaksis->umur_pasien . ' Tahun' : '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">No. WhatsApp / HP</td>
                            <td>: {{ $transaksis->no_wa_pasien ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Kategori Layanan</td>
                            <td>: {{ $transaksis->kategori_pemeriksaan ?? '-' }}</td>
                        </tr>
                    </table>
                </div>

                <!-- Rincian Medis & Tabel Obat -->
                <div class="col-md-7">
                    <h5 class="fw-bold"><i class="fa-solid fa-prescription-bottle-medical me-2"></i>Rincian Obat & Tagihan</h5>

                    <table class="table table-bordered align-middle mt-3">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Obat</th>
                                <th class="text-center" style="width: 100px;">Qty</th>
                                <th class="text-end">Harga Satuan</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksis->obats as $o)
                                <tr>
                                    <td>{{ $o->nama_obat }}</td>
                                    <td class="text-center">{{ $o->pivot->qty ?? 1 }} Pcs</td>
                                    <td class="text-end">Rp {{ number_format($o->pivot->harga ?? $o->harga, 0, ',', '.') }}</td>
                                    <td class="text-end">Rp {{ number_format(($o->pivot->harga ?? $o->harga) * ($o->pivot->qty ?? 1), 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Tanpa Obat / Resep Kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr class="table-light fw-bold">
                                <td colspan="3" class="text-end">Total Tagihan:</td>
                                <td class="text-end text-primary fs-5">Rp {{ number_format($transaksis->total_bayar, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold"><i class="fa-solid fa-stethoscope me-1"></i> Diagnosis Dokter</label>
                    <div class="p-3 bg-light rounded border">{{ $transaksis->diagnosis ?? '-' }}</div>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold"><i class="fa-solid fa-note-sticky me-1"></i> Catatan Tambahan</label>
                    <div class="p-3 bg-light rounded border">{{ $transaksis->catatan ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
