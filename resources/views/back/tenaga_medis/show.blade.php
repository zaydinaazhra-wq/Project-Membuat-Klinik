@extends('back.layout.template')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Tenaga Medis</h1>
    </div>

    <div class="mt-3 table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <tr>
                <th style="width: 200px;">Nama Lengkap</th>
                <td>: {{ $tenagaMedis->nama }}</td>
            </tr>

            <tr>
                <th>Posisi</th>
                <td>: {{ $tenagaMedis->posisi }}</td>
            </tr>

            <tr>
                <th>Spesialis</th>
                <td>: {{ $tenagaMedis->spesialis ?? '-' }}</td>
            </tr>

            <tr>
                <th>Jadwal Praktek</th>
                <td>: {{ $tenagaMedis->jadwal_praktek }}</td>
            </tr>

            <tr>
                <th>Foto</th>
                <td>:
                    @if($tenagaMedis->foto)
                        <img src="{{ asset('storage/' . $tenagaMedis->foto) }}" alt="Foto {{ $tenagaMedis->nama }}" width="150" class="img-thumbnail">
                    @else
                        <span class="badge bg-secondary">Tidak Ada Foto</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <a href="{{ route('back.tenaga-medis.index') }}" class="btn btn-secondary mb-4">Kembali</a>
</main>
@endsection
