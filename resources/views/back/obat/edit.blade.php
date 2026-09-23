<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Obat</title>
</head>
<body class="container py-4">
    <h2>Edit Data Obat</h2>

    @if ($errors->any())
        <div class="alert alert-danger my-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('back.obat.update', $obat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Obat</label>
            <input type="text" name="nama_obat" class="form-control" value="{{ old('nama_obat', $obat->nama_obat) }}" required>
        </div>

        <!-- Input Kategori Obat -->
        <div class="mb-3">
            <label class="form-label">Kategori Obat</label>
            <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                <option value="Tablet" {{ old('kategori', $obat->kategori) == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                <option value="Sirup" {{ old('kategori', $obat->kategori) == 'Sirup' ? 'selected' : '' }}>Sirup</option>
            </select>
            @error('kategori')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Harga (Rp)</label>
            <input type="number" name="harga" class="form-control" value="{{ old('harga', $obat->harga) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ old('stok', $obat->stok) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi / Kegunaan</label>
            <textarea name="deskripsis" id="myeditor" class="form-control" rows="3">{{ old('deskripsis', $obat->deskripsis) }}</textarea>
        </div>

        <!-- Input Upload Foto & Preview -->
        <div class="mb-3">
            <label for="foto" class="form-label">Foto Obat</label>
            <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*" onchange="previewImage(event)">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="mt-2">
                @if($obat->foto)
                    <p class="mb-1 text-muted small">Foto Saat Ini / Preview:</p>
                    <img id="preview-foto" src="{{ asset('storage/' . $obat->foto) }}" alt="Preview Foto" class="img-thumbnail" style="max-height: 150px;">
                @else
                    <img id="preview-foto" src="#" alt="Preview Foto" class="img-thumbnail d-none" style="max-height: 150px;">
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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

        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Image&_token=',
            filebrowserBrowserUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
            clipboard_handleImages: false
        }

        document.addEventListener("DOMContentLoaded", function() {
            CKEDITOR.replace('myeditor', options);
        });
    </script>
</body>
</html>
