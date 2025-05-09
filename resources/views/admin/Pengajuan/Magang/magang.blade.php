@extends('layouts.main')

@section('content')
    <h1 class="mb-4">Form Pengajuan Rekomendasi Magang (Kelompok)</h1>

    <form id="formPengajuan" action="{{ route('pengajuan.magang') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div id="mahasiswa-wrapper">
            <div class="row mahasiswa-group mb-3">
                <div class="col-md-4">
                    <label>Nama</label>
                    <input type="text" name="nama[]" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>NIM</label>
                    <input type="text" name="nim[]" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label>Program Studi</label>
                    <input type="text" name="program_studi[]" class="form-control" required>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-remove">Hapus</button>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-secondary mb-4" id="add-mahasiswa">Tambah Mahasiswa</button>

        <div class="row">
            <div class="col-6 mb-3">
                <label for="instansi_tujuan">Instansi Tujuan</label>
                <input type="text" name="instansi_tujuan" class="form-control" required>
            </div>

            <div class="col-6 mb-3">
                <label for="surat_dari">Surat Dari</label>
                <input type="text" name="surat_dari" class="form-control">
            </div>

            <div class="col-6 mb-3">
                <label for="nomor_surat">Nomor Surat</label>
                <input type="text" name="nomor_surat" class="form-control">
            </div>

            <div class="col-6 mb-3">
                <label for="tanggal_surat">Tanggal Surat</label>
                <input type="date" name="tanggal_surat" class="form-control">
            </div>

            <!-- Upload KTP -->
            <div class="col-md-6 mb-3">
                <label for="file_ktp">Upload KTP</label><br>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('file_ktp').click()">Pilih File</button>
                <input type="file" id="file_ktp" name="file_ktp" class="d-none" onchange="updateLabel(this)">                
                <span id="file_ktp_name" class="ms-2 text-muted">Belum ada file</span>
            </div>

            <!-- Upload Surat Dari -->
            <div class="col-md-6 mb-3">
                <label for="file_surat_dari">Upload Surat Dari</label><br>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('file_surat_dari').click()">Pilih File</button>
                <input type="file" id="file_surat_dari" name="file_surat_dari" class="d-none" onchange="updateLabel(this)">                
                <span id="file_surat_dari_name" class="ms-2 text-muted">Belum ada file</span>
            </div>

            <div class="col-12">
                <button type="button" class="btn btn-primary w-100" onclick="konfirmasiKirim()">Kirim Pengajuan</button>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Tambah dan hapus data mahasiswa
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('add-mahasiswa').addEventListener('click', function () {
            const wrapper = document.getElementById('mahasiswa-wrapper');
            const group = document.createElement('div');
            group.classList.add('row', 'mahasiswa-group', 'mb-3');
            group.innerHTML = `
                <div class="col-md-4">
                    <input type="text" name="nama[]" class="form-control" placeholder="Nama" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="nim[]" class="form-control" placeholder="NIM" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="program_studi[]" class="form-control" placeholder="Program Studi" required>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-remove">Hapus</button>
                </div>
            `;
            wrapper.appendChild(group);
        });

        // Event listener untuk menghapus grup mahasiswa
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-remove')) {
                e.target.closest('.mahasiswa-group').remove();
            }
        });
    });

    // Konfirmasi sebelum submit
    function konfirmasiKirim() {
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
                document.getElementById('formPengajuan').submit();
            }
        });
    }

    // Update nama file yang dipilih
    function updateLabel(input) {
        const labelId = input.id + '_name';
        const fileName = input.files.length > 0 ? input.files[0].name : 'Belum ada file';
        document.getElementById(labelId).innerText = fileName;
    }

    // Tampilkan notifikasi dari session
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
        });
    @elseif (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
        });
    @endif
</script>