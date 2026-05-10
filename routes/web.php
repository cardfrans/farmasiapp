<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShippingController;
use App\Models\Transaction;
use App\Models\Medicine;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Landing Page Route
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route untuk memproses upload resep dari Modal
    Route::post('/upload-resep', [App\Http\Controllers\PrescriptionController::class, 'store'])->name('resep.store');
    // Rute Kelola Resep User
    Route::get('/riwayat-resep', [App\Http\Controllers\PrescriptionController::class, 'index'])->name('resep.index');
    Route::delete('/hapus-resep/{id}', [App\Http\Controllers\PrescriptionController::class, 'destroy'])->name('resep.destroy');

    });

require __DIR__.'/auth.php';

Route::get('/upload-resep', function () {
    return view('upload-resep');
});

// Route::get('/keranjang', function () {
//     return view('keranjang');
// });

Route::get('/katalog', [MedicineController::class, 'indexKatalog']);
Route::get('/admin/obat', [MedicineController::class, 'indexAdmin']);
Route::get('/admin/obat/tambah', [MedicineController::class, 'create']);
Route::post('/admin/obat', [MedicineController::class, 'store']);
Route::middleware('auth')->group(function () {
Route::get('/keranjang', [CartController::class, 'index']);
Route::post('/keranjang/tambah', [CartController::class, 'store']); // Sesuaikan jika nama fungsinya beda
Route::delete('/keranjang/hapus/{id}', [CartController::class, 'destroy']);
Route::post('/checkout', [CartController::class, 'checkout']);
Route::get('/pesanan', [App\Http\Controllers\TransactionController::class, 'index']);

// Rute Khusus Admin (Dilindungi)
Route::middleware(['auth', IsAdmin::class])->group(function () {
    // Manajemen Resep untuk Admin
    Route::get('/admin/resep', [App\Http\Controllers\AdminPrescriptionController::class, 'index'])->name('admin.resep.index');
    Route::put('/admin/resep/{id}', [App\Http\Controllers\AdminPrescriptionController::class, 'update'])->name('admin.resep.update');

    // Dashboard Admin Dinamis
    Route::get('/admin/dashboard', function () {
        // 1. Total Pendapatan (Status Lunas, Diproses, Selesai)
        $totalPendapatan = Transaction::whereIn('status', ['Lunas', 'Diproses', 'Selesai'])->sum('total_harga');
        
        // 2. Pesanan Menunggu (Status Lunas yang baru masuk atau sedang diproses)
        $pesananBaru = Transaction::whereIn('status', ['Lunas', 'Diproses'])->count();
        
        // 3. Total Jenis Obat di Katalog
        $totalObat = Medicine::count();
        
        // 4. Obat dengan stok menipis (di bawah 10)
        $stokMenipisCount = Medicine::where('stok', '<', 10)->count();
        $stokMenipis = Medicine::where('stok', '<', 10)->take(5)->get();
        
        // 5. Ambil 5 Pesanan Masuk Terakhir
        $pesananTerbaru = Transaction::latest()->take(5)->get();

        return view('admin/dashboard', compact(
            'totalPendapatan', 'pesananBaru', 'totalObat', 
            'stokMenipisCount', 'stokMenipis', 'pesananTerbaru'
        ));
        
    })->name('dashboard');

    Route::get('/admin/obat', [App\Http\Controllers\AdminMedicineController::class, 'index']);
    Route::get('/admin/obat/edit/{id}', [App\Http\Controllers\AdminMedicineController::class, 'edit']);
    Route::put('/admin/obat/{id}', [App\Http\Controllers\AdminMedicineController::class, 'update']);
    Route::delete('/admin/obat/{id}', [App\Http\Controllers\AdminMedicineController::class, 'destroy']);
    // Kelola Pesanan
    Route::get('/admin/pesanan', [App\Http\Controllers\AdminTransactionController::class, 'index']);
    Route::put('/admin/pesanan/{id}', [App\Http\Controllers\AdminTransactionController::class, 'update']);

    // Manajemen Resep untuk Admin
    Route::get('/admin/resep', [App\Http\Controllers\AdminPrescriptionController::class, 'index'])->name('admin.resep.index');
    Route::put('/admin/resep/{id}', [App\Http\Controllers\AdminPrescriptionController::class, 'update'])->name('admin.resep.update');

    
    
    });
// Halaman untuk menampilkan form
Route::get('/cek-ongkir', [ShippingController::class, 'index']);

// Proses form saat tombol di-klik
Route::post('/cek-ongkir', [ShippingController::class, 'check']);
Route::get('/api/search-area', [App\Http\Controllers\ShippingController::class, 'search']);
});

