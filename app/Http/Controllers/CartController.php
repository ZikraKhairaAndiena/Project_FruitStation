<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Promosi;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Menampilkan halaman keranjang
    public function index()
    {
        $this->applyDiscounts(); // Menghitung semua diskon yang berlaku
        $cart = session()->get('cart', []); // Mendapatkan data keranjang dari session
        $subtotal = session()->get('subtotal', 0); // Mengambil subtotal dari session
        $discount = session()->get('discount', 0); // Mengambil total diskon dari session

        // Mengembalikan tampilan keranjang dengan data yang relevan
        return view('customer.cart', compact('cart', 'subtotal', 'discount'));
    }

    // Menambahkan produk ke dalam keranjang
    public function add(Request $request)
    {
        $produkId = $request->input('produk_id'); // Mendapatkan ID produk dari request
        $produk = Produk::find($produkId); // Mencari produk berdasarkan ID

        // Jika produk tidak ditemukan, arahkan kembali dengan pesan error
        if (!$produk) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Memeriksa stok produk sebelum menambahkannya ke keranjang
        if ($produk->stok_produk < 1) {
            return redirect()->back()->with('error', 'Insufficient stock.');
        }

        // Mendapatkan data keranjang dari session
        $cart = session()->get('cart', []);
        // Menentukan jumlah produk yang akan ditambahkan ke keranjang
        $quantity = isset($cart[$produkId]) ? $cart[$produkId]['quantity'] + 1 : 1;

        // Mencari promosi yang berlaku untuk produk ini
        $promotion = Promosi::where('produk_id', $produk->id)
                            ->where('quantity_required', '<=', $quantity)
                            ->where('start_date', '<=', now())
                            ->where('end_date', '>=', now())
                            ->first();

        // Menentukan diskon jika promosi ditemukan
        if ($promotion) {
            $discount = $promotion->discount_percentage; // Diskon berdasarkan promosi
        } else {
            $discount = 0; // Tidak ada diskon jika tidak ada promosi yang berlaku
        }

        // Menambahkan produk ke dalam keranjang
        $cart[$produkId] = [
            'id' => $produk->id,
            'name' => $produk->nama_produk,
            'price' => $produk->harga_produk,
            'quantity' => $quantity,
            'gambar_produk' => $produk->gambar_produk ?? 'default-image.jpg', // Gambar produk, default jika tidak ada
            'discount' => $discount,
        ];

        session()->put('cart', $cart); // Menyimpan kembali keranjang ke session

        // Mengurangi stok produk sebanyak 1
        $produk->stok_produk -= 1;
        $produk->save();

        // Menghitung subtotal dan menerapkan diskon setelah menambah produk
        $this->calculateSubtotal();
        $this->applyDiscounts();

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    // Memperbarui jumlah produk dalam keranjang
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                $produk = Produk::find($request->id); // Mencari produk berdasarkan ID

                // Menghitung perbedaan jumlah produk yang ingin ditambahkan atau dikurangi
                $difference = $request->quantity - $cart[$request->id]['quantity'];

                // Memeriksa apakah stok cukup untuk jumlah yang diminta
                if ($difference > 0 && $produk->stok_produk < $difference) {
                    return response()->json(['error' => 'Insufficient stock'], 400);
                }

                // Memperbarui stok produk
                $produk->stok_produk -= $difference;
                $produk->save();

                // Memperbarui jumlah produk dalam keranjang
                $cart[$request->id]['quantity'] = $request->quantity;
                session()->put('cart', $cart);

                // Menghitung ulang subtotal dan menerapkan diskon
                $this->calculateSubtotal();
                $this->applyDiscounts();

                return response()->json(['success' => 'Cart updated successfully']);
            }
        }
        return response()->json(['error' => 'Unable to update cart'], 400); // Jika update gagal
    }

    // Menghapus produk dari keranjang
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                // Mengembalikan stok produk yang dihapus dari keranjang
                $produk = Produk::find($request->id);
                $produk->stok_produk += $cart[$request->id]['quantity'];
                $produk->save();

                unset($cart[$request->id]); // Menghapus produk dari keranjang
                session()->put('cart', $cart); // Menyimpan kembali keranjang ke session

                // Menghitung ulang subtotal dan menerapkan diskon setelah produk dihapus
                $this->calculateSubtotal();
                $this->applyDiscounts();
            }
            return response()->json(['success' => 'Item removed successfully']);
        }
        return response()->json(['error' => 'Unable to remove item'], 400); // Jika penghapusan gagal
    }

    // Menerapkan diskon yang berlaku berdasarkan promosi
    public function applyDiscounts()
    {
        $cart = session('cart', []); // Mendapatkan keranjang dari session
        $totalDiscount = 0;

        // Mengambil semua promosi yang sedang berlaku
        $promotions = Promosi::where('start_date', '<=', now())
                            ->where('end_date', '>=', now())
                            ->get();

        // Mengecek apakah ada produk dalam keranjang yang memenuhi syarat untuk promosi
        foreach ($promotions as $promotion) {
            foreach ($cart as $item) {
                if ($item['id'] == $promotion->produk_id && $item['quantity'] >= $promotion->quantity_required) {
                    $totalDiscount += ($item['price'] * $item['quantity'] * $promotion->discount_percentage) / 100; // Menghitung diskon
                }
            }
        }

        // Menyimpan diskon total ke session
        session(['discount' => $totalDiscount]);

        // Mengembalikan response dengan diskon dan subtotal setelah diskon
        return response()->json([
            'success' => true,
            'discount' => $totalDiscount,
            'subtotal_after_discount' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)) - $totalDiscount,
        ]);
    }

    // Menghitung subtotal dari semua produk dalam keranjang
    private function calculateSubtotal()
    {
        $cart = session()->get('cart', []); // Mendapatkan data keranjang dari session
        $subtotal = 0;

        // Menjumlahkan harga produk berdasarkan jumlah dalam keranjang
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Menyimpan subtotal yang dihitung ke session
        session()->put('subtotal', $subtotal);
    }
}
