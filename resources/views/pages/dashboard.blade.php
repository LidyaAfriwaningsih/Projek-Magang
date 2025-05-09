@extends('layouts.main')

@push('style')
    <link rel="stylesheet" href="{{asset('sneat/vendor/libs/apex-charts/apex-charts.css')}}" />
@endpush

@push('script')
    <script src="{{asset('sneat/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <script>
        const options = {
            chart: {
                type: 'bar'
            },
            series: [{
                name: '{{ __('dashboard.letter_transaction') }}',
                data: [{{ $todayIncomingLetter }},{{ $todayOutgoingLetter }},{{ $todayDispositionLetter }}]
            }],
            stroke: {
                curve: 'smooth',
            },
            xaxis: {
                categories: [
                    '{{ __('dashboard.incoming_letter') }}',
                    '{{ __('dashboard.outgoing_letter') }}',
                    '{{ __('dashboard.disposition_letter') }}',
                ],
            }
        }

        const chart = new ApexCharts(document.querySelector("#today-graphic"), options);
        chart.render();
    </script>
@endpush

@section('content')
@if(auth()->user()->role == 'admin')
    {{-- Dashboard untuk Admin --}}
    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card mb-4">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h4 class="card-title text-primary">{{ $greeting }}</h4>
                            <p class="mb-4">{{ $currentDate }}</p>
                            <p style="font-size: smaller" class="text-gray">*) {{ __('dashboard.today_report') }}</p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{asset('sneat/img/man-with-laptop-light.png')}}" height="140"
                                 alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                 data-app-light-img="illustrations/man-with-laptop-light.png">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div>
                                <div class="card-title">
                                    <h5 class="text-nowrap mb-2">{{ __('dashboard.today_graphic') }}</h5>
                                    <span class="badge bg-label-warning rounded-pill">{{ __('dashboard.today') }}</span>
                                </div>
                                <div class="mt-sm-auto">
                                    @if($percentageLetterTransaction > 0)
                                        <small class="text-success fw-semibold">
                                            <i class="bx bx-chevron-up"></i> {{ $percentageLetterTransaction }}%
                                        </small>
                                    @elseif($percentageLetterTransaction < 0)
                                        <small class="text-danger fw-semibold">
                                            <i class="bx bx-chevron-down"></i> {{ $percentageLetterTransaction }}%
                                        </small>
                                    @endif
                                    <h3 class="mb-0 display-4">{{ $todayLetterTransaction }}</h3>
                                </div>
                            </div>
                            <div id="profileReportChart" style="min-height: 80px; width: 80%">
                                <div id="today-graphic"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <x-dashboard-card-simple
                        :label="__('dashboard.incoming_letter')"
                        :value="$todayIncomingLetter"
                        :daily="true"
                        color="success"
                        icon="bx-envelope"
                        :percentage="$percentageIncomingLetter"
                    />
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <x-dashboard-card-simple
                        :label="__('dashboard.outgoing_letter')"
                        :value="$todayOutgoingLetter"
                        :daily="true"
                        color="danger"
                        icon="bx-envelope"
                        :percentage="$percentageOutgoingLetter"
                    />
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <x-dashboard-card-simple
                        :label="__('dashboard.disposition_letter')"
                        :value="$todayDispositionLetter"
                        :daily="true"
                        color="primary"
                        icon="bx-envelope"
                        :percentage="$percentageDispositionLetter"
                    />
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <x-dashboard-card-simple
                        :label="__('dashboard.active_user')"
                        :value="$activeUser"
                        :daily="false"
                        color="info"
                        icon="bx-user-check"
                        :percentage="0"
                    />
                </div>
            </div>
        </div>
    </div>
@else
    {{-- Dashboard untuk User --}}
    <div class="row">
        <div class="col-12">
            <div class="card text-center">
                <div class="card-body">
                    <h3>Selamat Datang di Sistem Informasi BAKESBANGPOL</h3>
                    <p class="text-muted">Silakan pilih menu pada sidebar untuk memulai</p>

                    <!-- Carousel -->
                    <div id="carouselExampleIndicators" class="carousel slide mt-3" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
                        </div>
                        <div class="carousel-inner rounded shadow">
                            <div class="carousel-item active">
                                <img src="{{ asset('sneat/img/bukittinggi.jpg') }}" class="d-block w-100" style="max-height: 400px; object-fit: cover;" alt="Gambar 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('sneat/img/cute.jpeg') }}" class="d-block w-100" style="max-height: 400px; object-fit: cover;" alt="Gambar 2">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('sneat/img/cat.jpeg') }}" class="d-block w-100" style="max-height: 400px; object-fit: cover;" alt="Gambar 3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                    <!-- End Carousel -->
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
