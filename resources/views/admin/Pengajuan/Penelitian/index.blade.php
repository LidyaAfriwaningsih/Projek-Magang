@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Daftar Pengajuan Penelitian</h1>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <input type="text" class="form-control" id="searchPenelitian" placeholder="Cari...">
            </div>
            <table class="table" id="penelitianTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Nomor Identitas (KTP)</th>
                        <th>Judul Penelitian</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuanPenelitian as $pengajuan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pengajuan->nama }}</td>
                            <td>{{ $pengajuan->nomor_identitas }}</td>
                            <td>{{ $pengajuan->judul_penelitian }}</td>
                            <td>{{ $pengajuan->status ?? 'Belum Diproses' }}</td>
                            <td>
                                <a href="{{ route('admin.penelitian.show', $pengajuan->id) }}" class="btn btn-primary btn-sm">Lihat</a>

                                <form action="{{ route('admin.penelitian.proses', $pengajuan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">Proses</button>
                                </form>
                                <form action="{{ route('admin.penelitian.selesai', $pengajuan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Selesai</button>
                                </form>
                                <!-- Link untuk cetak pengajuan magang -->
                                <a href="{{ route('admin.pengajuan.penelitian.cetak', $pengajuan->id) }}" class="btn btn-secondary btn-sm" target="_blank">
                                    Cetak
                                </a>
                                <form action="{{ route('admin.pengajuan.penelitian.hapus', $pengajuan->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById("searchPenelitian").addEventListener("input", function() {
                var searchTerm = this.value.toLowerCase();
                var rows = document.querySelectorAll("#penelitianTable tbody tr");

                rows.forEach(function(row) {
                    var cells = row.getElementsByTagName("td");
                    var matchFound = false;

                    for (var i = 0; i < cells.length - 1; i++) { // Jangan cek kolom Aksi
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
