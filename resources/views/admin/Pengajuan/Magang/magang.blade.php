@extends('layouts.main')

@section('content')
    <h1 class="mb-4">Form Pengajuan Rekomendasi Magang</h1>

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
                <label for="hal_surat">Hal Surat</label>
                <input type="text" name="hal_surat" class="form-control">
            </div>

            <div class="col-6 mb-3">
                <label for="tanggal_surat">Tanggal Surat</label>
                <input type="date" name="tanggal_surat" class="form-control">
            </div>

            <div class="col-6 mb-3">
                <label for="tanggal_penelitian">Tanggal Magang (Durasi)</label>
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
        const form = document.getElementById('formPengajuan');
        let valid = true;
        let message = '';

        const mahasiswaGroups = document.querySelectorAll('.mahasiswa-group');
        mahasiswaGroups.forEach((group, index) => {
            const nama = group.querySelector('input[name="nama[]"]');
            const nim = group.querySelector('input[name="nim[]"]');
            const prodi = group.querySelector('input[name="program_studi[]"]');

            if (!nama.value.trim() || !nim.value.trim() || !prodi.value.trim()) {
                valid = false;
                message = `Data mahasiswa belum lengkap.`;
            }
        });

        // Cek kolom wajib lainnya
        const instansi = document.querySelector('input[name="instansi_tujuan"]');
        const suratDari = document.querySelector('input[name="surat_dari"]');
        const nomorSurat = document.querySelector('input[name="nomor_surat"]');
        const halSurat = document.querySelector('input[name="hal_surat"]');
        const tanggalSurat = document.querySelector('input[name="tanggal_surat"]');
        const tanggalMulai = document.querySelector('input[name="tanggal_mulai"]');
        const tanggalSelesai = document.querySelector('input[name="tanggal_selesai"]');

        if (valid && !instansi.value.trim()) {
            valid = false;
            message = 'Instansi Tujuan wajib diisi.';
        } else if (valid && !suratDari.value.trim()) {
            valid = false;
            message = 'Surat Dari wajib diisi.';
        } else if (valid && !nomorSurat.value.trim()) {
            valid = false;
            message = 'Nomor Surat wajib diisi.';
        } else if (valid && !halSurat.value.trim()) {
            valid = false;
            message = 'Hal Surat wajib diisi.';
        } else if (valid && !tanggalSurat.value) {
            valid = false;
            message = 'Tanggal Surat wajib diisi.';
        } else if (valid && (!tanggalMulai.value || !tanggalSelesai.value)) {
            valid = false;
            message = 'Tanggal Magang (mulai dan selesai) wajib diisi.';
        } else if (valid) {
            // Validasi tanggal logis
            const mulaiDate = new Date(tanggalMulai.value);
            const selesaiDate = new Date(tanggalSelesai.value);
            if (selesaiDate < mulaiDate) {
                valid = false;
                message = 'Tanggal selesai magang tidak boleh lebih awal dari tanggal mulai.';
            }
        }

        // Cek file upload
        const fileKTP = document.getElementById('file_ktp');
        const fileSurat = document.getElementById('file_surat_dari');
        if (!fileKTP.files.length) {
            valid = false;
            message = 'File KTP wajib diunggah.';
        } else if (!fileSurat.files.length) {
            valid = false;
            message = 'File Surat Pengantar wajib diunggah.';
        }

        if (!valid) {
            Swal.fire({
                icon: 'warning',
                title: 'Form Belum Lengkap',
                text: message,
            });
            return;
        }

        // Jika semua valid, tampilkan konfirmasi
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