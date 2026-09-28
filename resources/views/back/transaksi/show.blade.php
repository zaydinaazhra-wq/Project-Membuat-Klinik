@extends('back.layout.template')

@section('content')

{{-- Menyusun variabel pesan & format nomor WhatsApp --}}
@php
    $noWa =$transaksis->no_wa_pasien;
    if (!empty($noWa) && str_starts_with($noWa, '0')) {
        $noWa = '62' . substr($noWa, 1);
    }

    $pesan = "Halo *" . $transaksis->nama_pasien . "*,\n\n";
    $pesan .= "Berikut adalah rincian bukti transaksi Anda di *HealthPoint Clinic*:\n";
    $pesan .= "• *Tanggal:* " . ($transaksis->created_at ? $transaksis->created_at->format('d F Y - H:i') . ' WIB' : '-') . "\n";
    $pesan .= "• *Pemeriksaan:* " . ($transaksis->kategori_pemeriksaan ?? '-') . "\n";
    $pesan .= "• *Kategori Pembayaran:* " . $transaksis->kategori_pembayaran . "\n";
    $pesan .= "• *Total Tagihan:* Rp " . number_format($transaksis->total_bayar, 0, ',', '.') . "\n\n";
    $pesan .= "📸 *Foto/Gambar Struk Pembayaran terlampir pada pesan ini.*\n\n";
    $pesan .= "Terima kasih, semoga lekas sembuh! 🙏";
@endphp

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="fa-solid fa-circle-info me-2 text-primary"></i>Detail Transaksi Pasien</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('back.transaksi.index') }}" class="btn btn-secondary btn-sm d-flex align-items-center">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
            </a>

            <a href="{{ route('back.transaksi.cetak', $transaksis->id) }}" class="btn btn-success btn-sm d-flex align-items-center" target="_blank">
                <i class="fa-solid fa-receipt me-1"></i> Lihat Bukti Pembayaran
            </a>

            <button type="button" onclick="kirimStrukKeWA(this, '{{ $noWa }}', '{{ urlencode($pesan) }}', '{{ route('back.transaksi.cetak',$transaksis->id) }}')" class="btn btn-primary btn-sm d-flex align-items-center" style="background-color: #25D366; border-color: #25D366;">
                <i class="fa-brands fa-whatsapp me-1"></i> Kirim Struk via WA
            </button>
        </div>
    </div>

    <div id="hidden-receipt-container" style="position: absolute; left: -9999px; top: -9999px;"></div>

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

{{-- Library HTML2Canvas --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
function kirimStrukKeWA(btn, noHp, pesanTeks, urlCetak) {
    if (!noHp) {
        alert('Nomor WhatsApp pasien tidak ditemukan!');
        return;
    }

    const originalText = btn.innerHTML;

    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Memproses...';
    btn.disabled = true;

    // Ambil tampilan struk dari halaman cetak secara otomatis
    fetch(urlCetak)
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const receiptBox = doc.querySelector('.receipt-box') || doc.querySelector('.card') || doc.body;

            const container = document.getElementById('hidden-receipt-container');
            container.innerHTML = '';
            container.appendChild(receiptBox.cloneNode(true));

            return html2canvas(container.firstElementChild, { scale: 2 });
        })
        .then(canvas => {
            canvas.toBlob(blob => {
                // Masukkan foto struk ke Clipboard laptop/PC
                const item = new ClipboardItem({ 'image/png': blob });
                navigator.clipboard.write([item]).then(() => {
                    // Kembalikan tombol seperti semula
                    btn.innerHTML = originalText;
                    btn.disabled = false;

                    // Tampilkan Pop-Up Notifikasi
                    alert("✅ Gambar Struk BERHASIL disalin otomatis!\n\nTab WhatsApp Web akan terbuka. Di kolom chat pasien, tekan CTRL + V lalu Enter.");

                    // Buka WhatsApp Web di Tab Baru
                    const urlWa = `https://web.whatsapp.com/send?phone=${noHp}&text=${pesanTeks}`;
                    window.open(urlWa, '_blank');
                });
            });
        })
        .catch(err => {
            btn.innerHTML = originalText;
            btn.disabled = false;
            console.error(err);
            alert('Gagal menyalin gambar struk otomatis.');
        });
}
</script>

@endsection
