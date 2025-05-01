<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('public/sneat/') }}" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>{{ __('menu.auth.login') }} | {{ config('app.name') }}</title>
    <meta name="description" content=""/>
    <link rel="icon" type="image/x-icon" href="{{ asset('sneat/img/favicon/favicon.ico') }}"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('sneat/vendor/fonts/boxicons.css') }}"/>
    <link rel="stylesheet" class="template-customizer-core-css" href="{{ asset('sneat/vendor/css/core.css') }}"/>
    <link rel="stylesheet" class="template-customizer-theme-css" href="{{ asset('sneat/vendor/css/theme-default.css') }}"/>
    <link rel="stylesheet" href="{{ asset('sneat/css/demo.css') }}"/>
    <link rel="stylesheet" href="{{ asset('sneat/vendor/css/pages/page-auth.css') }}"/>
</head>
<body>
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body">
                    <div class="app-brand justify-content-center">
                        <a href="{{ route('home') }}" class="app-brand-link gap-2">
                            <img src="{{ asset('logokesbang.jpg') }}" alt="{{ config('app.name') }}" width="110px">
                        </a>
                    </div>

                    <!-- Notifikasi sukses jika registrasi berhasil -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <x-input-form name="email" type="email" :label="__('model.user.email')" />
                        </div>
                        <div class="mb-3">
                            <x-input-form name="password" type="password" :label="__('model.user.password')" />
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-primary d-grid w-100" type="submit">{{ __('menu.auth.login') }}</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <p>Belum punya akun? <a href="{{ route('register') }}" class="btn btn-outline-secondary">Daftar Sekarang</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
