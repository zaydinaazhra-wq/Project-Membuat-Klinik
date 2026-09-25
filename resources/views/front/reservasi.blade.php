@extends('layouts.home')

@section('content')
<div class="container my-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-primary text-white p-3">
                    <h5 class="mb-0 fw-bold"><i class="fa-solid fa-calendar-check me-2"></i>Form Reservasi Pasien</h5>
                </div>
                <div class="card-body p-4">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('reservasi.store') }}" method="POST">
                        @csrf

                        <!-- Nama -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap *</label>
                            <input type="text" name="nama" class="form-control" placeholder="Contoh: Budi Santoso" value="{{ old('nama') }}" required>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Alamat Lengkap *</label>
                            <textarea name="alamat" class="form-control" rows="2" placeholder="Masukkan alamat tempat tinggal" required>{{ old('alamat') }}</textarea>
                        </div>

                        <!-- Kontak -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">No. WhatsApp / HP *</label>
                            <input type="text" name="kontak" class="form-control" placeholder="Contoh: 08123456789" value="{{ old('kontak') }}" required>
                        </div>

                        <!-- Hari / Tanggal -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tanggal Kunjungan *</label>
                                <input type="date" name="hari" class="form-control" value="{{ old('hari') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jam Kunjungan *</label>
                                <input type="time" name="jam" class="form-control" value="{{ old('jam') }}" required>
                            </div>
                        </div>

                        <!-- Keluhan -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Keluhan Utama *</label>
                            <textarea name="keluhan" class="form-control" rows="3" placeholder="Tuliskan keluhan atau gejalanya..." required>{{ old('keluhan') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                            <i class="fa-solid fa-paper-plane me-2"></i>Kirim Reservasi
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
