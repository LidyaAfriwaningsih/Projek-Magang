<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('home') }}" class="app-brand-link">
            <img src="{{ asset('logokesbang.jpg') }}" alt="{{ config('app.name') }}" width="50">
            <span class="app-brand-text demo text-black fw-bolder ms-2" style="font-size: 20px;">
                {{ config('app.name') }}
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Home -->
        <li class="menu-item {{ Route::is('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="{{ __('menu.home') }}">{{ __('menu.home') }}</div>
            </a>
        </li>

        @if (auth()->user()->role == 'admin')
            <!-- Header -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">{{ __('menu.header.main_menu') }}</span>
            </li>

            <!-- Transaksi -->
            <li class="menu-item {{ Route::is('transaction.*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-mail-send"></i>
                    <div data-i18n="{{ __('menu.transaction.menu') }}">{{ __('menu.transaction.menu') }}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ Route::is('transaction.incoming.*') || Route::is('transaction.disposition.*') ? 'active' : '' }}">
                        <a href="{{ route('transaction.incoming.index') }}" class="menu-link">
                            <div data-i18n="{{ __('menu.transaction.incoming_letter') }}">
                                {{ __('menu.transaction.incoming_letter') }}
                            </div>
                        </a>
                    </li>

                    <li class="menu-item {{ Route::is('transaction.outgoing.*') ? 'active' : '' }}">
                        <a href="{{ route('transaction.outgoing.index') }}" class="menu-link">
                            <div data-i18n="{{ __('menu.transaction.outgoing_letter') }}">
                                {{ __('menu.transaction.outgoing_letter') }}
                            </div>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Agenda -->
            <li class="menu-item {{ Route::is('agenda.*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-book"></i>
                    <div data-i18n="{{ __('menu.agenda.menu') }}">{{ __('menu.agenda.menu') }}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ Route::is('agenda.incoming') ? 'active' : '' }}">
                        <a href="{{ route('agenda.incoming') }}" class="menu-link">
                            <div data-i18n="{{ __('menu.agenda.incoming_letter') }}">
                                {{ __('menu.agenda.incoming_letter') }}
                            </div>
                        </a>
                    </li>
                    <li class="menu-item {{ Route::is('agenda.outgoing') ? 'active' : '' }}">
                        <a href="{{ route('agenda.outgoing') }}" class="menu-link">
                            <div data-i18n="{{ __('menu.agenda.outgoing_letter') }}">
                                {{ __('menu.agenda.outgoing_letter') }}
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item {{ request()->routeIs('pengajuan.*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-edit"></i>
                    <div>Pengajuan</div>
                </a>
                <ul class="menu-sub">
                    @if (auth()->user()->role == 'admin')
                        <li class="menu-item {{ request()->routeIs('admin.magang*') ? 'active' : '' }}">
                            <a href="{{ route('admin.magang.index') }}" class="menu-link">
                                <div>Surat Rekomendasi Magang</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('admin.penelitian.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.penelitian.index') }}" class="menu-link">
                                <div>Surat Izin Penelitian</div>
                            </a>
                        </li>
                    @else
                        <li class="menu-item {{ request()->routeIs('pengajuan.magang') ? 'active' : '' }}">
                            <a href="{{ route('pengajuan.magang') }}" class="menu-link">
                                <div>Surat Rekomendasi Magang</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('pengajuan.penelitian') ? 'active' : '' }}">
                            <a href="{{ route('pengajuan.penelitian') }}" class="menu-link">
                                <div>Surat Izin Penelitian</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @else
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">{{ __('menu.header.main_menu') }}</span>
            </li>
            <!-- Panduan -->
            <li class="menu-item {{ request()->is('panduan') ? 'active' : '' }}">
                <a href="{{ route('panduan.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-book-open"></i>
                    <div>Panduan</div>
                </a>
            </li>

            <!-- Pengajuan -->
            <li class="menu-item {{ request()->routeIs('pengajuan.*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-edit"></i>
                    <div>Pengajuan</div>
                </a>
                <ul class="menu-sub">
                    @if (auth()->user()->role == 'admin')
                        <li class="menu-item {{ request()->routeIs('admin.magang.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.magang.index') }}" class="menu-link">
                                <div>Surat Rekomendasi Magang</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('admin.penelitian.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.penelitian.index') }}" class="menu-link">
                                <div>Surat Izin Penelitian</div>
                            </a>
                        </li>
                    @else
                        <li class="menu-item {{ request()->routeIs('pengajuan.magang') ? 'active' : '' }}">
                            <a href="{{ route('pengajuan.magang') }}" class="menu-link">
                                <div>Surat Rekomendasi Magang</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('pengajuan.penelitian') ? 'active' : '' }}">
                            <a href="{{ route('pengajuan.penelitian') }}" class="menu-link">
                                <div>Surat Izin Penelitian</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            <!-- Status -->
            <li class="menu-item {{ request()->routeIs('user.pengajuan.index') ? 'active' : '' }}">
                <a href="{{ route('user.pengajuan.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-history"></i>
                    <div>Status</div>
                </a>
            </li>

            <!-- Tentang -->
            <li class="menu-item {{ request()->is('admin/tentang') ? 'active' : '' }}">
                <a href="{{ route('admin.tentang.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-info-circle"></i>
                    <div>Tentang</div>
                </a>
            </li>
        @endif

        @if (auth()->user()->role == 'admin')
            <!-- Other Menu -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">{{ __('menu.header.other_menu') }}</span>
            </li>

            <!-- Referensi -->
            <li class="menu-item {{ Route::is('reference.*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-analyse"></i>
                    <div data-i18n="{{ __('menu.reference.menu') }}">{{ __('menu.reference.menu') }}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ Route::is('reference.classification.*') ? 'active' : '' }}">
                        <a href="{{ route('reference.classification.index') }}" class="menu-link">
                            <div data-i18n="{{ __('menu.reference.classification') }}">
                                {{ __('menu.reference.classification') }}
                            </div>
                        </a>
                    </li>
                    <li class="menu-item {{ Route::is('reference.status.*') ? 'active' : '' }}">
                        <a href="{{ route('reference.status.index') }}" class="menu-link">
                            <div data-i18n="{{ __('menu.reference.status') }}">
                                {{ __('menu.reference.status') }}
                            </div>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- User -->
            <li class="menu-item {{ Route::is('user.*') ? 'active' : '' }}">
                <a href="{{ route('user.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-pin"></i>
                    <div data-i18n="{{ __('menu.users') }}">{{ __('menu.users') }}</div>
                </a>
            </li>
        @endif
    </ul>
</aside>