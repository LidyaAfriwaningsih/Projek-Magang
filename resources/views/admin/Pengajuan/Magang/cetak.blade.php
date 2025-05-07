<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekomendasi Izin Magang</title>
    <style>
        body {
            font-family: "Times New Roman", Times, sans-serif;
            font-size: 14px;
            line-height: 1.6;
        }
        .content {
            margin: 0 40px;
        }
        .footer {
            margin-top: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .signature {
            text-align: right;
            margin-top: 40px;
        }
        .table-bordered, .table-bordered th, .table-bordered td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        /* Header / KOP Styling */
        .kop-container {
            align-items: center; /* ensures vertical alignment */
            justify-content: space-between;
            border-bottom: 3px solid black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop-logo {
            width: 80px;
            flex-shrink: 0;
        }

        .kop-logo img {
            width: 180px;
            height: auto;
            display: block;
        }

        .kop-text {
            text-align: center;
            flex-grow: 1;
        }

        .kop-text h3, .kop-text h2, .kop-text p {
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

    <!-- Logo Kanan -->
    <div class="kop-logo"></div>
</div>

<!-- Konten Surat -->
<div class="content">
    <h3 style="text-align: center;">REKOMENDASI IZIN MAGANG</h3>
    <p style="text-align: center;">Nomor : 000.9/ L.2.c/BKPol-BKT/2025</p>

    <p>Membaca: Surat dari Fakultas Ilmu Sosial dan Ilmu Politik Universitas Andalas, Nomor B/2389/UN16.08.D/PK.01.06/2024, Tanggal 18 Desember 2024, Hal Permohonan Izin Kerja Magang.</p>

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
                <td>1</td>
                <td>{{ $pengajuan->nama }}</td>
                <td>{{ $pengajuan->nim }}</td>
                <td>{{ $pengajuan->program_studi }}</td>
            </tr>
        </tbody>
    </table>

    <p>Untuk: Melaksanakan Permohonan Izin Kerja Magang di Badan Kepegawaian dan Pengembangan Sumber Daya Manusia dari tanggal 06 Januari 2025 sampai dengan 31 Januari 2025.</p>

    <p>Dengan ketentuan sebagai berikut:</p>
    <ol>
        <li>Tidak boleh menyimpang dari kerangka tujuan Praktik;</li>
        <li>Memberitahukan kedatangan serta maksud Praktik dan melaporkan diri sebelum meninggalkan tempat Praktik;</li>
        <li>Mematuhi semua peraturan yang berlaku dan menghormati adat istiadat masyarakat setempat;</li>
        <li>Mengirimkan laporan hasil Praktik sebanyak 1 (satu) eksemplar paling lambat 1 (satu) bulan setelah Magang selesai;</li>
        <li>Bila terjadi pelanggaran, maka Rekomendasi Melaksanakan Praktik ini akan dicabut;</li>
        <li>Surat keterangan selesai magang dikeluarkan oleh tempat magang/praktik belajar lapangan.</li>
    </ol>

    <p>Demikian rekomendasi ini dibuat, untuk dipergunakan sebagaimana mestinya.</p>

    <div class="signature">
        <p>Bukittinggi, {{ $tanggalCetak }}<br>
        a.n. Kepala Badan Kesatuan Bangsa dan Politik<br>
        Kepala Bidang Kesatuan Bangsa,</p>
        <br><br><br>
        <p><strong>FITRIADI, S.Sos, M.M</strong><br>
        Penata Tk. I - III/d<br>
        NIP. 19810803 200501 1 006</p>
    </div>

    <p>Tembusan:</p>
    <ol>
        <li>Wali Kota Bukittinggi (Sebagai Laporan);</li>
        <li>Dekan Fakultas Ilmu Sosial dan Ilmu Politik;</li>
        <li>Kepala Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kota Bukittinggi.</li>
    </ol>
</div>

</body>
</html>
