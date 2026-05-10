<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $primaryKey = 'prescription_id';
    
    // BARIS INI SANGAT PENTING. Jangan sampai terhapus atau typo.
    protected $guarded = []; 

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}