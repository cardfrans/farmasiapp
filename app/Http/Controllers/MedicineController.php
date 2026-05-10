<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine; 

class MedicineController extends Controller
{
    // Fungsi untuk halaman Katalog (User)
    public function indexKatalog(Request $request)
    {
        // Memulai query ke model Medicine
        $query = Medicine::query();

        // Logika untuk fitur pencarian (search)
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_obat', 'like', '%' . $request->search . '%')
                  ->orWhere('kategori', 'like', '%' . $request->search . '%');
        }

        // Ambil data obat menggunakan pagination (12 obat per halaman)
        // Ini lebih baik dari all() agar website tidak lambat
        $medicines = $query->paginate(12); 

        return view('katalog', compact('medicines')); 
    }

    // Fungsi untuk halaman Dashboard Admin (Obat)
    public function indexAdmin()
    {
        $medicines = Medicine::all(); 
        return view('admin.obat', compact('medicines')); 
    }

    // Fungsi untuk menampilkan form tambah obat
    public function create()
    {
        return view('admin.obat-create');
    }

    // Fungsi untuk memproses dan menyimpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required',
            'kategori'  => 'required',
            'deskripsi' => 'required',
            'harga'     => 'required|numeric',
            'stok'      => 'required|numeric',
            'satuan'    => 'required',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $data = [
            'nama_obat' => $request->nama_obat,
            'kategori'  => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'harga'     => $request->harga,
            'stok'      => $request->stok,
            'satuan'    => $request->satuan,
        ];

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('obat_images', 'public');
            $data['gambar'] = $path; 
        }

        Medicine::create($data);
        
        return redirect('/admin/obat');
    }
}