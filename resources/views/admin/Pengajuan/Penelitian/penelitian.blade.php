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
                <input type="text" name="tempat_lahir" class="form-control" required>
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
        const form = document.getElementById('formPengajuan');
        let valid = true;
        let message = '';

        // ambil semua input yang diperlukan
        const nama = form.querySelector('[name="nama"]');
    const tempatLahir = form.querySelector('[name="tempat_lahir"]');
    const tanggalLahir = form.querySelector('[name="tanggal_lahir"]');
    const pekerjaan = form.querySelector('[name="pekerjaan"]');
    const alamat = form.querySelector('[name="alamat"]');
    const nomorIdentitas = form.querySelector('[name="nomor_identitas"]');
    const judulPenelitian = form.querySelector('[name="judul_penelitian"]');
    const instansiTujuan = form.querySelector('[name="instansi_tujuan"]');
    const suratDari = form.querySelector('[name="surat_dari"]');
    const nomorSurat = form.querySelector('[name="nomor_surat"]');
    const halSurat = form.querySelector('[name="hal_surat"]');
    const tanggalSurat = form.querySelector('[name="tanggal_surat"]');
    const tanggalMulai = form.querySelector('[name="tanggal_mulai"]');
    const tanggalSelesai = form.querySelector('[name="tanggal_selesai"]');
    const fileKTP = form.querySelector('#file_ktp');
    const fileSurat = form.querySelector('#file_surat_dari');

        // Validasi kolom wajib
        if (!nama.value.trim()) {
            valid = false;
            message = 'Nama wajib diisi.';
        } else if (!tempatLahir.value.trim()) {
            valid = false;
            message = 'Tempat Lahir wajib diisi.';
        } else if (!tanggalLahir.value) {
            valid = false;
            message = 'Tanggal Lahir wajib diisi.';
        } else if (!pekerjaan.value.trim()) {
            valid = false;
            message = 'Pekerjaan wajib diisi.';
        } else if (!alamat.value.trim()) {
            valid = false;
            message = 'Alamat wajib diisi.';
        } else if (!nomorIdentitas.value.trim()) {
            valid = false;
            message = 'Nomor Identitas (KTP) wajib diisi.';
        }else if (!/^\d+$/.test(nomorIdentitas.value.trim())) {
            valid = false;
            message = 'Nomor Identitas (KTP) hanya boleh terdiri dari angka.';
        } else if (nomorIdentitas.value.trim().length !== 16) {
            valid = false;
            message = 'Nomor Identitas (KTP) harus  16 digit.';
        } else if (!judulPenelitian.value.trim()) {
            valid = false;
            message = 'Judul Penelitian wajib diisi.';
        } else if (!instansiTujuan.value.trim()) {
            valid = false;
            message = 'Instansi Tujuan wajib diisi.';
        } else if (!suratDari.value.trim()) {
            valid = false;
            message = 'Surat Dari wajib diisi.';
        } else if (!nomorSurat.value.trim()) {
            valid = false;
            message = 'Nomor Surat wajib diisi.';
        } else if (!halSurat.value.trim()) {
            valid = false;
            message = 'Hal Surat wajib diisi.';
        } else if (!tanggalSurat.value) {
            valid = false;
            message = 'Tanggal Surat wajib diisi.';
        } else if (!tanggalMulai.value || !tanggalSelesai.value) {
            valid = false;
            message = 'Tanggal Penelitian (mulai dan selesai) wajib diisi.';
        } else {
            const mulai = new Date(tanggalMulai.value);
            const selesai = new Date(tanggalSelesai.value);
            if (selesai < mulai) {
                valid = false;
                message = 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.';
            }
        }

        // Validasi file
        if (valid && !fileKTP.files.length) {
            valid = false;
            message = 'File KTP wajib diunggah.';
        } else if (valid && !fileSurat.files.length) {
            valid = false;
            message = 'File Surat Pengantar wajib diunggah.';
        }
        // Jika tidak valid, tampilkan pesan
        if (!valid) {
            Swal.fire({
                icon: 'warning',
                title: 'Form Belum Lengkap',
                text: message,
            });
            return;
        }

        // Jika valid, tampilkan konfirmasi
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
                form.submit();
            }
        });
    }
    // Update nama file yang dipilih
        function updateLabel(input) {
            const labelId = input.id + '_name';
            const fileName = input.files.length > 0 ? input.files[0].name : 'Belum ada file';
            document.getElementById(labelId).innerText = fileName;
        }
</script>