@extends('layouts.admin')

@section('content')
    <h1>Daftar Pengajuan Penelitian</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Judul</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengajuans as $pengajuan)
                <tr>
                    <td>{{ $pengajuan->id }}</td>
                    <td>{{ $pengajuan->user->name }}</td>
                    <td>{{ $pengajuan->judul }}</td>
                    <td>
                        <a href="{{ route('pengajuan.admin.penelitian.show', $pengajuan->id) }}" class="btn btn-info">Lihat</a>
                        <form action="{{ route('pengajuan.admin.penelitian.proses', $pengajuan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-success">Proses</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
