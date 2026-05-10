<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    // Tambahkan izin kolom yang boleh diisi
    protected $fillable = ['transaction_id', 'medicine_id', 'jumlah', 'harga_satuan'];
}