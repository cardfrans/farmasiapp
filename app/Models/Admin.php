<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = 'admin_id';
    protected $guarded = [];

    public function verifiedPrescriptions() {
        return $this->hasMany(Prescription::class, 'verified_by', 'admin_id');
    }
}