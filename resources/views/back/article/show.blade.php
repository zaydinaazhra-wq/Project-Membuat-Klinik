@extends('back.layout.template')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="fa-solid fa-newspaper me-2"></i>Detail Artikel</h1>
    </div>

    <div class="card shadow-sm border-0 col-md-10">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-3">
                    <tr>
                        <th style="width: 200px;" class="bg-light">Judul</th>
                        <td class="fw-bold">{{ $article->title ?? $articles->title }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Slug</th>
                        <td>{{ $article->slug ?? $articles->slug }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Deskripsi / Isi</th>
                        <td>{!! $article->desc ?? $articles->desc ?? $articles->deskripsi !!}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Kategori</th>
                        <td>
                            <span class="badge bg-info text-dark">
                                {{ $article->category->name ?? $articles->category->name ?? $articles->kategori ?? '-' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">Foto Artikel</th>
                        <td>
                            {{-- Mengecek jika ada foto di kolom 'img' atau 'image' --}}
                            @php
                                $fotoPath = $articles->img ?? $articles->image ?? $article->img ?? $article->image ?? null;
                            @endphp

                            @if($fotoPath)
                                <img src="{{ asset('storage/' . $fotoPath) }}" alt="Foto Artikel" class="img-thumbnail" style="max-height: 200px;">
                            @else
                                <span class="badge bg-secondary">Tidak ada foto</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">Views</th>
                        <td>{{ $articles->views ?? $article->views ?? 0 }}x</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Status</th>
                        <td>
                            @php
                                $status = $articles->status ?? $article->status;
                            @endphp
                            @if($status == 'Published' || $status == 1)
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-warning text-dark">Unpublished</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">Tanggal Terbit</th>
                        <td>{{ $articles->publish_date ?? $article->publish_date ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            <a href="{{ route('back.article.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</main>
@endsection
