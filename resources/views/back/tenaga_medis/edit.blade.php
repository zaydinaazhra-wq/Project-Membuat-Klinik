<!DOCTYPE html>
<html lang="id">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tambah Tenaga Medis</title>
</head>

<body class="container py-4">
    <h2>Edit Data Tenaga Medis</h2>
    <form action="{{ url('tenaga-medis/' . $tenagaMedis->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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

        @if (session('success'))
            <div class="my-3">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Nama Lengkap & Gelar</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $tenagaMedis->nama) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Posisi</label>
            <select name="posisi" class="form-select" required>
                <option value="Dokter" {{ old('posisi', $tenagaMedis->posisi) == 'Dokter' ? 'selected' : '' }}>Dokter
                </option>
                <option value="Perawat" {{ old('posisi', $tenagaMedis->posisi) == 'Perawat' ? 'selected' : '' }}>Perawat
                </option>
                <option value="Bidan" {{ old('posisi', $tenagaMedis->posisi) == 'Bidan' ? 'selected' : '' }}>Bidan
                </option>
                <option value="Apoteker" {{ old('posisi', $tenagaMedis->posisi) == 'Apoteker' ? 'selected' : '' }}>Apoteker
                </option>
                <option value="Ahli Gizi" {{ old('posisi', $tenagaMedis->posisi) == 'Ahli Gizi' ? 'selected' : '' }}>Ahli Gizi
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Spesialis (Opsional)</label>
            <input type="text" name="spesialis" class="form-control"
                value="{{ old('spesialis', $tenagaMedis->spesialis) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Jadwal Praktik</label>
            <input type="text" name="jadwal_praktek" class="form-control"
                value="{{ old('jadwal_praktek', $tenagaMedis->jadwal_praktek) }}" required>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            {{-- Preview Foto Lama --}}
            @if($tenagaMedis->foto)
                <div class="mt-2">
                    <small class="text-muted d-block mb-1">Foto Saat Ini:</small>
                    <img src="{{ asset('storage/' . $tenagaMedis->foto) }}" alt="Foto {{ $tenagaMedis->nama }}" width="120" class="img-thumbnail rounded">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ url('tenaga-medis') }}" class="btn btn-secondary">Kembali</a>
    </form>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const imgPreview = document.getElementById('imgPreview');

            reader.onload = function() {
                imgPreview.src = reader.result;
                imgPreview.style.display = 'block';
            }
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
</body>

</html>
