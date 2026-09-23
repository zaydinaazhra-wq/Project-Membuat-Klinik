<!DOCTYPE html>
<html lang="id">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tambah Obat</title>
</head>

<body class="container py-4">
    <h2>Tambah Data Obat</h2>
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

    <form action="{{ route('back.obat.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Obat</label>
            <input type="text" name="nama_obat" value="{{ old('nama_obat') }}" class="form-control" required>
        </div>

        <!-- DITAMBAHKAN: Input Kategori Obat -->
        <div class="mb-3">
            <label class="form-label">Kategori Obat</label>
            <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Tablet" {{ old('kategori') == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                <option value="Sirup" {{ old('kategori') == 'Sirup' ? 'selected' : '' }}>Sirup</option>
            </select>
            @error('kategori')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Harga (Rp)</label>
            <input type="number" name="harga" value="{{ old('harga') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" value="{{ old('stok') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi / Kegunaan</label>
            <textarea name="deskripsis" id="myeditor" class="form-control" rows="3">{{ old('deskripsis') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto Obat</label>
            <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*" onchange="previewImage(event)">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <!-- Tempat menampilkan foto preview -->
            <div class="mt-2">
                <img id="preview-foto" src="#" alt="Preview Foto" class="img-thumbnail d-none" style="max-height: 150px;">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('back.obat.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview-foto');

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

    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Image&_token=',
            filebrowserBrowserUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
            clipboard_handleImages: false
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            CKEDITOR.replace('myeditor', options);
        });
    </script>
</body>
</html>
