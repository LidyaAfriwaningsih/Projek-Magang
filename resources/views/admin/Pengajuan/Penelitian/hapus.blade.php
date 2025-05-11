@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Konfirmasi Penghapusan Pengajuan Penelitian</h1>
        </div>
        <div class="card-body">
            <p>Apakah Anda yakin ingin menghapus pengajuan Penelitian ini?</p>

            <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <td>{{ $pengajuan->nama }}</td>
                </tr>
                <tr>
                    <th>Nomor Identitas</th>
                    <td>{{ $pengajuan->nim }}</td>
                </tr>
                <tr>
                    <th>Judul Penelitian</th>
                    <td>{{ $pengajuan->instansi_tujuan }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $pengajuan->status ?? 'Belum Diproses' }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
