<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenaga Medis - HealthPoint Clinic</title>
    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        }

        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
        }

        .avatar-doctor {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

    </style>
</head>

<body>

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

    <section class="bg-gradient-primary text-white py-5 text-center">
        <div class="container py-3">
            <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-semibold mb-2 shadow-sm">TIM
                PROFESIONAL</span>
            <h1 class="fw-bold display-5 mb-2"><i class="bi bi-person-badge me-2"></i>Tenaga Medis Kami</h1>
            <p class="lead opacity-90 mx-auto" style="max-width: 650px;">
                Dokter, Perawat, Bidan, dan Apoteker berpengalaman yang siap melayani kebutuhan kesehatan Anda dan
                keluarga.
            </p>
        </div>
    </section>

    <section class="py-5">
        <div class="container py-3">
            <div class="row g-4">

                @forelse($tenagaMedis as $item)
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 rounded-4 shadow-sm h-100 text-center p-4 hover-lift bg-white">
                        <img src="{{ isset($item->foto) && $item->foto ? asset('storage/' . $item->foto) : 'https://cdn-icons-png.flaticon.com/512/3774/3774299.png' }}"
                            class="rounded-circle avatar-doctor mx-auto mb-3"
                            alt="{{ $item->nama_lengkap ?? $item->nama }}">

                        <span
                            class="badge bg-info bg-opacity-10 text-info fw-semibold rounded-pill px-3 py-1 mb-2 w-fit mx-auto">
                            {{ $item->posisi ?? 'Tenaga Medis' }} - {{ $item->spesialis ?? '-' }}
                        </span>

                        <h5 class="fw-bold text-dark mb-1">{{ $item->nama_lengkap ?? $item->nama }}</h5>

                        <p class="text-muted small mb-0">
                            <i class="bi bi-clock me-1 text-primary"></i>Praktek:<br>
                            {{ $item->jadwal_praktek ?? $item->jadwal ?? 'Sesuai Janji' }}
                        </p>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-person-exclamation display-4 text-muted mb-3 d-block"></i>
                    <h5 class="text-muted">Belum ada data tenaga medis yang ditampilkan.</h5>
                </div>
                @endforelse

            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-4 mt-5 border-top">
        <div class="container text-center">
            <p class="mb-0 opacity-75 small">&copy; {{ date('Y') }} HealthPoint Clinic. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/bootstrap.bundle.min.js"></script>
</body>

</html>
