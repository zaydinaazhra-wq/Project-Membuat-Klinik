@extends('back.layout.template')

@section('content')
{{-- content --}}
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="fa-solid fa-kit-medical"></i> Obat - obatan</h1>
    </div>

    <div class="mt-3">
        <a href="{{ route('back.obat.create') }}" class="btn btn-success mb-3"><i class="fa-solid fa-plus"></i> Tambah Obat</a>

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

        @if (session('error'))
            <div class="alert alert-danger my-3">
                {{ session('error') }}
            </div>
        @endif

        <table class="table table-striped table-bordered" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($obats as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_obat }}</td>
                        <td>
                            <span class="badge {{ $item->kategori == 'Sirup' ? 'bg-info text-dark' : 'bg-primary' }}">
                                {{ $item->kategori ?? '-' }}
                            </span>
                        </td>
                        <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td>{{ $item->stok }}</td>

                        <td class="text-center">
                            <a href="{{ route('back.obat.show', $item->id) }}" class="btn btn-info btn-sm text-white"><i class="fa-solid fa-circle-info"></i> Detail</a>

                            <a href="{{ route('back.obat.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i> Edit</a>

                            <form action="{{ route('back.obat.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-rectangle-xmark"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://datatables.net/dev/2/js/dataTables.js"></script>
    <script src="https://datatables.net/dev/2/js/dataTables.bootstrap5.js"></script>

    <script>
        new DataTable('#dataTable');
    </script>
@endpush
