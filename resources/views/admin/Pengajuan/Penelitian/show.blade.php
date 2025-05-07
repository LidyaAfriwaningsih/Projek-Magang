@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Detail Pengajuan Penelitian</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $pengajuan->nama }}</p>
            <p><strong>NIM:</strong> {{ $pengajuan->nim }}</p>
            <p><strong>Program Studi:</strong> {{ $pengajuan->program_studi }}</p>
            <p><strong>Judul Penelitian:</strong> {{ $pengajuan->judul_penelitian }}</p>
            <p><strong>Diajukan Oleh (User):</strong> {{ $pengajuan->user->name ?? 'Tidak diketahui' }}</p>
            <p><strong>Tanggal Pengajuan:</strong> {{ $pengajuan->created_at->format('d M Y') }}</p>
        </div>
    </div>

    <a href="{{ route('admin.penelitian.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar</a>
</div>
@endsection
