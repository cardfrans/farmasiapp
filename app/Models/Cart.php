<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class Cart extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi
    protected $fillable = ['user_id', 'medicine_id', 'jumlah'];

    // Relasi: Keranjang ini milik 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Keranjang ini berisi 1 Obat
   public function medicine()
    {
        // Parameter ke-2: nama foreign key di tabel carts (yaitu 'medicine_id')
        // Parameter ke-3: nama primary key di tabel medicines (juga 'medicine_id')
        return $this->belongsTo(Medicine::class, 'medicine_id', 'medicine_id');
    }
}