<?php

namespace App\Http\Controllers;

use App\Models\StoreReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreReviewController extends Controller
{
    // Menampilkan form ulasan
    public function create()
    {
        return view('customer.contact');
    }

    // Menyimpan ulasan ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|max:1000',
        ]);

        // Menyimpan ulasan ke database
        StoreReview::create([
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'message' => $request->message,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('contact')->with('success', 'Terima kasih sudah memberikan ulasan ke toko kami');
    }


    public function getTestimonials()
    {
        // Ambil 5 ulasan terbaru
        $testimonials = StoreReview::latest()->take(5)->get();

        // Kirimkan data ke view
        return view('customer.home', compact('testimonials'));
    }
}

