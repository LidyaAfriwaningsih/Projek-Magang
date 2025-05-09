@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Detail Pengajuan Magang</h2>

    <div class="card">
        <div class="card-body">
            <!-- Menggunakan $dataUtama untuk menampilkan data pengajuan -->
            <p><strong>Nama:</strong> {{ $dataUtama->nama }}</p>
            <p><strong>NIM:</strong> {{ $dataUtama->nim }}</p>
            <p><strong>Program Studi:</strong> {{ $dataUtama->program_studi }}</p>
            <p><strong>Instansi Tujuan:</strong> {{ $dataUtama->instansi_tujuan }}</p>

            <!-- Menampilkan nama user jika ada -->
            <p><strong>Diajukan Oleh (User):</strong> {{ $dataUtama->user->name ?? 'Tidak diketahui' }}</p>

            <p><strong>Tanggal Pengajuan:</strong> {{ $dataUtama->created_at->format('d M Y') }}</p>
        </div>
    </div>

    <a href="{{ route('admin.magang.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar</a>
</div>
@endsection
