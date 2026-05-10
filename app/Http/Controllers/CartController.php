<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth; // Untuk mengambil data user yang login
use App\Models\Transaction;
use App\Models\TransactionDetail;


class CartController extends Controller
{
    public function store(Request $request)
    {
        // Pastikan ada ID obat yang dikirim
        $request->validate([
            'medicine_id' => 'required'
        ]);

        // 1. Cek dulu data obatnya
        $medicine = \App\Models\Medicine::find($request->medicine_id);

        // 2. Jika stoknya 0 atau kurang, langsung tolak dan kembalikan ke halaman sebelumnya
        if ($medicine->stok <= 0) {
            return redirect()->back(); // Nanti kita bisa tambahkan pesan error/notifikasi di sini
        }

        // ... Lanjutkan ke kode simpan keranjang Anda yang sudah ada di bawah ini ...
        // $userId = Auth::id();
        // $cart = Cart::where(...) dll

        $userId = Auth::id(); // Ambil ID user yang sedang login saat ini

        // Cek apakah obat ini sudah ada di keranjang user tersebut
        $keranjangAda = Cart::where('user_id', $userId)
                            ->where('medicine_id', $request->medicine_id)
                            ->first();

        if ($keranjangAda) {
            // Jika sudah ada, cukup tambahkan jumlahnya (+1)
            $keranjangAda->jumlah += 1;
            $keranjangAda->save();
        } else {
            // Jika belum ada, buat data baru di keranjang
            Cart::create([
                'user_id' => $userId = Auth::id(),
                'medicine_id' => $request->medicine_id,
                'jumlah' => 1
            ]);
        }

        // Kembalikan user ke halaman katalog (tetap di halaman yang sama)
        return redirect()->back();
    }

    public function index()
    {
        // Ambil data keranjang milik user yang sedang login beserta relasi obatnya
        $carts = Cart::with('medicine')->where('user_id', Auth::id())->get();
        
        // Hitung total harga semua barang di keranjang
        $totalHarga = 0;
        foreach ($carts as $cart) {
            // Pastikan relasi medicine tidak null/kosong
            if ($cart->medicine) {
                $totalHarga += ($cart->medicine->harga * $cart->jumlah);
            }
        }

        // Kirim data ke tampilan
        return view('keranjang', compact('carts', 'totalHarga'));
    }

    public function destroy($id)
    {
        // Cari data keranjang berdasarkan ID-nya
        $cart = Cart::find($id);
        
        // Jika datanya ada, hapus dari database
        if ($cart) {
            $cart->delete();
        }

        // Kembalikan ke halaman keranjang
        return redirect()->back();
    }

    public function checkout()
    {
        // Masih pakai User ID 1 karena kita membypass login sebelumnya
        $userId = Auth::id();
        
        // Ambil semua isi keranjang user ini
        $carts = Cart::with('medicine')->where('user_id', $userId)->get();

        // Kalau keranjang kosong, kembalikan saja
        if ($carts->count() == 0) {
            return redirect()->back();
        }
        

        // Hitung total harga
        $totalHarga = 0;
        foreach ($carts as $cart) {
            if ($cart->medicine) {
                $totalHarga += ($cart->medicine->harga * $cart->jumlah);
            }
        }

        

        // 1. Simpan ke tabel transactions
        $transaction = Transaction::create([
            'user_id' => $userId,
            'total_harga' => $totalHarga,
            'status' => 'Lunas' // Anggap saja pembayarannya langsung lunas
        ]);

        // 2. Simpan rincian obatnya ke tabel transaction_details
        foreach ($carts as $cart) {
            if ($cart->medicine) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'medicine_id' => $cart->medicine_id, // Menggunakan medicine_id
                    'jumlah' => $cart->jumlah,
                    'harga_satuan' => $cart->medicine->harga
                ]);

                $cart->medicine->stok -= $cart->jumlah; // Kurangi stok dengan jumlah yang dibeli
                $cart->medicine->save();// Simpan sisa stok terbaru ke database
            }
        }

        // 3. Kosongkan keranjang pembeli setelah berhasil checkout
        Cart::where('user_id', $userId)->delete();

        // 4. Arahkan pembeli kembali ke halaman katalog
        return redirect('/katalog');
    }

    
}