@extends('back.layout.template')

@section('content')
{{-- content --}}
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Obat</h1>
    </div>

    <form action="{{ url('obat') }}" method="POST">
        @csrf
        <div class="mt-3 table-responsive">
            <table class="table table-striped table-bordered">
                <tr>
                    <th style="width: 200px;" class="bg-light">Foto Obat</th>
                    <td>
                        @if($obats->foto)
                            <img src="{{ asset('storage/' . $obats->foto) }}" alt="{{ $obats->nama_obat }}" class="img-thumbnail" style="max-height: 180px;">
                        @else
                            <span class="badge bg-secondary">Tidak ada foto</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Nama Obat</th>
                    <td>: {{ $obats->nama_obat }}</td>
                </tr>

                <tr>
                    <th class="bg-light">Kategori</th>
                    <td>
                        <span class="badge {{ $obats->kategori == 'Sirup' ? 'bg-info text-dark' : 'bg-primary' }}">
                            {{ $obats->kategori ?? '-' }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <th>Harga</th>
                    <td>:Rp{{ number_format($obats->harga, 0, ',', '.') }} </td>
                </tr>

                <tr>
                    <th>Stok</th>
                    <td>: {{ $obats->stok }}</td>
                </tr>

                <tr>
                    <th>Deskripsi</th>
                    <td>: {!! $obats->deskripsis !!}</td>
                </tr>
            </table>
        </div>
        <a href="{{ route('back.obat.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</main>
@endsection
