<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Pengajuan Penelitian</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; line-height: 1.6; }
        .header { text-align: center; margin-bottom: 20px; }
        .content { margin: 0 40px; }
        .footer { margin-top: 40px; text-align: right; }
    </style>
</head>
<body>

<div class="header">
    <h2>Surat Pengajuan Penelitian</h2>
</div>

<div class="content">
    <p>Kepada Yth.</p>
    <p>Pimpinan Instansi Terkait</p>
    <p>Di Tempat</p>

    <p>Dengan hormat,</p>
    <p>Saya yang bertanda tangan di bawah ini:</p>

    <table>
        <tr><td>Nama</td><td>: {{ $pengajuan->nama }}</td></tr>
        <tr><td>NIM</td><td>: {{ $pengajuan->nim }}</td></tr>
        <tr><td>Program Studi</td><td>: {{ $pengajuan->program_studi }}</td></tr>
        <tr><td>Judul Penelitian</td><td>: {{ $pengajuan->judul_penelitian }}</td></tr>
    </table>

    <p>Dengan ini mengajukan permohonan izin untuk melakukan penelitian dengan judul tersebut di atas.</p>

    <p>Demikian surat pengajuan ini saya sampaikan. Atas perhatian dan kerjasamanya saya ucapkan terima kasih.</p>
</div>

<div class="footer">
    <p>Padang, {{ now()->format('d F Y') }}</p>
    <p><br><br><strong>{{ $pengajuan->nama }}</strong></p>
</div>

</body>
</html>
