<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        // Ambil semua transaksi milik user yang sedang login, urutkan dari yang paling baru
        $transactions = Transaction::where('user_id', Auth::id())
                                   ->orderBy('created_at', 'desc')
                                   ->get();

        // Tampilkan ke halaman riwayat pesanan
        return view('pesanan', compact('transactions'));
    }
}