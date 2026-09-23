@extends('back.layout.template')

@section('content')
{{-- content --}}
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="fa-regular fa-newspaper"></i> Artikel</h1>
    </div>

    <div class="mt-3 ">
        <a href="{{ url('article/create') }}" class="btn btn-success mb-3"><i class="fa-solid fa-plus"></i> Tambah
            Artikel</a>

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

        @if (session('error'))
            <div class="alert alert-danger my-3">
                {{ session('error') }}
            </div>
        @endif

        <table class="table table-striped table-bordered" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>View</th>
                    <th>Status</th>
                    <th>Tanggal Terbit</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->views }}x</td>

                    @if ($item->status == 0)
                    <td>
                        <span class="badge bg-danger">Private</span>
                    </td>
                    @else
                    <td>
                        <span class="badge bg-success">Published</span>
                    </td>
                    @endif

                    <td>{{ $item->publish_date }}</td>
                    <td class="text-center">
                        <a href="{{ url('article/' . $item->id) }}" class="btn btn-sm btn-secondary"><i class="fa-solid fa-circle-info"></i> Detail</a>

                        <a href="{{ url('article/' . $item->id . '/edit') }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i> Edit</a>

                        <form action="{{ url('article/' . $item->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Kamu Yakin Ingin Menghapus Data Artikel Ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-rectangle-xmark"></i> Delete
                            </button>

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
