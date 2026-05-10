<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil 8 obat terbaru untuk katalog umum
        $medicines = Medicine::latest()->take(8)->get();

        // 2. Ambil 4 obat terlaris (Berdasarkan jumlah kemunculan di order_items)
        // Jika relasi belum siap, Anda bisa menggantinya sementara dengan Medicine::inRandomOrder()->take(4)->get()
        $bestSellers = Medicine::withCount('orderItems')
                        ->orderBy('order_items_count', 'desc')
                        ->take(4)
                        ->get();
        
        return view('welcome', compact('medicines', 'bestSellers'));
    }
}