@extends('layouts.main')

@section('content')
<div class="container py-4">
    <h4 class="mb-3">Tentang Kami</h4>
    <p>
        <strong>Badan Kesatuan Bangsa dan Politik (Kesbangpol)</strong> Kota Bukittinggi berlokasi di Kompleks Balaikota Bukittinggi, 
        Jl. Sudirman No. 2, Kelurahan Aur Kuning, Kecamatan Aur Birugo Tigo Baleh, Kota Bukittinggi, Sumatera Barat, 
        dengan Kode Pos 26131.
    </p>

    <h5 class="mt-4 mb-3">Jadwal Pelayanan Kantor</h5>
    <div class="table-responsive" style="max-width: 600px;">
        <table class="table table-bordered">
            <thead class="table-light text-center">
                <tr>
                    <th>Hari</th>
                    <th>Jam Pagi</th>
                    <th>Jam Sore</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr>
                    <td>Senin</td>
                    <td>08.00 – 12.00</td>
                    <td>13.30 – 16.00</td>
                </tr>
                <tr>
                    <td>Selasa</td>
                    <td>08.00 – 12.00</td>
                    <td>13.30 – 16.00</td>
                </tr>
                <tr>
                    <td>Rabu</td>
                    <td>08.00 – 12.00</td>
                    <td>13.30 – 16.00</td>
                </tr>
                <tr>
                    <td>Kamis</td>
                    <td>08.00 – 12.00</td>
                    <td>13.30 – 16.00</td>
                </tr>
                <tr>
                    <td>Jumat</td>
                    <td>08.00 – 11.30</td>
                    <td>14.00 – 17.00</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
