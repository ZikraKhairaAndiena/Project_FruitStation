<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan formulir login.
     */
    public function index()
    {
        // Menampilkan halaman login
        return view('login');
    }

    /**
     * Menangani percobaan autentikasi pengguna.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        // Validasi input login (email dan password)
        $credentials = $request->validate([
            'email' => ['required', 'email'], // Email harus ada dan dalam format yang valid
            'password' => ['required'], // Password harus ada
        ]);

        // Mencoba autentikasi dengan kredensial yang diberikan (email dan password)
        if (Auth::attempt($credentials)) {
            // Regenerasi sesi untuk melindungi dari serangan session fixation
            $request->session()->regenerate();

            // Mendapatkan data pengguna yang sedang login
            $user = Auth::user();

            // Redirect berdasarkan peran pengguna (role)
            if ($user->role === 'customer') {
                // Jika pengguna adalah customer, redirect ke halaman home customer
                return redirect()->route('customer.home')->with('success', 'Welcome ' . $user->name);
            } elseif (in_array($user->role, ['admin', 'super_admin', 'kurir'])) {
                // Jika pengguna adalah admin, super_admin, atau kurir, redirect ke dashboard
                return redirect()->route('dashboard.index')->with('success', 'Welcome ' . $user->name);
            }

            // Default redirect jika peran pengguna tidak dikenali (redirect ke halaman home umum)
            return redirect()->intended('home')->with('success', 'Welcome ' . $user->name);
        }

        // Jika autentikasi gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang dimasukkan tidak cocok.', // Pesan error untuk email yang tidak sesuai
        ])->withInput($request->only('email')); // Menyertakan input email yang dimasukkan sebelumnya
    }

    /**
     * Menangani logout dan pembersihan sesi.
     */
    public function logout(Request $request): RedirectResponse
    {
        // Mengeluarkan (logout) pengguna yang sedang login
        Auth::logout();

        // Invalidasi sesi yang ada untuk memastikan tidak ada sesi yang tersisa
        $request->session()->invalidate();

        // Regenerasi token CSRF untuk keamanan
        $request->session()->regenerateToken();

        // Redirect ke halaman utama setelah logout dengan pesan sukses
        return redirect('/home')->with('success', 'Anda telah berhasil logout.'); // Menampilkan pesan logout sukses
    }
}
