@extends('layouts.main')

@section('content')
    <h1 class="mb-4">Form Pengajuan Izin Penelitian</h1>

    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form pengajuan magang -->
    <form action="{{ route('pengajuan.penelitian') }}" method="POST">
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
                <label for="judul_penelitian">Judul Penelitian</label>
                <input type="text" class="form-control @error('judul_penelitian') is-invalid @enderror" name="judul_penelitian"
                    id="judul_penelitian" value="{{ old('judul_penelitian') }}" placeholder="Masukkan " required>
                @error('judul_penelitian')
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
