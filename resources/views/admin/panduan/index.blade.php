@extends('layouts.main')

@section('content')
    <div class="container">
        <h4>Panduan Pengajuan Surat</h4>
        <p>Silakan baca panduan berikut untuk memahami proses pengajuan surat</p>
        <h5>Aturan:</h5>
       <ol>
        <li>Surat ditujukan pada Kesbangpol Bukittinggi</li>
        <li>KTP yang diupload 1 saja (jika berkelompok)</li>
        <li>Pastikan meminta stempel persetujuan magang terlebih dahulu pada instansi tempat tujuan (Surat Rekomendasi Magang)</li>
        <li>Surat dapat dijemput kurang lebih 2 hari</li>
        </ol>


        <!-- Carousel dengan background color -->
       <div id="carouselPanduan" class="carousel slide mt-4" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselPanduan" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselPanduan" data-bs-slide-to="1"></button>
           
        </div>
        <div class="carousel-inner rounded shadow" style="background-color: #7da6cf; padding: 20px;">
            <div class="carousel-item active">
                <div class="text-center mb-3 fw-bold text-black fs-4">
                    Surat Harus Ditujukan Pada Kesbangpol
                </div>
                <img src="{{ asset('sneat/img/ditujukan-kepada.jpg') }}" class="d-block w-75 mx-auto" style="max-height: 600px; object-fit: contain;" alt="Panduan 1">
            </div>
            <div class="carousel-item">a
                <div class="text-center mb-3 fw-bold text-black fs-4">
                    Alur Kerja Pengajuan Surat
                </div>
                <img src="{{ asset('sneat/img/Activity.jpg') }}" class="d-block w-75 mx-auto" style="max-height: 600px; object-fit: contain;" alt="Panduan 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselPanduan" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselPanduan" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
        </div>

    </div>
@endsection