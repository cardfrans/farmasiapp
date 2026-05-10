<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class AdminTransactionController extends Controller
{
    // 1. Menampilkan seluruh pesanan yang masuk
    public function index()
    {
        // Ambil semua transaksi dari semua pembeli, urutkan dari yang terbaru
        $transactions = Transaction::orderBy('created_at', 'desc')->get();
        
        return view('admin.pesanan', compact('transactions'));
    }

    // 2. Memperbarui status pesanan (Lunas -> Diproses -> Selesai)
    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        
        if ($transaction) {
            $transaction->update([
                'status' => $request->status
            ]);
        }

        return redirect()->back(); // Kembali ke halaman yang sama
    }
}