<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Surat Rekomendasi Izin Penelitian</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.6;
            font-size: 14px;
        }

        .content {
            margin: 20px 40px;
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

        .kop-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 3px solid black;
            padding: 10px 40px;
            margin-bottom: 20px;
        }

        .kop-logo {
            width: 80px;
        }

        .kop-logo img {
            width: 100%;
            height: auto;
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
    <div class="kop-logo">
        <img src="{{ public_path('logobukittinggi.webp') }}" alt="Logo">
    </div>

    <div class="kop-text">
        <h3>PEMERINTAH KOTA BUKITTINGGI</h3>
        <h2>BADAN KESATUAN BANGSA DAN POLITIK</h2>
        <p>Jl. Jend. Sudirman No. 27 – 29 Bukittinggi Telp. (0752) 23976</p>
        <p>Email: kesbangpol@bukittinggikota.go.id</p>
    </div>

    <div class="kop-logo"></div>
</div>

<!-- ISI SURAT -->
<div class="content">
    <h3 class="text-center"><u>REKOMENDASI IZIN PENELITIAN</u></h3>
    <p class="text-center">Nomor: {{ $pengajuan->nomor_surat }}</p>

    <p><strong>Dasar:</strong></p>
    <ol>
        <li>Undang-Undang Republik Indonesia Nomor 18 Tahun 2022 tentang Sistem Nasional Penelitian, Pengembangan dan Penerapan Ilmu Pengetahuan dan Teknologi;</li>
        <li>Undang-Undang Republik Indonesia Nomor 23 Tahun 2014 tentang Pemerintah Daerah;</li>
        <li>Peraturan Menteri Dalam Negeri Republik Indonesia Nomor 20 Tahun 2011 tentang Pedoman Penelitian dan Pengembangan di lingkungan Kementerian Dalam Negeri dan Pemerintah Daerah;</li>
        <li>Peraturan Menteri Dalam Negeri Republik Indonesia Nomor 3 Tahun 2018 tentang Penerbitan Surat Keterangan Penelitian.</li>
    </ol>

    <p><strong>Menimbang:</strong></p>
    <ol>
        <li>Bahwa sesuai surat dari {{ $pengajuan->surat_dari }}, Nomor {{ $pengajuan->nomor_surat }}, Tanggal {{ $pengajuan->tanggal_surat }}, Hal {{ $pengajuan->hal_surat }}.</li>
        <li>Bahwa untuk tertib administrasi dan pengendalian pelaksanaan penelitian serta pengembangan perlu diterbitkan Surat Keterangan Penelitian.</li>
        <li>Bahwa sesuai konsideran huruf a dan b serta hasil Verifikasi Badan Kesatuan Bangsa dan Politik Kota Bukittinggi, berkas persyaratan administrasi Surat Keterangan Penelitian telah memenuhi syarat.</li>
    </ol>

    <p>Kepala Badan Kesatuan Bangsa dan Politik Kota Bukittinggi, memberikan surat keterangan penelitian kepada:</p>

    <table style="margin-left: 20px;">
        <tr><td>Nama</td><td>: {{ $pengajuan->nama }}</td></tr>
        <tr><td>Tempat/Tanggal Lahir</td><td>: {{ $pengajuan->tempat_lahir }} / {{ $pengajuan->tanggal_lahir }}</td></tr>
        <tr><td>Pekerjaan</td><td>: {{ $pengajuan->pekerjaan }}</td></tr>
        <tr><td>Alamat</td><td>: {{ $pengajuan->alamat }}</td></tr>
        <tr><td>Nomor Identitas</td><td>: {{ $pengajuan->nomor_identitas }}</td></tr>
        <tr><td>Judul Penelitian</td><td>: {{ $pengajuan->judul_penelitian }}</td></tr>
    </table>

    <p><strong>Untuk:</strong><br>
    Melakukan {{ $pengajuan->hal_surat }} dari tanggal {{ $pengajuan->tanggal_mulai }} s/d {{ $pengajuan->tanggal_selesai }} di {{ $pengajuan->instansi_tujuan }} Kota Bukittinggi.</p>

    <p>Demikian surat keterangan penelitian ini dibuat untuk dipergunakan sebagaimana mestinya.</p>

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
