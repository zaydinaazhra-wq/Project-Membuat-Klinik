@extends('back.layout.template')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Artikel</h1>
    </div>

    <div class="mt-3">

        @if ($errors->any())
        <div class="my-3">
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <form action="{{ route('back.article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $article->title) }}">
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id"
                            class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">-- choose --</option>
                            @foreach ($categories as $item)
                            <option value="{{ $item->id }}"
                                {{ old('category_id', $article->category_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="desc" class="form-label">Deskripsi</label>
                <textarea name="desc" id="myeditor" cols="30" rows="10"
                    class="form-control @error('desc') is-invalid @enderror">{{ old('desc', $article->desc) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="img" class="form-label">Foto (Max 2MB)</label>
                <input type="file" name="img" id="img" class="form-control @error('img') is-invalid @enderror" accept="image/*" onchange="previewImage(event)">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>

                @error('img')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <div class="mt-2">
                    <p class="mb-1 text-muted small">Foto saat ini / Preview:</p>
                    @if($article->img)
                        <img id="preview-foto" src="{{ asset('storage/' . $article->img) }}" alt="Foto Artikel" width="150px" class="img-thumbnail">
                    @else
                        <img id="preview-foto" src="#" alt="Preview Foto" width="150px" class="img-thumbnail d-none">
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="">-- choose --</option>
                            <option value="1" {{ old('status', $article->status) == '1' ? 'selected' : '' }}>Publish</option>
                            <option value="0" {{ old('status', $article->status) == '0' ? 'selected' : '' }}>Private</option>
                        </select>
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="publish_date" class="form-label">Tanggal Terbit</label>
                        <input type="date" name="publish_date" id="publish_date"
                            class="form-control @error('publish_date') is-invalid @enderror"
                            value="{{ old('publish_date', $article->publish_date) }}">
                    </div>
                </div>
            </div>

            <div class="float-end mb-4">
                <a href="{{ route('back.article.index') }}" class="btn btn-secondary me-2">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</main>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
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
    };

    document.addEventListener("DOMContentLoaded", function() {
        CKEDITOR.replace('myeditor', options);
    });
</script>
@endpush
