@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Status Pengajuan Saya</h2>
        </div>
        <div class="card-body">
            @if($pengajuan->isEmpty())
                <p>Belum ada pengajuan.</p>
            @else
                <div class="mb-3">
                    <input type="text" class="form-control" id="searchPengajuan" placeholder="Cari...">
                </div>
                <table class="table table-bordered table-striped" id="pengajuanTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Jenis</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengajuan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->jenis }}</td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                <td>
                                    @if($item->status == 'diajukan')
                                        <span class="badge bg-warning text-dark">Diajukan</span>
                                    @elseif($item->status == 'diproses')
                                        <span class="badge bg-primary">Diproses</span>
                                    @elseif($item->status == 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @else
                                        <span class="badge bg-secondary">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        // Route untuk detail
                                        if ($item->jenis === 'penelitian') {
                                            $detailUrl = route('pengajuan.penelitian.detail', ['id' => $item->id]);
                                            $editUrl = route('pengajuan.penelitian.edit', ['id' => $item->id]);
                                            $deleteRoute = route('pengajuan.penelitian.destroy', ['id' => $item->id]);
                                        } elseif ($item->jenis === 'magang') {
                                            $detailUrl = route('pengajuan.magang.detail', ['kelompok_id' => $item->id]);
                                            $editUrl = route('pengajuan.magang.edit', ['kelompok_id' => $item->id]);
                                            $deleteRoute = route('pengajuan.magang.destroy', ['kelompok_id' => $item->id]);
                                        } else {
                                            $detailUrl = '#';
                                            $editUrl = '#';
                                            $deleteRoute = '#';
                                        }
                                    @endphp

                                    <a href="{{ $detailUrl }}" class="btn btn-info btn-sm">
                                        Detail
                                    </a>

                                    <a href="{{ $editUrl }}" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ $deleteRoute }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?')"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById("searchPengajuan").addEventListener("input", function() {
                var searchTerm = this.value.toLowerCase();
                var rows = document.querySelectorAll("#pengajuanTable tbody tr");

                rows.forEach(function(row) {
                    var cells = row.getElementsByTagName("td");
                    var matchFound = false;

                    for (var i = 1; i < cells.length; i++) { // Mulai dari kolom "Jenis", bukan "#"
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
