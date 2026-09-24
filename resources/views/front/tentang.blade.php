<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Klinik - HealthPoint Clinic</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }

        /* Custom Hero Background dengan Gambar dan Overlay Biru (seperti di Beranda) */
        .hero-section-bg {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.88) 0%, rgba(13, 110, 253, 0.78) 100%),
                        url('{{ asset("image/tentang.jpeg") }}') center/cover no-repeat;
            position: relative;
        }

        /* Custom Gradient Backgrounds */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 50%, #032830 100%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Hover Cards Animation */
        .hover-lift {
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 30px -10px rgba(13, 110, 253, 0.15) !important;
        }

        /* Icon Box Styles */
        .icon-box {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            flex-shrink: 0;
        }

        /* Social Media Hover Buttons */
        .btn-social {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            text-decoration: none;
        }

        .btn-social:hover {
            background: #ffffff;
            color: #0d6efd;
            transform: translateY(-3px);
        }

        /* Pulse Badge Animation */
        .pulse-badge {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(25, 135, 84, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(25, 135, 84, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(25, 135, 84, 0);
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
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

    <!-- Hero Section dengan Gambar Latar Belakang -->
    <section class="hero-section-bg text-white py-5 position-relative overflow-hidden">
        <div class="container py-5 position-relative z-1 text-center">
            <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-semibold mb-3 shadow-sm">
                <i class="bi bi-stars text-warning me-1"></i> Layanan Kesehatan Modern & Terpercaya
            </span>
            <h1 class="fw-bold display-4 mb-3">Membangun Senyum & Kesehatan Anda</h1>
            <p class="lead opacity-90 mx-auto" style="max-width: 750px;">
                HealthPoint Clinic mengintegrasikan teknologi medis canggih dengan pelayanan ramah berstandar
                internasional demi kenyamanan dan kesembuhan pasien.
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container py-3">

            <!-- Section 1: Profil & Jam Operasional Modern -->
            <div class="row g-4 align-items-stretch mb-5">
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 h-100 bg-white hover-lift">
                        <small class="text-primary fw-bold text-uppercase tracking-wider">Tentang Kami</small>
                        <h3 class="fw-bold text-dark mt-2 mb-3">Solusi Kesehatan Terpadu Keluarga Anda</h3>
                        <p class="text-secondary leading-relaxed mb-4">
                            HealthPoint Clinic dirancang khusus untuk memberikan pengalaman berobat yang efisien, tanpa
                            antrean panjang, serta transparan. Didukung oleh sistem rekam medis digital modern yang
                            memastikan riwayat kesehatan Anda tersimpan dengan aman dan akurat.
                        </p>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded-4 border-0">
                                    <div class="icon-box bg-primary text-white me-3 shadow-sm">
                                        <i class="bi bi-shield-check fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0">Terakreditasi</h6>
                                        <small class="text-muted">Kemenkes RI</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded-4 border-0">
                                    <div class="icon-box bg-success text-white me-3 shadow-sm">
                                        <i class="bi bi-cpu fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0">Fasilitas Digital</h6>
                                        <small class="text-muted">E-Rekam Medis</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jam Operasional Card -->
                <div class="col-lg-5">
                    <div
                        class="card border-0 shadow-sm rounded-4 p-4 p-md-5 h-100 bg-gradient-primary text-white hover-lift">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h4 class="fw-bold mb-0"><i class="bi bi-clock me-2"></i>Jam Operasional</h4>
                            <span class="badge bg-success text-white px-3 py-2 rounded-pill pulse-badge">Buka Hari Ini</span>
                        </div>

                        <div class="d-flex flex-column gap-3 mb-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded-3 glass-card">
                                <div>
                                    <h6 class="mb-0 fw-semibold">Senin - Jumat</h6>
                                    <small class="opacity-75">Sesi Pagi & Sore</small>
                                </div>
                                <span class="badge bg-white text-primary font-monospace fs-6">08:00 - 20:00 WIB</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center p-3 rounded-3 glass-card">
                                <div>
                                    <h6 class="mb-0 fw-semibold">Sabtu</h6>
                                    <small class="opacity-75">Sesi Akhir Pekan</small>
                                </div>
                                <span class="badge bg-white text-primary font-monospace fs-6">08:00 - 17:00 WIB</span>
                            </div>

                            <div
                                class="d-flex justify-content-between align-items-center p-3 rounded-3 glass-card opacity-75">
                                <div>
                                    <h6 class="mb-0 fw-semibold">Minggu & Tanggal Merah</h6>
                                    <small>Instalasi Gawat Darurat</small>
                                </div>
                                <span class="badge bg-danger text-white fs-6">Tutup</span>
                            </div>
                        </div>

                        <div class="mt-auto pt-3 border-top border-white border-opacity-10">
                            <small class="opacity-75 d-block mb-1"><i class="bi bi-telephone-inbound me-1"></i> Butuh Konsultasi Cepat?</small>
                            <a href="https://wa.me/6283170325118" target="_blank"
                                class="btn btn-success text-white fw-bold rounded-pill w-100 py-2 shadow-sm">
                                <i class="bi bi-whatsapp me-2"></i>+62 831-7032-5118
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Visi & Misi Card -->
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div
                        class="card border-0 shadow-sm rounded-4 h-100 p-4 p-md-5 bg-white hover-lift border-start border-4 border-primary">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-primary bg-opacity-10 text-primary me-3">
                                <i class="bi bi-eye-fill fs-3"></i>
                            </div>
                            <h4 class="fw-bold text-dark mb-0">Visi Utama</h4>
                        </div>
                        <p class="text-secondary leading-relaxed mb-0">
                            Menjadi penyedia layanan kesehatan tingkat pertama yang paling terpercaya, modern, dan
                            inklusif dengan mengedepankan keamanan pasien berbasis integrasi teknologi informasi.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div
                        class="card border-0 shadow-sm rounded-4 h-100 p-4 p-md-5 bg-white hover-lift border-start border-4 border-success">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-success bg-opacity-10 text-success me-3">
                                <i class="bi bi-bullseye fs-3"></i>
                            </div>
                            <h4 class="fw-bold text-dark mb-0">Misi Kami</h4>
                        </div>
                        <ul class="text-secondary mb-0 ps-3">
                            <li class="mb-2">Menyediakan tenaga medis yang profesional, kompeten, dan empati.</li>
                            <li class="mb-2">Mengembangkan pendaftaran & manajemen rekam medis yang cepat tanpa kendala.</li>
                            <li>Menjamin ketersediaan obat-obatan esensial yang asli, aman, dan terjangkau.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Section 3: Maps & Kontak / Medsos -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden bg-white hover-lift">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-lg-5 p-4 p-md-5 d-flex flex-column justify-content-center">
                            <span
                                class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2 fw-semibold mb-3"
                                style="width: fit-content;">
                                <i class="bi bi-geo-alt-fill me-1"></i> Lokasi & Hubungi Kami
                            </span>
                            <h3 class="fw-bold text-dark mb-4">Kunjungi Klinik Kami</h3>

                            <div class="d-flex align-items-start mb-3">
                                <i class="bi bi-building-fill text-primary fs-5 me-3 mt-1"></i>
                                <div>
                                    <strong class="d-block text-dark">Alamat Utama:</strong>
                                    <span class="text-secondary">Jl. Raya Muara Teladan No.68, Serasan Jaya, Kec.
                                        Sekayu, Kabupaten Musi Banyuasin, Sumatera Selatan 30711</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-start mb-3">
                                <i class="bi bi-envelope-at-fill text-danger fs-5 me-3 mt-1"></i>
                                <div>
                                    <strong class="d-block text-dark">Email Resmi:</strong>
                                    <span class="text-secondary">info@healthpointclinic.com</span>
                                </div>
                            </div>

                            <!-- Social Media Direct Links -->
                            <div class="mb-4">
                                <strong class="d-block text-dark mb-2">Media Sosial & Chat:</strong>
                                <div class="d-flex gap-2">
                                    <a href="https://wa.me/6283170325118" target="_blank"
                                        class="btn btn-outline-success btn-sm rounded-pill px-3">
                                        <i class="bi bi-whatsapp me-1"></i> WhatsApp
                                    </a>
                                    <a href="https://instagram.com/healthpointclinic" target="_blank"
                                        class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                        <i class="bi bi-instagram me-1"></i> Instagram
                                    </a>
                                    <a href="https://facebook.com/healthpointclinic" target="_blank"
                                        class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                        <i class="bi bi-facebook me-1"></i> Facebook
                                    </a>
                                </div>
                            </div>

                            <a href="https://maps.google.com" target="_blank"
                                class="btn btn-primary rounded-pill py-2 px-4 fw-semibold shadow-sm align-self-start">
                                <i class="bi bi-box-arrow-up-right me-2"></i> Petunjuk Rute Google Maps
                            </a>
                        </div>

                        <div class="col-lg-7">
                            <div class="h-100 min-vh-300">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3325.8761196777587!2d103.84257097405762!3d-2.8668087393943487!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3a8d0004959d7b%3A0x3d3b6ae2a827bcf2!2sToko%20Rama%20Mifta!5e1!3m2!1sid!2sid!4v1789455587784!5m2!1sid!2sid"
                                    width="100%" height="100%" style="border:0; min-height: 380px;" allowfullscreen=""
                                    loading="lazy">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer Modern -->
    <footer class="bg-dark text-white py-4 mt-5 border-top">
        <div class="container text-center">
            <div class="d-flex justify-content-center gap-3 mb-3">
                <a href="https://wa.me/6283170325118" target="_blank"
                    class="text-white opacity-75 opacity-100-hover fs-5"><i class="bi bi-whatsapp"></i></a>
                <a href="https://instagram.com/healthpointclinic" target="_blank"
                    class="text-white opacity-75 opacity-100-hover fs-5"><i class="bi bi-instagram"></i></a>
                <a href="https://facebook.com/healthpointclinic" target="_blank"
                    class="text-white opacity-75 opacity-100-hover fs-5"><i class="bi bi-facebook"></i></a>
            </div>
            <p class="mb-0 opacity-75 small">&copy; {{ date('Y') }} HealthPoint Clinic. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
