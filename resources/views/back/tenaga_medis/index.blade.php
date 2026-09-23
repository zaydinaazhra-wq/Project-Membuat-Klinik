@extends('back.layout.template')

@section('content')
{{-- content --}}
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="fa-solid fa-user-doctor me-2"></i>Tenaga Medis</h1>
    </div>

    <div class="mt-3">
        <a href="{{ url('tenaga-medis/create') }}" class="btn btn-success mb-3"><i class="fa-solid fa-plus"></i> Tambah Tenaga Medis</a>

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
                    <th class="text-center" style="width: 50px;">No</th>
                    <th style="width: 250px;">Nama Lengkap</th>
                    <th>Posisi</th>
                    <th>Spesialis</th>
                    <th style="width: 200px;">Jadwal Praktik</th>
                    <th class="text-center" style="width: 220px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tenagaMedis as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td><span class="badge bg-info text-dark">{{ $item->posisi }}</span></td>
                    <td>{{ $item->spesialis ?? '-' }}</td>
                    <td>{{ $item->jadwal_praktek }}</td>
                    <td class="text-center">
                        <a href="{{ url('tenaga-medis/' . $item->id) }}"
                            class="btn btn-info btn-sm text-white"><i class="fa-solid fa-circle-info"></i> Detail</a>

                        <a href="{{ route('back.tenaga-medis.edit', $item->id) }}"
                            class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i> Edit</a>

                        <form action="{{ route('back.tenaga-medis.destroy', $item->id) }}" method="POST"
                            class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
