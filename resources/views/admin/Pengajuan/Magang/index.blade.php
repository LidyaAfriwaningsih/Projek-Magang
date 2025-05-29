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
            <table class="table" id="magangTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Program Studi</th>
                        <th>Instansi Tujuan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        <th>Lanjutan</th>
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
                                    <form action="{{ route('admin.magang.proses', $pengajuan->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">Proses</button>
                                    </form>
                                    <form action="{{ route('admin.magang.tolak', $pengajuan->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                    </form>
                                    <a href="{{ route('admin.pengajuan.magang.cetak', $pengajuan->id) }}" class="btn btn-secondary btn-sm" target="_blank">Cetak</a>
                                    <form action="{{ route('admin.magang.selesai', $pengajuan->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Selesai</button>
                                    </form>
                                    <form action="{{ route('admin.pengajuan.magang.hapus', $pengajuan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('admin.pengajuan.magang.edit', $pengajuan->id) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById("searchMagang").addEventListener("input", function() {
                var searchTerm = this.value.toLowerCase();
                var rows = document.querySelectorAll("#magangTable tbody tr");

                rows.forEach(function(row) {
                    var cells = row.getElementsByTagName("td");
                    var matchFound = false;

                    for (var i = 0; i < cells.length - 1; i++) { // Tidak cek kolom Aksi
                        if (cells[i].textContent.toLowerCase().includes(searchTerm)) {
                            matchFound = true;
                            break;
                        }
                    }

                    row.style.display = matchFound ? "" : "none";
                });
            });
        });
    </script>
@endsection
