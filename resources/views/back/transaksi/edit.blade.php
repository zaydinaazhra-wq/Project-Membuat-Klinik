@extends('back.layout.template')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Transaksi Pasien</h1>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger my-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('back.transaksi.update', $transaksis->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nama Lengkap Pasien <span class="text-danger">*</span></label>
                        <input type="text" name="nama_pasien" class="form-control"
                            value="{{ old('nama_pasien', $transaksis->nama_pasien) }}" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-bold">NIK Pasien</label>
                        <input type="text" name="nik_pasien" class="form-control"
                            value="{{ old('nik_pasien', $transaksis->nik_pasien) }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-bold">Umur Pasien (Tahun)</label>
                        <input type="number" name="umur_pasien" class="form-control"
                            value="{{ old('umur_pasien', $transaksis->umur_pasien) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">No WhatsApp / HP</label>
                        <input type="text" name="no_wa_pasien" class="form-control"
                            value="{{ old('no_wa_pasien', $transaksis->no_wa_pasien) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Kategori Pemeriksaan</label>
                        <select name="kategori_pemeriksaan" class="form-select">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Pemeriksaan Umum"
                                {{ $transaksis->kategori_pemeriksaan == 'Pemeriksaan Umum' ? 'selected' : '' }}>
                                Pemeriksaan Umum</option>
                            <option value="Kesehatan Ibu & Anak (KIA)"
                                {{ $transaksis->kategori_pemeriksaan == 'Kesehatan Ibu & Anak (KIA)' ? 'selected' : '' }}>
                                Kesehatan Ibu & Anak / KIA</option>
                            <option value="Pemeriksaan Gigi & Mulut"
                                {{ $transaksis->kategori_pemeriksaan == 'Pemeriksaan Gigi & Mulut' ? 'selected' : '' }}>
                                Pemeriksaan Gigi & Mulut</option>
                            <option value="Cek Lab & Darah"
                                {{ $transaksis->kategori_pemeriksaan == 'Cek Lab & Darah' ? 'selected' : '' }}>Cek Lab &
                                Darah</option>
                            <option value="Beli Obat Saja"
                                {{ $transaksis->kategori_pemeriksaan == 'Beli Obat Saja' ? 'selected' : '' }}>Beli Obat
                                Saja (Tanpa Periksa)</option>
                        </select>
                    </div>

                    <!-- TABEL OBAT MULTI ROW -->
                    <div class="col-12">
                        <label class="form-label fw-bold">Resep / Pilihan Obat</label>
                        <table class="table table-bordered align-middle" id="table-obat">
                            <thead class="table-light">
                                <tr>
                                    <th>Pilih Obat</th>
                                    <th style="width: 150px;">Jumlah (Qty)</th>
                                    <th style="width: 60px;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($transaksis->obats) > 0)
                                @foreach($transaksis->obats as $index =>$selectedObat)
                                <tr>
                                    <td>
                                        <select name="obats[{{ $index }}][id]" class="form-select">
                                            <option value="">-- Tanpa / Pilih Obat --</option>
                                            @foreach($obats as $o)
                                            <option value="{{ $o->id }}"
                                                {{ $selectedObat->id ==$o->id ? 'selected' : '' }}>
                                                {{ $o->nama_obat }} (Rp {{ number_format($o->harga, 0, ',', '.') }})
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="obats[{{ $index }}][qty]" class="form-control"
                                            value="{{ $selectedObat->pivot->qty ?? 1 }}" min="1">
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm remove-row"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td>
                                        <select name="obats[0][id]" class="form-select">
                                            <option value="">-- Tanpa / Pilih Obat --</option>
                                            @foreach($obats as $o)
                                            <option value="{{ $o->id }}">{{ $o->nama_obat }} (Rp
                                                {{ number_format($o->harga, 0, ',', '.') }})</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="obats[0][qty]" class="form-control" value="1"
                                            min="1">
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm remove-row"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-outline-primary btn-sm" id="add-row">
                            <i class="fa-solid fa-plus me-1"></i> Tambah Baris Obat
                        </button>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Kategori Pembayaran <span class="text-danger">*</span></label>
                        <select name="kategori_pembayaran" class="form-select" required>
                            <option value="UMUM" {{ $transaksis->kategori_pembayaran == 'UMUM' ? 'selected' : '' }}>UMUM
                                (Berbayar)</option>
                            <option value="BPJS" {{ $transaksis->kategori_pembayaran == 'BPJS' ? 'selected' : '' }}>BPJS
                                (Gratis / Ditanggung)</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-bold">Diagnosis Dokter</label>
                        <textarea name="diagnosis" class="form-control"
                            rows="2">{{ old('diagnosis', $transaksis->diagnosis) }}</textarea>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-bold">Catatan Tambahan</label>
                        <textarea name="catatan" class="form-control"
                            rows="2">{{ old('catatan', $transaksis->catatan) }}</textarea>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-warning px-4 text-white"><i
                            class="fa-solid fa-pen-to-square me-1"></i> Perbarui Transaksi</button>
                    <a href="{{ route('back.transaksi.index') }}" class="btn btn-secondary px-4">Batal</a>
                </div>
            </div>
        </div>
    </form>
</main>
@endsection

@push('js')
<script>
    let rowIdx = {
        {
            count($transaksis - > obats) > 0 ? count($transaksis - > obats) : 1
        }
    };
    const dataObats = @json($obats);

    document.getElementById('add-row').addEventListener('click', function () {
        let tbody = document.querySelector('#table-obat tbody');
        let newRow = document.createElement('tr');

        let options = '<option value="">-- Tanpa / Pilih Obat --</option>';
        dataObats.forEach(function (o) {
            let harga = new Intl.NumberFormat('id-ID').format(o.harga);
            options += `<option value="${o.id}">${o.nama_obat} (Rp ${harga})</option>`;
        });

        newRow.innerHTML = `
        <td>
            <select name="obats[${rowIdx}][id]" class="form-select">
                ${options}
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

    document.addEventListener('click', function (e) {
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
