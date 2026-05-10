<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $primaryKey = 'shipment_id';
    protected $guarded = [];

    public function order() {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}