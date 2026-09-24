@extends('back.layout.template')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
    <!-- Judul Halaman dengan Icon -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 fw-bold text-dark"><i class="fa-solid fa-calendar-check me-2"></i>Reservasi Pasien</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Tabel -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0" id="dataTable">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 5%">No</th>
                            <th>Nama Pasien</th>
                            <th>Kontak / WA</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Keluhan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center" style="width: 20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservasis as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $item->nama }}</td>
                                <td>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->kontak) }}" target="_blank" class="text-decoration-none text-success fw-medium">
                                        <i class="fa-brands fa-whatsapp me-1"></i>{{ $item->kontak }}
                                    </a>
                                </td>
                                <td>{{ date('d M Y', strtotime($item->hari)) }}</td>
                                <td>{{ $item->keluhan }}</td>
                                <td class="text-center">
                                    @if($item->status == 'menunggu')
                                        <span class="badge bg-warning text-dark px-2 py-1">Menunggu</span>
                                    @elseif($item->status == 'selesai')
                                        <span class="badge bg-success px-2 py-1">Selesai</span>
                                    @else
                                        <span class="badge bg-danger px-2 py-1">Batal</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('back.reservasi.updateStatus', $item->id) }}" method="POST" class="d-flex justify-content-center gap-1">
                                        @csrf
                                        @method('PUT')

                                        <button type="submit" name="status" value="selesai" class="btn btn-sm btn-success {{ $item->status == 'selesai' ? 'disabled' : '' }}" title="Tandai Selesai">
                                            <i class="fa-solid fa-check me-1"></i>Selesai
                                        </button>

                                        <button type="submit" name="status" value="batal" class="btn btn-sm btn-danger {{ $item->status == 'batal' ? 'disabled' : '' }}" onclick="return confirm('Apakah Anda yakin ingin membatalkan reservasi ini?')" title="Batalkan Reservasi">
                                            <i class="fa-solid fa-xmark me-1"></i>Batal
                                        </button>

                                        @if($item->status != 'menunggu')
                                            <button type="submit" name="status" value="menunggu" class="btn btn-sm btn-secondary" title="Kembalikan ke Menunggu">
                                                <i class="fa-solid fa-rotate-left"></i>
                                            </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada data reservasi masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://datatables.net/dev/2/js/dataTables.js"></script>
<script src="https://datatables.net/dev/2/js/dataTables.bootstrap5.js"></script>

<script>
    new DataTable('#dataTable');

</script>
@endpush
