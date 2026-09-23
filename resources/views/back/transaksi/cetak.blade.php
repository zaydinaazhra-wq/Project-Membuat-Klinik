@extends('back.layout.template')

@section('content')
<style>
    .receipt-box {
        background: #fff;
        border: 2px solid #e3e6f0;
        border-radius: 12px;
        padding: 35px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
    }

    .receipt-header {
        border-bottom: 3px double #0d6efd;
        padding-bottom: 15px;
        margin-bottom: 25px;
    }

    .receipt-title {
        letter-spacing: 1px;
        color: #0d6efd;
    }

    .table-receipt th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
    }

    @media print {
        body * {
            visibility: hidden;
        }

        .receipt-box,
        .receipt-box * {
            visibility: visible;
        }

        .receipt-box {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: 1px solid #000 !important;
            box-shadow: none !important;
            padding: 20px !important;
        }

        .no-print {
            display: none !important;
        }

        .receipt-header {
            border-bottom: 2px solid #000 !important;
        }
    }
</style>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom no-print">
        <h1 class="h3 text-gray-800"><i class="fa-solid fa-file-invoice-dollar me-2 text-primary"></i>Bukti Pembayaran</h1>
        <div>
            <a href="{{ route('back.transaksi.show', $transaksis->id) }}" class="btn btn-secondary btn-sm me-1">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Detail
            </a>
            <button onclick="window.print()" class="btn btn-primary btn-sm">
                <i class="fa-solid fa-print me-1"></i> Cetak Kuitansi
            </button>
        </div>
    </div>

    <div class="receipt-box">
        <div class="receipt-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <img src="{{ asset('image/logo.png') }}" alt="Logo Klinik" style="max-height: 50px; width: auto;">

                <div>
                    <h3 class="fw-bold mb-0 text-uppercase receipt-title">HealthPoint Clinic</h3>
                    <p class="text-muted mb-0 small">Jl. Merdeka No.68, Sekayu, Musi Banyuasin, Sumatera Selatan 30711 | Telp: (021) 555-0199</p>
                </div>
            </div>

            <div class="text-end">
                <span class="badge bg-primary px-3 py-2 fs-6 text-uppercase mb-2">BUKTI PEMBAYARAN</span>
                <div class="fw-bold text-dark">No. Ref: #TRX-{{ str_pad($transaksis->id, 5, '0', STR_PAD_LEFT) }}</div>
                <small class="text-muted">Tanggal: {{ $transaksis->created_at ? $transaksis->created_at->format('d/m/Y H:i') : date('d/m/Y H:i') }} WIB</small>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-6">
                <div class="p-3 rounded bg-light border">
                    <h6 class="fw-bold text-primary mb-2 text-uppercase"><i class="fa-solid fa-user-injured me-2"></i>Data Pasien</h6>
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <td class="text-muted" style="width: 110px;">Nama Pasien</td>
                            <td class="fw-bold">: {{ $transaksis->nama_pasien }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">NIK</td>
                            <td>: {{ $transaksis->nik_pasien ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Umur</td>
                            <td>: {{ $transaksis->umur_pasien ? $transaksis->umur_pasien . ' Tahun' : '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="col-6">
                <div class="p-3 rounded bg-light border h-100">
                    <h6 class="fw-bold text-primary mb-2 text-uppercase"><i class="fa-solid fa-info-circle me-2"></i>Info Layanan</h6>
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <td class="text-muted" style="width: 120px;">Jenis Layanan</td>
                            <td class="fw-bold">: {{ $transaksis->kategori_pemeriksaan ?? 'Pemeriksaan Umum' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Jalur Bayar</td>
                            <td>:
                                <span class="badge {{ $transaksis->kategori_pembayaran == 'BPJS' ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $transaksis->kategori_pembayaran }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Status Nota</td>
                            <td class="fw-bold text-success">: LUNAS</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="table-responsive mb-4">
            <table class="table table-bordered table-receipt align-middle">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th>Deskripsi Layanan / Obat</th>
                        <th class="text-center" style="width: 100px;">Jumlah</th>
                        <th class="text-end" style="width: 150px;">Harga Satuan</th>
                        <th class="text-end" style="width: 180px;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>
                            <div class="fw-bold">{{ $transaksis->kategori_pemeriksaan ?? 'Pemeriksaan Medis Dokter' }}</div>
                            <small class="text-muted">Jasa tindakan & konsultasi kesehatan</small>
                        </td>
                        <td class="text-center">1 Layanan</td>
                        <td class="text-end">Rp 0</td>
                        <td class="text-end">Rp 0</td>
                    </tr>

                    @php $no = 2; @endphp
                    @forelse($transaksis->obats as $o)
                        @php
                            $qty = $o->pivot->qty ?? 1;
                            $harga = $o->pivot->harga ?? $o->harga;
                            $subtotal = $qty * $harga;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>
                                <div class="fw-bold">{{ $o->nama_obat }}</div>
                                <small class="text-muted">Pemberian resep obat medis</small>
                            </td>
                            <td class="text-center">{{ $qty }} Pcs</td>
                            <td class="text-end">Rp {{ number_format($harga, 0, ',', '.') }}</td>
                            <td class="text-end">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center">2</td>
                            <td>
                                <div class="fw-bold">Tanpa Obat / Resep Luar</div>
                                <small class="text-muted">Pemberian resep obat medis</small>
                            </td>
                            <td class="text-center">0 Pcs</td>
                            <td class="text-end">Rp 0</td>
                            <td class="text-end">Rp 0</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    @if($transaksis->kategori_pembayaran == 'BPJS')
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Potongan BPJS Health Care:</td>
                        <td class="text-end text-success fw-bold">- Rp {{ number_format($transaksis->total_bayar, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                    <tr class="table-light">
                        <td colspan="4" class="text-end fw-bold fs-6">TOTAL PEMBAYARAN:</td>
                        <td class="text-end fw-bold text-primary fs-5">Rp {{ number_format($transaksis->total_bayar, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="row pt-3 align-items-end">
            <div class="col-7">
                <small class="text-muted fst-italic">* Bukti pembayaran ini sah dicetak otomatis oleh HealthPoint Clinic.</small>
            </div>
            <div class="col-5 text-center">
                <small class="text-muted">Hormat kami,</small>
                <div style="height: 60px;"></div>
                <div class="fw-bold text-decoration">Admin HealthPoint Clinic</div>
            </div>
        </div>
    </div>
</main>
@endsection
