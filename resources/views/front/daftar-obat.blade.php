<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Obat - HealthPoint Clinic</title>
    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body class="bg-light">

    <!-- Navbar Sederhana -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top py-3 custom-navbar"
        style="background-color: rgba(13, 110, 253, 0.95); backdrop-filter: blur(10px);">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4 d-flex align-items-center gap-2" href="{{ url('/') }}">
                <div class="bg-white rounded-circle p-1 d-flex align-items-center justify-content-center"
                    style="width: 38px; height: 38px; overflow: hidden;">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo"
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <span>HealthPoint Clinic</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1 mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white fw-medium px-3" href="{{ url('/') }}">
                            <i class="bi bi-house-door me-1 opacity-75"></i>Beranda
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white fw-medium px-3" href="{{ url('/') }}#artikel-kesehatan">
                            <i class="bi bi-newspaper me-1 opacity-75"></i>Artikel
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white fw-medium px-3" href="{{ url('/') }}#pemeriksaan">
                            <i class="bi bi-clipboard2-pulse me-1 opacity-75"></i>Reservasi
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link text-white fw-medium px-3 dropdown-toggle active" href="#"
                            id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-info-circle me-1 opacity-75"></i>Tentang Klinik
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('tentang.index') }}">
                                    <i class="bi bi-building me-2 text-primary"></i>Profil Klinik
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('front.tenaga-medis') }}">
                                    <i class="bi bi-person-badge me-2 text-primary"></i>Tenaga Medis
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="{{ url('/katalog-obat') }}">
                                    <i class="bi bi-capsule me-2 text-primary"></i>Obat-obatan
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div class="d-flex align-items-center">
                <div class="bg-primary text-white rounded-4 p-3 me-3 shadow-sm d-flex align-items-center justify-content-center"
                    style="width: 56px; height: 56px;">
                    <i class="bi bi-capsule-pill fs-2"></i>
                </div>
                <div>
                    <h2 class="fw-bold text-dark mb-0">Daftar Obat-obatan</h2>
                    <p class="text-muted mb-0">Katalog lengkap persediaan obat-obatan klinik</p>
                </div>
            </div>

            <form action="{{ url('/katalog-obat') }}" method="GET" style="min-width: 280px;">
                <div class="input-group shadow-sm rounded-pill overflow-hidden bg-white border">
                    <span class="input-group-text bg-white border-0 ps-3">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-0 shadow-none ps-1"
                        placeholder="Cari nama obat..." value="{{ request('search') }}">
                    @if(request('search'))
                    <a href="{{ url('/katalog-obat') }}"
                        class="btn btn-white border-0 text-muted d-flex align-items-center pe-2">
                        <i class="bi bi-x-circle-fill"></i>
                    </a>
                    @endif
                    <button class="btn btn-primary px-4 rounded-pill m-1" type="submit">Cari</button>
                </div>
            </form>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light border-bottom">
                            <tr>
                                <th class="ps-4 py-3 text-secondary text-uppercase small fw-bold" style="width: 70px;">No</th>
                                <th class="py-3 text-secondary text-uppercase small fw-bold">Nama Obat</th>
                                <th class="py-3 text-secondary text-uppercase small fw-bold">Kategori</th>
                                <th class="py-3 text-secondary text-uppercase small fw-bold">Deskripsi</th>
                                <th class="py-3 text-secondary text-uppercase small fw-bold text-center">Stok</th>
                                <th class="py-3 text-secondary text-uppercase small fw-bold">Harga</th>
                                <th class="py-3 text-secondary text-uppercase small fw-bold text-center pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($obats as $index => $item)
                            <tr>
                                <td class="ps-4 fw-bold text-muted">
                                    {{ method_exists($obats, 'firstItem') ? $obats->firstItem() + $index : $index + 1 }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-capsule text-primary me-2 fs-5"></i>
                                        <span class="fw-bold text-dark">{{ $item->nama_obat }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark px-2 py-1 rounded-2">
                                        {{ $item->kategori ?? 'Umum' }}
                                    </span>
                                </td>
                                <td>
                                    @if(!empty($item->deskripsis))
                                        <!-- Tombol Pemicu Deskripsi -->
                                        <button class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1 shadow-sm"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#desc-{{ $item->id }}"
                                                aria-expanded="false">
                                            <i class="bi bi-chevron-down me-1"></i>Lihat Deskripsi
                                        </button>

                                        <!-- Isi Deskripsi yang Turun Saat Diklik -->
                                        <div class="collapse mt-2" id="desc-{{ $item->id }}">
                                            <div class="card card-body bg-light border-0 text-muted small p-2 rounded-3">
                                                {!! $item->deskripsis !!}
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold">
                                        {{ $item->stok }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold text-primary">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                                </td>
                                <td class="text-center pe-4">
                                    @php
                                        // Ubah nomor berikut dengan nomor WA Admin Klinik (format 62...)
                                        $noWa = '6283170325118';
                                        $pesan = urlencode("Halo Admin HealthPoint Clinic, saya ingin memesan obat:\n- Nama: " . $item->nama_obat . "\n- Harga: Rp " . number_format($item->harga, 0, ',', '.')) ;
                                    @endphp
                                    <a href="https://wa.me/{{ $noWa }}?text={{ $pesan }}" target="_blank" class="btn btn-sm btn-success fw-semibold px-3 py-2 rounded-pill shadow-sm">
                                        <i class="bi bi-whatsapp me-1"></i> Order via WA
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                    @if(request('search'))
                                    Obat dengan kata kunci "<strong>{{ request('search') }}</strong>" tidak ditemukan.
                                    @else
                                    Belum ada obat yang tersedia saat ini.
                                    @endif
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(method_exists($obats, 'hasPages') && $obats->hasPages())
            <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
                {{ $obats->links() }}
            </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
