<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  mixed  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            // Jika belum login, arahkan ke halaman login dengan pesan
            return redirect()->route('login')->with('error', 'Anda perlu login terlebih dahulu');
        }

        $user = Auth::user();

        // Cek apakah peran pengguna ada dalam daftar yang diperbolehkan
        if (in_array($user->role, $roles)) {
            return $next($request); // Lanjutkan request jika role cocok
        }

        // Jika role tidak cocok, arahkan ke halaman tertentu (misalnya beranda) dengan pesan error
        return redirect('/')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
