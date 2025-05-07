@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Daftar Pengajuan Magang</h1>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <input type="text" class="form-control" id="searchMagang" placeholder="Cari...">
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Program Studi</th>
                        <th>Instansi Tujuan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuanMagang as $pengajuan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pengajuan->nama }}</td>
                            <td>{{ $pengajuan->nim }}</td>
                            <td>{{ $pengajuan->program_studi }}</td>
                            <td>{{ $pengajuan->instansi_tujuan }}</td>
                            <td>{{ $pengajuan->status ?? 'Belum Diproses' }}</td>
                            <td>
                                <!-- Link untuk melihat pengajuan -->
                                <a href="{{ route('admin.magang.show', $pengajuan->id) }}" class="btn btn-primary btn-sm">Lihat</a>
                                
                                <!-- Form untuk memproses pengajuan -->
                                <form action="{{ route('admin.magang.proses', $pengajuan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Proses</button>
                                </form>

                                <!-- Link untuk cetak pengajuan magang -->
                                <a href="{{ route('admin.pengajuan.magang.cetak', $pengajuan->id) }}" class="btn btn-secondary btn-sm" target="_blank">
                                    Cetak
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
