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
                    @php $no = 1; @endphp
                    @foreach ($pengajuanMagang as $kelompokId => $kelompok)
                        @foreach ($kelompok as $pengajuan)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $pengajuan->nama }}</td>
                                <td>{{ $pengajuan->nim }}</td>
                                <td>{{ $pengajuan->program_studi }}</td>
                                <td>{{ $pengajuan->instansi_tujuan }}</td>
                                <td>{{ $pengajuan->status ?? 'Belum Diproses' }}</td>
                                <td>
                                    <a href="{{ route('admin.magang.show', $pengajuan->id) }}" class="btn btn-primary btn-sm">Lihat</a>
                                    <form action="{{ route('admin.magang.proses', $pengajuan->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Proses</button>
                                    </form>
                                    <a href="{{ route('admin.pengajuan.magang.cetak', $pengajuan->id) }}" class="btn btn-secondary btn-sm" target="_blank">
                                        Cetak
                                    </a>
                                    <form action="{{ route('admin.pengajuan.magang.hapus', $pengajuan->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
