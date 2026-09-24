@extends('back.layout.template')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="fa-solid fa-receipt me-2"></i>Daftar Transaksi</h1>
    </div>

    <div class="mt-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('back.transaksi.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-1"></i> Tambah Transaksi
            </a>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exportExcelModal">
                <i class="fas fa-file-excel me-1"></i> Export Excel
            </button>
        </div>

        @if (session('success'))
        <div class="my-3">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger my-3">
            {{ session('error') }}
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle" id="dataTable">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th>Nama Pasien</th>
                        <th>NIK</th>
                        <th>Pemeriksaan</th>
                        <th>Total Bayar</th>
                        <th class="text-center" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksis as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="fw-bold">{{ $item->nama_pasien }}</td>
                        <td>{{ $item->nik_pasien ?? '-' }}</td>
                        <td>{{ $item->kategori_pemeriksaan ?? '-' }}</td>
                        <td class="fw-bold text-primary">Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <a href="{{ url('transaksi/' . $item->id) }}" class="btn btn-info btn-sm text-white">
                                <i class="fa-solid fa-circle-info"></i> Detail
                            </a>

                            <a href="{{ route('back.transaksi.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>

                            <form action="{{ route('back.transaksi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data Transaksi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-rectangle-xmark"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

<div class="modal fade" id="exportExcelModal" tabindex="-1" aria-labelledby="exportExcelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exportExcelModalLabel">
                    <i class="fas fa-file-excel text-success me-2"></i>Export Rekap Excel
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('back.transaksi.export') }}" method="GET">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tgl_awal" class="form-label fw-bold">Tanggal Awal</label>
                        <input type="date" class="form-control" id="tgl_awal" name="tgl_awal" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_akhir" class="form-label fw-bold">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-download me-1"></i> Download Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://datatables.net/dev/2/js/dataTables.js"></script>
<script src="https://datatables.net/dev/2/js/dataTables.bootstrap5.js"></script>

<script>
    new DataTable('#dataTable');
</script>
@endpush
