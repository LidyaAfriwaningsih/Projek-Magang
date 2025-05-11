@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Konfirmasi Penghapusan Pengajuan Magang</h1>
        </div>
        <div class="card-body">
            <p>Apakah Anda yakin ingin menghapus pengajuan magang ini?</p>

            <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <td>{{ $pengajuan->nama }}</td>
                </tr>
                <tr>
                    <th>NIM</th>
                    <td>{{ $pengajuan->nim }}</td>
                </tr>
                <tr>
                    <th>Program Studi</th>
                    <td>{{ $pengajuan->program_studi }}</td>
                </tr>
                <tr>
                    <th>Instansi Tujuan</th>
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
