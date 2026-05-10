<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $primaryKey = 'consultation_id';
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function pharmacist() {
        return $this->belongsTo(Pharmacist::class, 'pharmacist_id', 'pharmacist_id');
    }
}