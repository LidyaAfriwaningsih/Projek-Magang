@extends('layouts.main')

@section('content')
<div class="container">
    <h4>Status Pengajuan Anda</h4>
    
    @if ($pengajuan->isEmpty())
        <p>Tidak ada pengajuan yang ditemukan.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Jenis Pengajuan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuan as $item)
                    <tr>
                        <td>{{ ucfirst($item->jenis ?? '-') }}</td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td>
                            @if ($item->status == 'diproses')
                                <span class="badge bg-warning text-dark">Diproses</span>
                            @elseif ($item->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
