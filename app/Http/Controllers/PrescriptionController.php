<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prescription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Wajib ditambahkan untuk kelola file

class PrescriptionController extends Controller
{
    // 1. Menampilkan halaman riwayat resep user
    public function index()
    {
        $riwayatResep = Prescription::where('user_id', Auth::id())
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        return view('riwayat-resep', compact('riwayatResep'));
    }

    // 2. Memproses form upload resep (KODE ANDA YANG SEBELUMNYA)
    public function store(Request $request)
    {
        $request->validate([
            'resep_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'catatan'    => 'nullable|string|max:500'
        ]);

        if ($request->hasFile('resep_file')) {
            $file = $request->file('resep_file');
            $filename = time() . '_resep_user_' . Auth::id() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/prescriptions', $filename);
            
            Prescription::create([
                'user_id'            => Auth::id(),
                'foto_resep'         => $filename, 
                'status_verifikasi'  => 'Menunggu',
                'catatan_verifikasi' => $request->catatan ? 'Catatan Pasien: ' . $request->catatan : null,
            ]);

            return redirect()->back()->with('success', 'Resep berhasil diunggah! Apoteker kami akan segera memverifikasinya.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah resep.');
    }

    // 3. Menghapus resep
    public function destroy($id)
    {
        // Cari resep berdasarkan ID, tapi pastikan itu milik user yang sedang login
        $resep = Prescription::where('prescription_id', $id)
                             ->where('user_id', Auth::id())
                             ->firstOrFail();

        // Hapus file gambar dari folder storage agar server tidak penuh
        if (Storage::exists('public/prescriptions/' . $resep->foto_resep)) {
            Storage::delete('public/prescriptions/' . $resep->foto_resep);
        }

        // Hapus data dari database (ini otomatis akan menghilangkannya dari Admin)
        $resep->delete();

        return redirect()->back()->with('success', 'Resep berhasil dihapus.');
    }
}