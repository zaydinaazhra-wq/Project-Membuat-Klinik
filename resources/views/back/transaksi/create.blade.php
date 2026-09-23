@extends('back.layout.template')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="fa-solid fa-receipt me-2"></i>Tambah Transaksi Pasien</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger my-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('back.transaksi.store') }}" method="POST">
        @csrf

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nama Lengkap Pasien <span class="text-danger">*</span></label>
                        <input type="text" name="nama_pasien" class="form-control" placeholder="Contoh: Ahmad Subagja" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-bold">NIK Pasien</label>
                        <input type="text" name="nik_pasien" class="form-control" placeholder="3271xxxx">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-bold">Umur Pasien (Tahun)</label>
                        <input type="number" name="umur_pasien" class="form-control" placeholder="25">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">No WhatsApp / HP</label>
                        <input type="text" name="no_wa_pasien" class="form-control" placeholder="0812xxxx">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Kategori Pemeriksaan</label>
                        <select name="kategori_pemeriksaan" class="form-select">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Pemeriksaan Umum" data-biaya="50000">Pemeriksaan Umum</option>
                            <option value="Kesehatan Ibu & Anak (KIA)" data-biaya="60000">Kesehatan Ibu & Anak / KIA</option>
                            <option value="Pemeriksaan Gigi & Mulut" data-biaya="75000">Pemeriksaan Gigi & Mulut</option>
                            <option value="Cek Lab & Darah" data-biaya="100000">Cek Lab & Darah</option>
                            <option value="Beli Obat Saja" data-biaya="0">Beli Obat Saja (Tanpa Periksa)</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Resep / Pilihan Obat (Bisa lebih dari 1)</label>
                        <table class="table table-bordered align-middle" id="table-obat">
                            <thead class="table-light">
                                <tr>
                                    <th>Pilih Obat</th>
                                    <th style="width: 150px;">Jumlah (Qty)</th>
                                    <th style="width: 60px;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="obats[0][id]" class="form-select">
                                            <option value="">-- Tanpa / Pilih Obat --</option>
                                            @foreach($obats as $o)
                                                <option value="{{ $o->id }}">{{ $o->nama_obat }} (Rp {{ number_format($o->harga, 0, ',', '.') }})</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="obats[0][qty]" class="form-control" value="1" min="1">
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-outline-primary btn-sm" id="add-row">
                            <i class="fa-solid fa-plus me-1"></i> Tambah Baris Obat
                        </button>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Kategori Pembayaran <span class="text-danger">*</span></label>
                        <select name="kategori_pembayaran" class="form-select" required>
                            <option value="UMUM">UMUM (Berbayar)</option>
                            <option value="BPJS">BPJS (Gratis / Ditanggung)</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-bold">Diagnosis Dokter</label>
                        <textarea name="diagnosis" class="form-control" rows="2" placeholder="Contoh: Demam tinggi, Flu berat"></textarea>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-bold">Catatan Tambahan</label>
                        <textarea name="catatan" class="form-control" rows="2" placeholder="Contoh: Istirahat 3 hari"></textarea>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-4"><i class="fa-solid fa-floppy-disk me-1"></i> Simpan Transaksi</button>
                    <a href="{{ route('back.transaksi.index') }}" class="btn btn-secondary px-4">Batal</a>
                </div>
            </div>
        </div>
    </form>
</main>
@endsection

@push('js')
<script>
let rowIdx = 1;
document.getElementById('add-row').addEventListener('click', function() {
    let tbody = document.querySelector('#table-obat tbody');
    let newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>
            <select name="obats[${rowIdx}][id]" class="form-select">
                <option value="">-- Tanpa / Pilih Obat --</option>
                @foreach($obats as $o)
                    <option value="{{ $o->id }}">{{ $o->nama_obat }} (Rp {{ number_format($o->harga, 0, ',', '.') }})</option>
                @endforeach
            </select>
        </td>
        <td>
            <input type="number" name="obats[${rowIdx}][qty]" class="form-control" value="1" min="1">
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa-solid fa-trash"></i></button>
        </td>
    `;
    tbody.appendChild(newRow);
    rowIdx++;
});

document.addEventListener('click', function(e) {
    if (e.target && e.target.closest('.remove-row')) {
        let rows = document.querySelectorAll('#table-obat tbody tr');
        if (rows.length > 1) {
            e.target.closest('tr').remove();
        } else {
            alert('Minimal satu baris obat tersedia.');
        }
    }
});
</script>
@endpush
