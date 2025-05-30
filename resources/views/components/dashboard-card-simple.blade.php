<div class="card">
    <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
                <span class="badge bg-label-{{ $color }} p-2">
                    <i class="bx {{ $icon }} text-{{ $color }}"></i>
                </span>
            </div>
            @if($label != __('dashboard.disposition_letter') && !(auth()->user()->role == 'user' && $label == __('dashboard.active_user')))
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                        @if($label == __('dashboard.incoming_letter'))
                            <a class="dropdown-item"
                               href="{{ route('transaction.incoming.index') }}">{{ __('dashboard.view_more') }}</a>
                        @elseif($label == __('dashboard.outgoing_letter'))
                            <a class="dropdown-item"
                               href="{{ route('transaction.outgoing.index') }}">{{ __('dashboard.view_more') }}</a>
                        @elseif($label == 'Pengajuan')
                            <a class="dropdown-item"
                            href="{{ route('admin.magang.index') }}">{{ __('dashboard.view_more') }}</a>
                        @elseif($label == __('dashboard.active_user'))
                            <a class="dropdown-item"
                               href="{{ route('user.index') }}">{{ __('dashboard.view_more') }}</a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        <span class="fw-semibold d-block mb-1">{{ $label }} {{ $daily ? '*' : '' }}</span>
        
        <!-- Menampilkan jumlah pengajuan hari ini -->
        @if($label == __('dashboard.pengajuan_hari_ini')) <!-- Sesuaikan dengan label yang sesuai -->
            <h3 class="card-title mb-2">{{ $todayPengajuan }} Pengajuan Hari Ini</h3>
            @if($percentagePengajuan > 0)
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> {{ $percentagePengajuan }}%</small>
            @elseif($percentagePengajuan < 0)
                <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> {{ $percentagePengajuan }}%</small>
            @endif
        @else
            <h3 class="card-title mb-2">{{ $value }}</h3>
            @if($percentage > 0)
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> {{ $percentage }}%</small>
            @elseif($percentage < 0)
                <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> {{ $percentage }}%</small>
            @endif
        @endif
    </div>
</div>
