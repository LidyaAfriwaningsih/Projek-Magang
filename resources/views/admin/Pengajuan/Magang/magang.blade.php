@extends('layouts.main')

@section('content')
    <h1 class="mb-4">Form Pengajuan Rekomendasi Magang</h1>

    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form pengajuan magang -->
    <form action="{{ route('pengajuan.magang') }}" method="POST">
        @csrf

        <div class="row">
            <!-- Input Nama -->
            <div class="col-6 mb-3">
                <label for="nama">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama"
                    value="{{ old('nama') }}" placeholder="Masukkan Nama Lengkap" required>
                @error('nama')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input NIM -->
            <div class="col-6 mb-3">
                <label for="nim">NIM</label>
                <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim"
                    value="{{ old('nim') }}" placeholder="Masukkan NIM" required>
                @error('nim')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Program Studi -->
            <div class="col-6 mb-3">
                <label for="program_studi">Program Studi</label>
                <input type="text" class="form-control @error('program_studi') is-invalid @enderror" name="program_studi"
                    id="program_studi" value="{{ old('program_studi') }}" placeholder="Masukkan Program Studi" required>
                @error('program_studi')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Instansi Tujuan -->
            <div class="col-6 mb-3">
                <label for="instansi_tujuan">Instansi Tujuan</label>
                <input type="text" class="form-control @error('instansi_tujuan') is-invalid @enderror" name="instansi_tujuan"
                    id="instansi_tujuan" value="{{ old('instansi_tujuan') }}" placeholder="Masukkan Instansi Tujuan" required>
                @error('instansi_tujuan')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Button Kirim Pengajuan -->
            <div class="col-12 mb-3">
                <button type="submit" class="btn btn-primary w-100">Kirim Pengajuan</button>
            </div>
        </div>
    </form>
@endsection
