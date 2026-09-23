<!DOCTYPE html>
<html lang="id">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tambah Tenaga Medis</title>
</head>

<body class="container py-4">
    <h2>Tambah Data Tenaga Medis</h2>
    @if ($errors->any())
    <div class="my-3">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    @if (@session('success'))
    <div class="my-3">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
    @endif
    <form action="{{ route('back.tenaga-medis.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Lengkap & Gelar</label>
            <input type="text" name="nama" class="form-control" placeholder="dr. Ahmad, Sp.PD">
        </div>
        <div class="mb-3">
            <label class="form-label">Posisi</label>
            <select name="posisi" class="form-select">
                <option value="">-- choose --</option>
                <option value="Dokter">Dokter</option>
                <option value="Perawat">Perawat</option>
                <option value="Bidan">Bidan</option>
                <option value="Apoteker">Apoteker</option>
                <option value="Ahli Gizi">Ahli Gizi</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Spesialis (Opsional)</label>
            <input type="text" name="spesialis" class="form-control" placeholder="Spesialis Anak / Umum">
        </div>
        <div class="mb-3">
            <label class="form-label">Jadwal Praktik</label>
            <input type="text" name="jadwal_praktek" class="form-control" placeholder="Senin - Jumat (08.00 - 14.00)">
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" onchange="previewImage(event)">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <!-- Tempat preview gambar muncul -->
            <div class="mt-3">
                <img id="img-preview" src="#" alt="Preview Foto" class="img-thumbnail d-none" width="150">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('back.tenaga-medis.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('img-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>
