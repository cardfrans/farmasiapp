<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $primaryKey = 'medicine_id';
    protected $guarded = [];
//ini untuk fitur tambah dan edit obat
    protected $fillable = [
        'nama_obat', 
        'kategori', 
        'deskripsi', 
        'harga', 
        'stok', 
        'satuan', 
        'gambar'
    ];
    public function orderItems() {
        return $this->hasMany(OrderItem::class, 'medicine_id', 'medicine_id');
    }
}