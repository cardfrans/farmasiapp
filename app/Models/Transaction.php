<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Tambahkan izin kolom yang boleh diisi
    protected $fillable = ['user_id', 'total_harga', 'status'];
}