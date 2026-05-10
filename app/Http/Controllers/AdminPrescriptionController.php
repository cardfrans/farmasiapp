<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prescription;
use Illuminate\Support\Facades\Auth;

class AdminPrescriptionController extends Controller
{
    // Menampilkan semua resep yang masuk
    public function index()
    {
        // Mengambil data resep beserta informasi user terkait
        $prescriptions = Prescription::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.resep', compact('prescriptions'));
    }

    // Memperbarui status verifikasi resep
    public function update(Request $request, $id)
    {
        $prescription = Prescription::findOrFail($id);
        
        $prescription->update([
            'status_verifikasi' => $request->status_verifikasi,
            'catatan_verifikasi' => $request->catatan_verifikasi,
            'verified_by' => Auth::id(), // ID admin yang memverifikasi
        ]);

        return redirect()->back()->with('success', 'Status resep berhasil diperbarui.');
    }
}