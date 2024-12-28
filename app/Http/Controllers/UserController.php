<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil nilai pencarian dari request
        $search = $request->get('search');

        // Ambil data pengguna dengan relasi berdasarkan pencarian
        $users = User::when($search, function ($query, $search) {
            // Mencari berdasarkan nama atau email
            return $query->where('name', 'like', '%'.$search.'%')
                         ->orWhere('email', 'like', '%'.$search.'%');
        })
        ->paginate(10);

        // Kembalikan data ke view
        return view('dashboard.pengguna.index', compact('users'));
    }


    // Form tambah pengguna
    public function create()
    {
        return view('dashboard.pengguna.create'); // Mengarahkan ke view create
    }

    // Simpan data pengguna baru
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:superadmin,admin,customer',
            'no_telepon' => 'nullable|string|min:10|max:15',
            'alamat' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data pengguna
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Enkripsi password
            'role' => $request->role,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('dashboard.pengguna.index')->with('success', 'User created successfully!');
    }

    // Tampilkan detail pengguna untuk diedit
    public function edit($id)
    {
        $user = User::findOrFail($id); // Cari pengguna berdasarkan ID
        return view('dashboard.pengguna.edit', compact('user')); // Mengarahkan ke view edit
    }

    // Update data pengguna
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:superadmin,admin,customer',
            'no_telepon' => 'nullable|string|min:10|max:15',
            'alamat' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Perbarui data pengguna
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'role' => $request->role,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('dashboard.pengguna.index')->with('success', 'User updated successfully!');
    }

    // Hapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Cek jika user yang akan dihapus memiliki role super_admin
        if ($user->role === 'super_admin') {
            return redirect()->route('dashboard.pengguna.index')->with('error', 'Pengguna dengan role super_admin tidak dapat dihapus.');
        }

        // Jika bukan super_admin, lanjutkan proses penghapusan
        $user->delete();

        return redirect()->route('dashboard.pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }


    // Tampilkan detail pengguna
    public function show($id)
    {
        $user = User::findOrFail($id); // Mencari pengguna berdasarkan ID
        return view('dashboard.pengguna.show', compact('user')); // Mengarahkan ke tampilan show
    }

    public function profile()
    {
        $user = Auth::user(); // Mendapatkan data pengguna yang sedang login
        return view('customer.profile', compact('user')); // Mengarahkan ke view 'profile' dengan data user
    }

    public function editProfile()
    {
        $user = Auth::user(); // Mendapatkan data pengguna yang sedang login
        return view('customer.edit-profile', compact('user')); // Menampilkan halaman edit-profile
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user(); // Mendapatkan data pengguna yang sedang login

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'no_telepon' => 'required|string|min:10|max:15', // Validation for phone number
            'alamat' => 'required|string|max:500', // Validation for address
            // Tambahkan aturan validasi lain yang diperlukan
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(); // Mengarahkan kembali dengan error
        }

        // Memperbarui informasi pengguna
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_telepon = $request->no_telepon;
        $user->alamat = $request->alamat;
        // Lakukan pembaruan lainnya sesuai kebutuhan
        $user->save(); // Simpan perubahan

        return redirect()->route('profile')->with('success', 'Profile updated successfully!'); // Redirect dengan pesan sukses
    }

    // Mencetak dalam format PDF
    public function cetakPdf()
    {
        $users = User::all();
        $pdf = Pdf::loadView('dashboard.pengguna.cetak_pdf', compact('users'));

        return $pdf->stream('laporan-pengguna.pdf');
    }
}
