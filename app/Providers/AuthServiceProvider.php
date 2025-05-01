<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Definisikan Policies jika perlu, misalnya:
        // 'App\Models\Pengajuan' => 'App\Policies\PengajuanPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate untuk akses menu pengajuan magang
        Gate::define('viewPengajuan', function ($user) {
            // Cek apakah pengguna memiliki peran yang sesuai
            return in_array($user->role, ['admin', 'user']);
        });

        // Anda bisa menambahkan gate atau policy lainnya di sini jika perlu
    }
}
