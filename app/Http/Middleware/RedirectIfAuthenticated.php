<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                // ✅ Arahkan sesuai peran pengguna
                if ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard'); // Sesuaikan dengan route admin
                } elseif ($user->role === 'user') {
                    return redirect()->route('user.dashboard'); // Jika ada peran user
                } else {
                    return redirect()->route('home'); // Default untuk user biasa
                }
            }
        }

        return $next($request);
    }
}
