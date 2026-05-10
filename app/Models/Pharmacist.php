<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pharmacist extends Model
{
    protected $primaryKey = 'pharmacist_id';
    protected $guarded = [];

    public function consultations() {
        return $this->hasMany(Consultation::class, 'pharmacist_id', 'pharmacist_id');
    }
}