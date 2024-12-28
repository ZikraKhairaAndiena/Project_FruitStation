<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Display the registration form.
     */
    public function index()
    {
        return view('register');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
            'captcha' => 'required|captcha',
            'no_telepon' => 'required|string|min:10|max:15', // Validation for phone number
            'alamat' => 'required|string|max:500', // Validation for address
        ]);

        // Buat data user baru
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'no_telepon' => $validated['no_telepon'], // Store phone number
            'alamat' => $validated['alamat'], // Store address
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('pesan', 'Registrasi berhasil, silakan login.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
