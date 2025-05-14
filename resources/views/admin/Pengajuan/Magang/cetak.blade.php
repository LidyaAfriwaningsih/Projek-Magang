<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Surat Rekomendasi Izin Magang</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.6;
            font-size: 14px;
        }

        .content {
            margin: 20px 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-bordered td, .table-bordered th {
            border: 1px solid black;
            padding: 5px;
        }

        .text-center {
            text-align: center;
        }

        .mt-3 {
            margin-top: 1.5rem;
        }

        .mt-5 {
            margin-top: 3rem;
        }

        /* KOP SURAT Styling */
        .kop-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 3px solid black;
            padding: 10px 40px 10px 40px;
            margin-bottom: 20px;
        }

        .kop-logo {
            width: 80px;
        }

        .kop-logo img {
            width: 100%;
            height: auto;
            display: block;
        }

        .kop-text {
            text-align: center;
            flex-grow: 1;
        }

        .kop-text h2, .kop-text h3, .kop-text p {
            margin: 0;
            line-height: 1.2;
        }
    </style>
</head>
<body>

<!-- KOP SURAT -->
<div class="kop-container">
    <!-- Logo Kiri -->
    <div class="kop-logo">
        <img src="{{ public_path('logobukittinggi.webp') }}" alt="Logo Kiri">
    </div>

    <!-- Teks Tengah -->
    <div class="kop-text">
        <h3>PEMERINTAH KOTA BUKITTINGGI</h3>
        <h2>BADAN KESATUAN BANGSA DAN POLITIK</h2>
        <p>Jl. Jend. Sudirman No. 27 – 29 Bukittinggi Telp. (0752) 23976</p>
        <p>Email: kesbangpol@bukittinggikota.go.id</p>
    </div>

    <!-- Logo Kanan (Kosong untuk keseimbangan) -->
    <div class="kop-logo"></div>
</div>

<!-- Konten Surat -->
<div class="content">
    <h3 class="text-center"><u>REKOMENDASI IZIN MAGANG</u></h3>
    <p class="text-center">Nomor: {{ $pengajuan->nomor_surat }}</p>

    <p><strong>Membaca:</strong><br>
        Surat dari {{ $pengajuan->surat_dari }}, Nomor {{ $pengajuan->nomor_surat }}, Tanggal {{ $pengajuan->tanggal_surat }}, Hal {{ $pengajuan->hal_surat }}.
    </p>

    <p>Dengan ini memberikan rekomendasi kepada:</p>

    <table class="table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Program Studi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">1</td>
                <td>{{ $pengajuan->nama }}</td>
                <td>{{ $pengajuan->nim }}</td>
                <td>{{ $pengajuan->program_studi }}</td>
            </tr>
        </tbody>
    </table>

    <p><strong>Untuk:</strong><br>
        Melaksanakan {{ $pengajuan->hal_surat }} di {{ $pengajuan->instansi_tujuan }}
    </p>

    <p>Dengan ketentuan sebagai berikut:</p>
    <ol>
        <li>Tidak boleh menyimpang dari kerangka tujuan Praktik;</li>
        <li>Memberitahukan keadaan serta maksud Praktik yang akan dilaksanakan dengan menunjukkan surat Rekomendasi Melaksanakan Praktik serta melaporkan diri sebelum meninggalkan tempat Praktik kepada Walikota Bukittinggi c.q Kepala Badan Kesatuan Bangsa dan Politik;</li>
        <li>Mematuhi semua peraturan yang berlaku dan menghormati adat istiadat masyarakat setempat;</li>
        <li>Mengirimkan laporan hasil Praktik sebanyak 1 (satu) eksamplar kepada Walikota Bukittinggi cq. Kepala Badan Kesatuan Bangsa dan Politik paling lambat 1 (satu) bulan setelah Magang selesai;</li>
        <li>Bila terjadi penyimpangan/pelanggaran terhadap ketentuan tersebut di atas, maka Rekomendasi Melaksanakan Praktik ini akan dicabut;</li>
        <li>Surat keterangan selesai magang dikeluarkan oleh tempat magang/praktik belajar lapangan.</li>
    </ol>

    <p>Demikian rekomendasi ini dibuat, untuk dipergunakan sebagaimana mestinya.</p>

    <div class="mt-5" style="text-align: right;">
        Bukittinggi, {{ $pengajuan->tanggalCetak }}<br>
        a. n. Kepala Badan Kesatuan Bangsa dan Politik<br>
        Kepala Bidang Kesatuan Bangsa<br><br><br><br>

        <strong>FITRIALDI, S.Sos, M.M</strong><br>
        Penata Tk. I – III/d<br>
        NIP. 198108032005011006
    </div>

    <div class="mt-3">
        <strong>Tembusan:</strong><br>
        1. Wali Kota Bukittinggi (Sebagai Laporan);
    </div>
</div>

</body>
</html>
