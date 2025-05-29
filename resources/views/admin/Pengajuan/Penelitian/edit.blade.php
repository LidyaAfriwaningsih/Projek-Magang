@extends('layouts.main')

@section('content')
<h3>Edit Pengajuan Penelitian</h3>

<form action="{{ route('admin.pengajuan.penelitian.update', $pengajuan->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-6">
            <div class="border p-3 mb-3 rounded">
                <label>Nama:</label>
                <input type="text" class="form-control" name="nama" value="{{ old('nama', $pengajuan->nama) }}" required>
            </div>

            <div class="border p-3 mb-3 rounded">
                <label>Nomor Identitas (KTP):</label>
                <input type="text" class="form-control" name="nomor_identitas" value="{{ old('nomor_identitas', $pengajuan->nomor_identitas) }}" required>
            </div>

            <div class="border p-3 mb-3 rounded">
                <label>Pekerjaan:</label>
                <input type="text" class="form-control" name="pekerjaan" value="{{ old('pekerjaan', $pengajuan->pekerjaan) }}" required>
            </div>

            <div class="border p-3 mb-3 rounded">
                <label>Alamat:</label>
                <input type="text" class="form-control" name="alamat" value="{{ old('alamat', $pengajuan->alamat) }}" required>
            </div>

            <div class="border p-3 mb-3 rounded">
                <label>Tempat Lahir:</label>
                <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir', $pengajuan->tempat_lahir) }}" required>
            </div>

            <div class="border p-3 mb-3 rounded">
                <label>Tanggal Lahir:</label>
                <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pengajuan->tanggal_lahir) }}" required>
            </div>

            <div class="border p-3 mb-3 rounded">
                <label>Instansi Tujuan:</label>
                <input type="text" class="form-control" name="instansi_tujuan" value="{{ old('instansi_tujuan', $pengajuan->instansi_tujuan) }}" required>
            </div>

            <!-- Baris baru untuk file upload -->
            <div class="row">
                <div class="col-md-6">
                    <div class="border p-3 mb-3 rounded">
                        <label>Upload File KTP (PDF/JPG/PNG):</label>
                        <input type="file" class="form-control mb-2" name="file_ktp">

                        <p class="mb-0"><strong>File KTP:</strong> 
                            @if ($pengajuan->file_ktp)
                                <a href="{{ asset('storage/' . $pengajuan->file_ktp) }}" target="_blank">Lihat File</a>
                            @else
                                <span class="text-muted">Tidak ada file</span>
                            @endif
                        </p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="border p-3 mb-3 rounded">
                        <label>Upload Surat Dari Instansi (PDF/JPG/PNG):</label>
                        <input type="file" class="form-control mb-2" name="file_surat_dari">

                        <p class="mb-0"><strong>File Surat Dari:</strong> 
                            @if ($pengajuan->file_surat_dari)
                                <a href="{{ asset('storage/' . $pengajuan->file_surat_dari) }}" target="_blank">Lihat File</a>
                            @else
                                <span class="text-muted">Tidak ada file</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="border p-3 mb-3 rounded">
                <label>Judul Penelitian:</label>
                <input type="text" class="form-control" name="judul_penelitian" value="{{ old('judul_penelitian', $pengajuan->judul_penelitian) }}" required>
            </div>

            <div class="border p-3 mb-3 rounded">
                <label>Surat Dari:</label>
                <input type="text" class="form-control" name="surat_dari" value="{{ old('surat_dari', $pengajuan->surat_dari) }}" required>
            </div>

            <div class="border p-3 mb-3 rounded">
                <label>Nomor Surat:</label>
                <input type="text" class="form-control" name="nomor_surat" value="{{ old('nomor_surat', $pengajuan->nomor_surat) }}" required>
            </div>

            <div class="border p-3 mb-3 rounded">
                <label>Hal Surat:</label>
                <input type="text" class="form-control" name="hal_surat" value="{{ old('hal_surat', $pengajuan->hal_surat) }}" required>
            </div>

            <div class="border p-3 mb-3 rounded">
                <label>Tanggal Surat:</label>
                <input type="date" class="form-control" name="tanggal_surat" value="{{ old('tanggal_surat', $pengajuan->tanggal_surat) }}" required>
            </div>

            <div class="border p-3 mb-3 rounded">
                <label>Tanggal Mulai:</label>
                <input type="date" class="form-control" name="tanggal_mulai" value="{{ old('tanggal_mulai', $pengajuan->tanggal_mulai) }}" required>
            </div>

            <div class="border p-3 mb-3 rounded">
                <label>Tanggal Selesai:</label>
                <input type="date" class="form-control" name="tanggal_selesai" value="{{ old('tanggal_selesai', $pengajuan->tanggal_selesai) }}" required>
            </div>

            <div class="border p-3 mb-3 rounded">
                <label>Status:</label>
                <select name="status" class="form-control">
                    <option value="diajukan" {{ $pengajuan->status == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                    <option value="diproses" {{ $pengajuan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="ditolak" {{ $pengajuan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="selesai" {{ $pengajuan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
        </div>
    </div>

    <div class="text-end mt-4">
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
</form>
@endsection
