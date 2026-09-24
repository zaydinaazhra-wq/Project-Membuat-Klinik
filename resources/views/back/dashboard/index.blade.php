@extends('back.layout.template')

@section('content')
<style>
    .dashboard-container {
        background-color: #f4f6f9;
        min-height: 100vh;
    }

    /* Card Stat Styling */
    .card-stat-modern {
        border: none;
        border-radius: 20px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .card-stat-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08) !important;
    }

    .icon-shape {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    /* Gradients halus untuk Icon */
    .bg-soft-primary {
        background: rgba(13, 110, 253, 0.12);
        color: #0d6efd;
    }

    .bg-soft-info {
        background: rgba(13, 202, 240, 0.15);
        color: #0dcaf0;
    }

    .bg-soft-success {
        background: rgba(25, 135, 84, 0.12);
        color: #198754;
    }

    .bg-soft-warning {
        background: rgba(255, 193, 7, 0.18);
        color: #ffc107;
    }

    /* Modern Table Styling */
    .card-table {
        border: none;
        border-radius: 20px;
    }

    .table-custom {
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .table-custom tbody tr {
        background-color: #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        border-radius: 12px;
        transition: all 0.2s ease;
    }

    .table-custom tbody tr:hover {
        background-color: #f8fafc;
        transform: scale(1.002);
    }

    .table-custom td {
        padding: 16px;
        border: none;
        vertical-align: middle;
    }

    .table-custom td:first-child {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
    }

    .table-custom td:last-child {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    .avatar-initial {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
    }

</style>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 dashboard-container">
    <!-- Banner Menyapa Admin -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4 text-white rounded-4"
                style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <span class="badge bg-white bg-opacity-25 text-white mb-2 px-3 py-2 rounded-pill">
                            <i class="fa-regular fa-clock me-1"></i>
                            {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}
                        </span>
                        <h2 class="fw-bold mb-1">Panel Utama Klinik</h2>
                        <p class="mb-0 text-white-50">Pantau perkembangan artikel, tenaga medis, Transaksi, dan obat dalam
                            satu tempat.</p>
                    </div>
                    <div>
                        <a href="{{ url('article/create') }}"
                            class="btn btn-light fw-semibold text-primary rounded-pill px-4 shadow-sm">
                            <i class="fa-solid fa-plus me-1"></i> Buat Artikel Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ringkasan Statistik (4 Kartu) -->
    <div class="row g-3 mb-4">
        <!-- Total Artikel -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-stat-modern bg-white shadow-sm p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-uppercase text-muted fw-bold small tracking-wider">Total Artikel</span>
                        <h2 class="fw-extrabold text-dark my-2">{{ number_format($total_articles) }}</h2>
                        <a href="{{ url('article') }}" class="text-primary text-decoration-none fw-semibold small">
                            Lihat Semua Artikel <i class="fa-solid fa-chevron-right ms-1 small"></i>
                        </a>
                    </div>
                    <div class="icon-shape bg-soft-primary">
                        <i class="fa-regular fa-newspaper"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Tenaga Medis -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-stat-modern bg-white shadow-sm p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-uppercase text-muted fw-bold small tracking-wider">Tenaga Medis</span>
                        <h2 class="fw-extrabold text-dark my-2">{{ number_format($total_tenaga_medis) }}</h2>
                        <a href="{{ url('tenaga-medis') }}" class="text-info text-decoration-none fw-semibold small">
                            Kelola Tenaga Medis <i class="fa-solid fa-chevron-right ms-1 small"></i>
                        </a>
                    </div>
                    <div class="icon-shape bg-soft-info">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Obat -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-stat-modern bg-white shadow-sm p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-uppercase text-muted fw-bold small tracking-wider">Stok Obat</span>
                        <h2 class="fw-extrabold text-dark my-2">{{ number_format($total_obat) }}</h2>
                        <a href="{{ url('obat') }}" class="text-warning text-decoration-none fw-semibold small">
                            Cek Stok Obat <i class="fa-solid fa-chevron-right ms-1 small"></i>
                        </a>
                    </div>
                    <div class="icon-shape bg-soft-warning">
                        <i class="fa-solid fa-pills"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Transaksi Hari Ini -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-stat-modern bg-white shadow-sm p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-uppercase text-muted fw-bold small tracking-wider">Transaksi Hari Ini</span>
                        <h2 class="fw-extrabold text-dark my-2">{{ number_format($total_transaksi_today) }}</h2>
                        <a href="{{ url('transaksi') }}" class="text-warning text-decoration-none fw-semibold small">
                            Lihat Transaksi <i class="fa-solid fa-chevron-right ms-1 small"></i>
                        </a>
                    </div>
                    <div class="icon-shape bg-soft-warning">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Terkini (Dua Tabel) -->
    <div class="row g-4">
        <!-- Tabel Artikel Terbaru -->
        <div class="col-12 col-lg-6">
            <div class="card card-table shadow-sm p-4 bg-white">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="fw-bold text-dark m-0"><i class="fa-solid fa-fire text-danger me-2"></i>Artikel
                            Terbaru</h5>
                        <small class="text-muted">Artikel yang baru saja diterbitkan</small>
                    </div>
                    <a href="{{ url('article') }}"
                        class="btn btn-sm btn-light text-primary rounded-pill px-3 fw-bold">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr class="text-muted small">
                                <th class="text-center" style="width: 40px;">#</th>
                                <th>Judul Artikel</th>
                                <th>Kategori</th>
                                <th class="text-center">Dilihat</th>
                                {{-- <th class="text-center">Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latest_articles as $item)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <span class="fw-bold text-dark d-block text-truncate" style="max-width: 160px;"
                                        title="{{ $item->title }}">
                                        {{ $item->title }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold">
                                        {{ $item->category->name }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border px-2 py-1"><i
                                            class="fa-regular fa-eye me-1 text-muted"></i>{{ $item->views }}</span>
                                </td>
                                {{-- <td class="text-center">
                                    <a href="{{ url('article/' . $item->id) }}"
                                        class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        Rincian
                                    </a>
                                </td> --}}
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada artikel terbaru.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tabel Transaksi Terbaru -->
        <div class="col-12 col-lg-6">
            <div class="card card-table shadow-sm p-4 bg-white">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="fw-bold text-dark m-0"><i class="fa-solid fa-receipt text-success me-2"></i>Transaksi
                            Terbaru</h5>
                        <small class="text-muted">Riwayat transaksi pasien terbaru</small>
                    </div>
                    <a href="{{ url('transaksi') }}"
                        class="btn btn-sm btn-light text-success rounded-pill px-3 fw-bold">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr class="text-muted small">
                                <th class="text-center" style="width: 40px;">#</th>
                                <th>Nama Pasien</th>
                                <th>NIK</th> <!-- Mengubah header Obat Diberikan jadi NIK -->
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latest_transactions as $item)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-initial bg-success bg-opacity-10 text-success me-2">
                                            {{ strtoupper(substr($item->nama_pasien ?? 'P', 0, 1)) }}
                                        </div>
                                        <span
                                            class="fw-bold text-dark">{{ $item->nama_pasien ?? 'Tidak terdata' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <!-- Mengubah isian data dari obat menjadi nik_pasien -->
                                    <span class="fw-semibold text-secondary">{{ $item->nik_pasien ?? '-' }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('transaksi/' . $item->id) }}"
                                        class="btn btn-sm btn-outline-success rounded-pill px-3">
                                        Rincian
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada riwayat transaksi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
