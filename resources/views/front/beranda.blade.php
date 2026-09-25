<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthPoint Clinic Information System</title>

    <!-- Google Fonts & Bootstrap 5 CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- AOS (Animate On Scroll) Library CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

    <style>
        :root {
            --primary-color: #0d6efd;
            --primary-hover: #0b5ed7;
            --secondary-color: #0ea5e9;
            --accent-color: #10b981;
            --dark-color: #0f172a;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #334155;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Dynamic Navbar Blur Effect */
        .custom-navbar {
            transition: all 0.3s ease-in-out;
            background-color: rgba(13, 110, 253, 0.95) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .custom-navbar.scrolled {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
            padding-top: 0.75rem !important;
            padding-bottom: 0.75rem !important;
        }

        /* Hero Styling dengan subtle zoom animation */
        .hero-section-bg {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.88) 0%, rgba(13, 110, 253, 0.78) 100%),
                url('/image/klinik.png') center/cover no-repeat;
            position: relative;
            animation: zoomHero 20s infinite alternate ease-in-out;
        }

        @keyframes zoomHero {
            0% {
                background-size: 100%;
            }
            100% {
                background-size: 108%;
            }
        }

        /* Glassmorphism Cards & Badges */
        .glass-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            animation: pulseGlow 2s infinite ease-in-out;
        }

        @keyframes pulseGlow {
            0%, 100% {
                box-shadow: 0 0 0 rgba(255, 255, 255, 0.4);
            }
            50% {
                box-shadow: 0 0 15px rgba(255, 255, 255, 0.6);
            }
        }

        /* Smooth Hover & Interactive Animation */
        .hover-lift {
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 30px rgba(13, 110, 253, 0.12) !important;
        }

        .hover-glow {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-glow:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(13, 110, 253, 0.15) !important;
        }

        .article-card-img-wrapper {
            overflow: hidden;
            position: relative;
        }

        .article-card-img-wrapper img {
            transition: transform 0.5s ease;
        }

        .card:hover .article-card-img-wrapper img {
            transform: scale(1.08);
        }

        .btn-animated {
            transition: all 0.3s ease;
        }

        .btn-animated:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3) !important;
        }

        .hover-white:hover {
            color: #ffffff !important;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top py-3 custom-navbar" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4 d-flex align-items-center gap-2" href="{{ url('/') }}">
                <div class="bg-white rounded-circle p-1 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; overflow: hidden;">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: cover;">
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
                        <a class="nav-link text-white fw-medium px-3" href="{{ url('/#pemeriksaan') }}">
                            <i class="bi bi-clipboard2-pulse me-1 opacity-75"></i>Reservasi
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link text-white fw-medium px-3 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

    <!-- Hero Section -->
    <section id="beranda" class="hero-section-bg py-5 min-vh-100 d-flex align-items-center position-relative">
        <!-- Gradient Overlay: Gelap di kiri untuk teks, terang/transparan di kanan untuk gambar -->
        <div class="position-absolute top-0 start-0 w-100 h-100"
            style="background: linear-gradient(90deg, rgba(10, 25, 50, 0.92) 0%, rgba(10, 25, 50, 0.7) 50%, rgba(10, 25, 50, 0.3) 100%); z-index: 1;">
        </div>

        <div class="container py-lg-5 position-relative" style="z-index: 2;">
            <div class="row align-items-center g-5">
                <div class="col-lg-8 text-center text-lg-start" data-aos="fade-right" data-aos-duration="1000">
                    <!-- Badge dengan efek menyala ringan -->
                    <span class="badge text-white fw-semibold px-3 py-2 rounded-pill mb-3"
                        style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.25);">
                        <i class="bi bi-patch-check-fill me-1 text-warning"></i>Layanan Kesehatan Terpadu
                    </span>

                    <!-- Judul Utama Tegas & Cerah -->
                    <h1 class="display-4 fw-bold text-white mb-3 lh-sm" style="text-shadow: 0 2px 10px rgba(0,0,0,0.5);">
                        Solusi Kesehatan Terpercaya <span style="color: #38ef7d; text-shadow: 0 0 12px rgba(56, 239, 125, 0.4);">Untuk Keluarga</span>
                    </h1>

                    <!-- Deskripsi Putih Bersih Mudah Dibaca -->
                    <p class="text-white mb-4 fs-5 pe-lg-3 fw-normal" style="opacity: 0.95; line-height: 1.7; text-shadow: 0 1px 4px rgba(0,0,0,0.8);">
                        HealthPoint Clinic hadir untuk memberikan layanan kesehatan yang profesional, nyaman, dan terpercaya bagi Anda dan keluarga. Dengan dukungan tenaga medis profesional serta informasi kesehatan yang mudah dipahami, kami berkomitmen menjadi bagian dari perjalanan Anda menuju hidup yang lebih sehat.
                    </p>

                    <!-- Tombol CTA Kontras Tinggi -->
                    <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                        <a href="#pemeriksaan" class="btn btn-lg px-4 py-3 rounded-pill shadow-lg fw-bold d-flex align-items-center gap-2 btn-animated text-white" style="background: linear-gradient(135deg, #0062ff, #00a1ff); border: none;">
                            <i class="bi bi-calendar-plus"></i>Reservasi Sekarang
                        </a>
                        <a href="{{ url('/katalog-obat') }}" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill fw-semibold d-flex align-items-center gap-2 btn-animated" style="border-width: 2px;">
                            <i class="bi bi-search"></i>Cari Obat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Artikel Kesehatan -->
    <section id="artikel-kesehatan" class="py-5 bg-white">
        <div class="container py-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5" data-aos="fade-up">
                <div>
                    <span class="text-primary fw-bold text-uppercase small tracking-wide">Pusat Informasi</span>
                    <h2 class="fw-bold text-dark mt-1 mb-0">
                        <i class="bi bi-newspaper me-2 text-primary"></i>Artikel Terbaru
                    </h2>
                </div>
            </div>

            <div class="row g-4" id="articleContainer">
                @forelse ($articles as $index => $article)
                    @php
                        $gambar = 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=600&q=80';
                        if (!empty($article->img)) {
                            if (str_starts_with($article->img, 'http')) {
                                $gambar = $article->img;
                            } else {
                                $fileName = str_replace(['public/', 'storage/', 'back/'], '', $article->img);
                                $fileName = ltrim($fileName, '/');
                                $gambar = asset('storage/' . $fileName);
                            }
                        }
                    @endphp

                    <!-- Hanya tampilkan 3 artikel awal, sisanya disembunyikan pakai 'd-none' -->
                    <div class="col-md-6 col-lg-4 article-item {{ $index >= 3 ? 'd-none' : '' }}" data-aos="fade-up">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                            <div class="article-card-img-wrapper">
                                <img src="{{ $gambar }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $article->title }}">
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-primary-subtle text-primary fw-semibold px-2.5 py-1.5 rounded-pill">
                                        {{ $article->category->name ?? 'Kesehatan' }}
                                    </span>
                                    <small class="text-muted small">
                                        <i class="bi bi-eye me-1"></i> {{ $article->views ?? 0 }}
                                    </small>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-2">
                                    {{ $article->title }}
                                </h5>
                                <p class="card-text text-muted small flex-grow-1">
                                    {{ Str::limit(strip_tags($article->desc), 90) }}
                                </p>
                                <hr class="my-3 opacity-10">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        {{ $article->publish_date ? \Carbon\Carbon::parse($article->publish_date)->format('d M Y') : ($article->created_at ? $article->created_at->format('d M Y') : '-') }}
                                    </small>
                                    <a href="{{ route('artikel.detail', $article->slug) }}" class="btn btn-sm btn-link text-primary fw-bold text-decoration-none p-0">
                                        Baca Selengkapnya &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Belum ada artikel kesehatan yang diterbitkan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Tombol 'Lihat Artikel Lainnya' -->
            @if (count($articles) > 3)
                <div class="text-center mt-5" id="loadMoreWrapper">
                    <button id="btnLoadMore" class="btn btn-outline-primary btn-lg px-4 rounded-pill fw-semibold shadow-sm btn-animated">
                        Lihat Artikel Lainnya <i class="bi bi-chevron-down ms-1"></i>
                    </button>
                </div>
            @endif
        </div>
    </section>

    <!-- Section Form Reservasi -->
    <section id="pemeriksaan" class="py-5 bg-light">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8" data-aos="fade-up">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                        <div class="text-center mb-4">
                            <span class="text-primary fw-bold text-uppercase small tracking-wide">Pendaftaran Online</span>
                            <h3 class="fw-bold text-dark mt-1">Formulir Reservasi Kunjungan</h3>
                            <p class="text-muted small">Silakan isi form di bawah ini untuk membuat janji temu atau reservasi pemeriksaan.</p>
                        </div>

                        {{-- Alert Notifikasi Sukses --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('reservasi.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark">Nama Lengkap</span></label>
                                    <input type="text" name="nama" class="form-control py-2" placeholder="Contoh: Ahmad Subagja" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark">No WhatsApp / HP</span></label>
                                    <input type="tel" name="kontak" class="form-control py-2" placeholder="62812xxxx" required>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold text-dark">Alamat Lengkap</span></label>
                                    <textarea name="alamat" class="form-control" rows="2" placeholder="Masukkan alamat tempat tinggal" required></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark">Tanggal Kunjungan</span></label>
                                    <input type="date" name="hari" id="tglKunjungan" class="form-control py-2" value="{{ old('hari') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark">Jam Kunjungan</span></label>
                                    <input type="time" name="jam" class="form-control py-2" value="{{ old('jam') }}" required>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold text-dark">Keluhan Utama</span></label>
                                    <textarea name="keluhan" class="form-control" rows="3" placeholder="Contoh: Demam tinggi, Flu berat" required></textarea>
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-semibold rounded-3 py-3 shadow-sm btn-animated">
                                        <i class="bi bi-paper-plane me-2"></i> Kirim Reservasi
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-4" style="background-color: #0f172a !important;">
        <div class="container">
            <div class="row g-4 pb-4">
                <!-- Brand & Deskripsi -->
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="bg-white rounded-circle p-1 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <img src="{{ asset('image/logo.png') }}" alt="Logo" style="width: 90%; height: 90%; object-fit: cover;">
                        </div>
                        <h5 class="fw-bold text-white mb-0">HealthPoint Clinic</h5>
                    </div>
                    <p class="text-white-50 small mb-3 pe-lg-3 lh-base">
                        Platform Sistem Informasi Manajemen Klinik Terpadu untuk kemudahan pelayanan kesehatan modern, profesional, dan terpercaya.
                    </p>
                </div>

                <!-- Navigasi Cepat -->
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold text-white mb-3 text-uppercase small tracking-wide">Menu Pintas</h6>
                    <ul class="list-unstyled text-white-50 small mb-0 d-flex flex-column gap-2">
                        <li><a href="{{ url('/') }}" class="text-white-50 text-decoration-none hover-white"><i class="bi bi-chevron-right me-1 text-primary"></i> Beranda</a></li>
                        <li><a href="{{ url('/') }}#artikel-kesehatan" class="text-white-50 text-decoration-none hover-white"><i class="bi bi-chevron-right me-1 text-primary"></i> Artikel</a></li>
                        <li><a href="{{ url('/#pemeriksaan') }}" class="text-white-50 text-decoration-none hover-white"><i class="bi bi-chevron-right me-1 text-primary"></i> Reservasi</a></li>
                        <li><a href="{{ route('tentang.index') }}" class="text-white-50 text-decoration-none hover-white"><i class="bi bi-chevron-right me-1 text-primary"></i> Profil Klinik</a></li>
                    </ul>
                </div>

                <!-- Jam Operasional -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold text-white mb-3 text-uppercase small tracking-wide">Jam Operasional</h6>
                    <div class="bg-secondary bg-opacity-10 p-3 rounded-3 border border-secondary border-opacity-25">
                        <ul class="list-unstyled text-white-50 small mb-0 d-flex flex-column gap-2">
                            <li class="d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-clock text-primary me-2"></i>Senin - Jum'at</span>
                                <span class="badge bg-primary-subtle text-primary fw-medium">07:30 - 21:00</span>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-clock text-primary me-2"></i>Sabtu</span>
                                <span class="badge bg-primary-subtle text-primary fw-medium">07:30 - 17:30</span>
                            </li>
                            <hr class="my-1 border-secondary opacity-25">
                            <li class="d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-x-circle text-danger me-2"></i>Minggu / Libur</span>
                                <span class="badge bg-danger-subtle text-danger fw-medium">Tutup</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Kontak & Lokasi -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold text-white mb-3 text-uppercase small tracking-wide">Kontak & Lokasi</h6>
                    <ul class="list-unstyled text-white-50 small mb-0 d-flex flex-column gap-2">
                        <li class="d-flex align-items-start gap-2">
                            <i class="bi bi-geo-alt-fill text-primary fs-6 mt-1"></i>
                            <span>Jl. Raya Muara Teladan No.68, Serasan Jaya, Kec. Sekayu, Kabupaten Musi Banyuasin, Sumatera Selatan 30711</span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <i class="bi bi-telephone-fill text-primary fs-6"></i>
                            <span>+62 831-7032-5118</span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <i class="bi bi-envelope-fill text-primary fs-6"></i>
                            <span>info@healthpointclinic.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright Line -->
            <div class="border-top border-secondary border-opacity-25 pt-3 mt-2 text-center text-white-50 small d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                <div>&copy; 2026 HealthPoint Clinic. All rights reserved.</div>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white-50 text-decoration-none small">Kebijakan Privasi</a>
                    <a href="#" class="text-white-50 text-decoration-none small">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-in-out'
        });

        // Set default tanggal kunjungan hari ini
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            const elemTgl = document.getElementById('tglKunjungan');
            if (elemTgl) elemTgl.value = today;

            // Handler tombol 'Lihat Artikel Lainnya'
            const btnLoadMore = document.getElementById('btnLoadMore');
            if (btnLoadMore) {
                btnLoadMore.addEventListener('click', function () {
                    const hiddenArticles = document.querySelectorAll('.article-item.d-none');
                    hiddenArticles.forEach(function (article) {
                        article.classList.remove('d-none');
                    });
                    document.getElementById('loadMoreWrapper').style.display = 'none';
                });
            }
        });
    </script>
</body>
</html>
