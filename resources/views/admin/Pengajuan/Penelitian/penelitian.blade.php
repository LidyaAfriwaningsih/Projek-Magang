@extends('layouts.main')

@section('content')
    <h1 class="mb-4">Form Pengajuan Izin Penelitian</h1>

    <form id="formPengajuan" action="{{ route('pengajuan.penelitian') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-6 mb-3">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="col-6 mb-3">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" name="tanggal_lahir" class="form-control" required>
            </div>

            <div class="col-6 mb-3">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>

            <div class="col-6 mb-3">
                <label for="pekerjaan">Pekerjaan</label>
                <input type="text" name="pekerjaan" class="form-control" required>
            </div>

            <div class="col-6 mb-3">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" class="form-control" required>
            </div>

            <div class="col-6 mb-3">
                <label for="nomor_identitas">Nomor Identitas (KTP)</label>
                <input type="text" name="nomor_identitas" class="form-control" required>
            </div>

            <div class="col-6 mb-3">
                <label for="judul_penelitian">Judul Penelitian</label>
                <input type="text" name="judul_penelitian" class="form-control" required>
            </div>

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
                <label for="hal_surat">Hal Surat</label>
                <input type="text" name="hal_surat" class="form-control">
            </div>

            <div class="col-6 mb-3">
                <label for="tanggal_surat">Tanggal Surat</label>
                <input type="date" name="tanggal_surat" class="form-control">
            </div>

            <div class="col-6 mb-3">
                <label for="tanggal_penelitian">Tanggal Penelitian (Durasi)</label>
                <div class="d-flex gap-2">
                    <input type="date" name="tanggal_mulai" class="form-control" placeholder="Mulai">
                    <span class="align-self-center">s/d</span>
                    <input type="date" name="tanggal_selesai" class="form-control" placeholder="Selesai">
                </div>
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
                <label for="file_surat_dari">Upload Surat Pengantar</label><br>
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

// Tambah dan hapus data mahasiswa
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Tambah instansi tujuan
        document.querySelector('button.btn.btn-secondary[type="button"]').addEventListener('click', function () {
            const container = document.getElementById('instansi-container');
            const group = document.createElement('div');
            group.classList.add('input-group', 'mb-2');
            group.innerHTML = `
                <input type="text" name="instansi_tujuan[]" class="form-control" placeholder="Instansi Tujuan" required>
                <button class="btn btn-danger" type="button">Hapus</button>
            `;
            container.appendChild(group);
        });

        // Hapus instansi tujuan
        document.addEventListener('click', function (e) {
            if (e.target.matches('#instansi-container .btn-danger')) {
                const group = e.target.closest('.input-group');
                if (group) {
                    group.remove();
                }
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