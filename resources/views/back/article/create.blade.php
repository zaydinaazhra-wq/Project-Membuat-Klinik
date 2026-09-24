@extends('back.layout.template')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Artikel</h1>
    </div>

    <div class="mt-3 ">

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

        <form action="{{ url('article') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="title">Judul</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="category">Category</label>
                        <select name="category_id" id="category_id" class="form-select">
                            <option value="">-- choose --</option>
                            @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="desc">Deskripsi</label>
                <textarea name="desc" id="myeditor" cols="30" rows="10" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label for="img" class="form-label">Foto (Max 2MB)</label>
                <input type="file" name="img" id="img" class="form-control @error('img') is-invalid @enderror" accept="image/*" onchange="previewImage(event)">
                @error('img')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <div class="mt-2">
                    <img id="preview-foto" src="#" alt="Preview Foto" class="img-thumbnail d-none" style="max-height: 180px;">
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">-- choose --</option>
                            <option value="1">Publish</option>
                            <option value="0">Private</option>
                        </select>
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="publish_date">Tanggal Terbit</label>
                        <input type="date" name="publish_date" id="publish_date" class="form-control">
                    </div>
                </div>
            </div>

            <div class="float-end">
                <a href="{{ route('back.article.index') }}" class="btn btn-secondary me-2"> Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
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
@endpush
