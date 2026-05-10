<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine; // Panggil model Medicine

class AdminMedicineController extends Controller
{
    // Fungsi untuk menampilkan daftar obat di halaman admin
    public function index()
    {
        // Ambil semua data obat dari database
        $medicines = Medicine::all();
        
        // Tampilkan ke file view 'admin/obat.blade.php'
        return view('admin.obat', compact('medicines'));
    }

    // Menampilkan halaman form edit
    public function edit($id)
    {
        // Cari obat berdasarkan medicine_id
        $obat = Medicine::where('medicine_id', $id)->first();
        
        if (!$obat) {
            return redirect('/admin/obat');
        }

        return view('admin.edit-obat', compact('obat'));
    }

    // Memproses perubahan data ke database
    public function update(Request $request, $id)
    {
        $obat = Medicine::where('medicine_id', $id)->first();

        if ($obat) {
            $data = [
                'nama_obat' => $request->nama_obat,
                'kategori'  => $request->kategori,
                'harga'     => $request->harga,
                'stok'      => $request->stok,
            ];

            // Cek apakah ada file gambar yang diupload
            if ($request->hasFile('gambar')) {
                // Simpan gambar ke folder 'public/obat_images'
                $path = $request->file('gambar')->store('obat_images', 'public');
                $data['gambar'] = $path; // Masukkan path ke database
            }

            $obat->update($data);
        }

        return redirect('/admin/obat');
    }

    // Menghapus obat dari database
    public function destroy($id)
    {
        // Cari obat berdasarkan medicine_id
        $obat = Medicine::where('medicine_id', $id)->first();
        
        // Jika obat ditemukan, hapus datanya
        if ($obat) {
            $obat->delete();
        }

        // Kembalikan ke halaman daftar obat admin
        return redirect('/admin/obat');
    }
}