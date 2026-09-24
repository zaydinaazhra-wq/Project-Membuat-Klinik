<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} - Klinik Zaidina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .article-content {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #333;
        }

        .sidebar-post-img {
            width: 65px;
            height: 65px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top py-3 custom-navbar" id="mainNavbar" style="background-color: rgba(13, 110, 253, 0.95); backdrop-filter: blur(10px);">
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
                        <a class="nav-link text-white fw-medium px-3" href="{{ url('/') }}#pemeriksaan">
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

    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm">

                    @php
                    $gambarURL = 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=800&q=80';

                    if (!empty($article->img)) {
                        if (str_starts_with($article->img, 'http')) {
                            $gambarURL = $article->img;
                        } else {
                            $fileName = str_replace(['public/', 'storage/', 'back/'], '', $article->img);
                            $fileName = ltrim($fileName, '/');
                            $gambarURL = asset('storage/' . $fileName);
                        }
                    }
                    @endphp

                    <img src="{{ $gambarURL }}" class="img-fluid rounded-4 w-100 mb-4"
                        style="max-height: 420px; object-fit: cover;" alt="{{ $article->title }}">

                    <h1 class="fw-bold text-dark mb-3">
                        {{ $article->title }}
                    </h1>

                    <div class="d-flex align-items-center text-muted small mb-4 pb-3 border-bottom gap-3">
                        <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-1.5 rounded-pill">
                            {{ $article->category->name ?? 'Kesehatan' }}
                        </span>
                        <span>
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $article->publish_date ? \Carbon\Carbon::parse($article->publish_date)->format('d M Y') : ($article->created_at ? $article->created_at->format('d M Y') : '-') }}
                        </span>
                        <span>
                            <i class="bi bi-eye me-1"></i> {{ $article->views ?? 0 }} Dilihat
                        </span>
                    </div>

                    <div class="article-content">
                        {!! $article->desc !!}
                    </div>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="bg-white p-4 rounded-4 shadow-sm mb-4">
                    <h5 class="fw-bold text-dark mb-3">Artikel Terbaru</h5>
                    <hr class="mt-0 mb-3">

                    <div class="d-flex flex-column gap-3">
                        @forelse($recentArticles as $recent)
                        @php
                        $recentImg = 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=200&q=80';

                        if (!empty($recent->img)) {
                            if (str_starts_with($recent->img, 'http')) {
                                $recentImg = $recent->img;
                            } else {
                                $fName = str_replace(['public/', 'storage/', 'back/'], '', $recent->img);
                                $fName = ltrim($fName, '/');
                                $recentImg = asset('storage/' . $fName);
                            }
                        }
                        @endphp
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ $recentImg }}" class="sidebar-post-img" alt="Thumbnail">
                            <div>
                                <a href="/baca-artikel/{{ $recent->slug ?? $recent->id }}"
                                    class="text-dark fw-semibold text-decoration-none small d-block mb-1 text-truncate"
                                    style="max-width: 190px;">
                                    {{ $recent->title }}
                                </a>
                                <span class="text-muted" style="font-size: 0.75rem;">
                                    <i class="bi bi-calendar3 me-1"></i>{{ $recent->created_at ? $recent->created_at->format('d M Y') : '-' }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <p class="text-muted small m-0">Tidak ada artikel lain.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
