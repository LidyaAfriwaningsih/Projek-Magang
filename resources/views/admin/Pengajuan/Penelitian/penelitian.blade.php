@extends('layouts.main')

@section('content')
    <h1 class="mb-4">Form Pengajuan Izin Penelitian</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pengajuan.penelitian') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Nama -->
            <div class="col-md-6 mb-3">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') }}" required>
            </div>

            <!-- Program Studi -->
            <div class="col-md-6 mb-3">
                <label for="program_studi">Program Studi</label>
                <input type="text" class="form-control" name="program_studi" id="program_studi" value="{{ old('program_studi') }}" required>
            </div>

            <!-- Tempat Lahir -->
            <div class="col-md-6 mb-3">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}">
            </div>

            <!-- Tanggal Lahir -->
            <div class="col-md-6 mb-3">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
            </div>

            <!-- Pekerjaan -->
            <div class="col-md-6 mb-3">
                <label for="pekerjaan">Pekerjaan</label>
                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan') }}">
            </div>

            <!-- Alamat -->
            <div class="col-md-6 mb-3">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" name="alamat" id="alamat" value="{{ old('alamat') }}">
            </div>

            <!-- Nomor Identitas -->
            <div class="col-md-6 mb-3">
                <label for="nomor_identitas">Nomor Identitas (KTP)</label>
                <input type="text" class="form-control" name="nomor_identitas" id="nomor_identitas" value="{{ old('nomor_identitas') }}">
            </div>

            <!-- Judul Penelitian -->
            <div class="col-md-6 mb-3">
                <label for="judul_penelitian">Judul Penelitian</label>
                <input type="text" class="form-control" name="judul_penelitian" id="judul_penelitian" value="{{ old('judul_penelitian') }}" required>
            </div>

            <!-- Instansi Tujuan (dinamis) -->
            <div class="col-md-12 mb-3">
                <label>Instansi Tujuan</label>
                <div id="instansi-container">
                    <div class="input-group mb-2">
                        <input type="text" name="instansi_tujuan[]" class="form-control" placeholder="Instansi Tujuan" required>
                        <button class="btn btn-danger" type="button" onclick="removeInstansi(this)">Hapus</button>
                    </div>
                </div>
                <button class="btn btn-secondary" type="button" onclick="addInstansi()">+ Tambah Instansi</button>
            </div>

            

            <!-- Surat Dari -->
            <div class="col-md-6 mb-3">
                <label for="surat_dari">Surat Dari</label>
                <input type="text" class="form-control" name="surat_dari" id="surat_dari" value="{{ old('surat_dari') }}">
            </div>

            <!-- Nomor Surat -->
            <div class="col-md-6 mb-3">
                <label for="nomor_surat">Nomor Surat</label>
                <input type="text" class="form-control" name="nomor_surat" id="nomor_surat" value="{{ old('nomor_surat') }}">
            </div>

            <!-- Tanggal Surat -->
            <div class="col-md-6 mb-3">
                <label for="tanggal_surat">Tanggal Surat</label>
                <input type="date" class="form-control" name="tanggal_surat" id="tanggal_surat" value="{{ old('tanggal_surat') }}">
            </div>

            <!-- Tanggal Penelitian -->
            <div class="col-md-6 mb-3">
                <label for="tanggal_penelitian">Tanggal Penelitian</label>
                <input type="date" class="form-control" name="tanggal_penelitian" id="tanggal_penelitian" value="{{ old('tanggal_penelitian') }}">
            </div>

            <!-- Upload KTP -->
            <div class="col-md-6 mb-3">
                <label for="file_ktp">Upload KTP</label><br>
                <label for="file_ktp" class="btn btn-primary">Pilih File</label>
                <input type="file" id="file_ktp" name="file_ktp" class="d-none" onchange="updateLabel(this)">
                <span id="file_ktp_name" class="ms-2 text-muted">Belum ada file</span>
            </div>

            <!-- Upload Surat Dari -->
            <div class="col-md-6 mb-3">
                <label for="file_surat_dari">Upload Surat Dari</label><br>
                <label for="file_surat_dari" class="btn btn-primary">Pilih File</label>
                <input type="file" id="file_surat_dari" name="file_surat_dari" class="d-none" onchange="updateLabel(this)">
                <span id="file_surat_dari_name" class="ms-2 text-muted">Belum ada file</span>
            </div>

            <!-- Button Submit -->
            <div class="col-12 mb-3">
                <button type="submit" class="btn btn-primary w-100">Kirim Pengajuan</button>
            </div>
        </div>
    </form>

    <script>
        function updateLabel(input) {
            const fileName = input.files.length > 0 ? input.files[0].name : 'Belum ada file';
            document.getElementById(input.id + '_name').innerText = fileName;
        }

        function addInstansi() {
            const container = document.getElementById('instansi-container');
            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');
            div.innerHTML = `
                <input type="text" name="instansi_tujuan[]" class="form-control" placeholder="Instansi Tujuan" required>
                <button class="btn btn-danger" type="button" onclick="removeInstansi(this)">Hapus</button>
            `;
            container.appendChild(div);
        }
        function konfirmasiKirim(formId) {
        Swal.fire({
            title: 'Yakin kirim pengajuan?',
            text: "Pastikan data sudah benar.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, kirim!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
        function removeInstansi(button) {
            button.parentElement.remove();
        }
    </script>
@endsection