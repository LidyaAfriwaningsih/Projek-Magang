@extends('layouts.main')

@section('content')
    <div class="container">
        <h2>Detail Pengajuan Magang</h2>

        <div class="card">
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $pengajuan->nama }}</p>
                <p><strong>NIM:</strong> {{ $pengajuan->nim }}</p>
                <p><strong>Program Studi:</strong> {{ $pengajuan->program_studi }}</p>
                <p><strong>Instansi Tujuan:</strong> {{ $pengajuan->instansi_tujuan }}</p>
                <p><strong>Surat Dari:</strong> {{ $pengajuan->surat_dari }}</p>
                <p><strong>Nomor Surat:</strong> {{ $pengajuan->nomor_surat }}</p>
                <p><strong>Hal Surat:</strong> {{ $pengajuan->hal_surat }}</p>
                <p><strong>Tanggal Surat:</strong> {{ $pengajuan->tanggal_surat }}</p>
                <p><strong>Tanggal Mulai:</strong> {{ $pengajuan->tanggal_mulai }}</p>
                <p><strong>Tanggal Selesai:</strong> {{ $pengajuan->tanggal_selesai }}</p>

                <p><strong>File KTP:</strong> 
                    @if ($pengajuan->file_ktp)
                        <span><a href="{{ asset('storage/' . $pengajuan->file_ktp) }}" target="_blank">Lihat File</a></span>
                    @else
                        <span>Tidak ada file</span>
                    @endif
                </p>                
                <p><strong>File Surat Dari:</strong> 
                    @if ($pengajuan->file_surat_dari)
                        <span><a href="{{ asset('storage/' . $pengajuan->file_surat_dari) }}" target="_blank">Lihat File</a></span>
                    @else
                        <span>Tidak ada file</span>
                    @endif
                </p>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('user.pengajuan.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
