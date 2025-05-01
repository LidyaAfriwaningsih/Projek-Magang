@extends('layouts.admin')

@section('content')
    <h1>Daftar Pengajuan Magang dan Penelitian</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Judul</th>
                <th>Jenis Pengajuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengajuans as $pengajuan)
                <tr>
                    <td>{{ $pengajuan->id }}</td>
                    <td>{{ $pengajuan->user->name }}</td>
                    <td>{{ $pengajuan->judul }}</td>
                    <td>{{ ucfirst($pengajuan->jenis) }}</td>
                    <td>
                        <a href="{{ route('admin.pengajuan.show', $pengajuan->id) }}" class="btn btn-info">Lihat</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
