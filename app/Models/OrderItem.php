<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $primaryKey = 'order_item_id';
    protected $guarded = [];

    public function order() {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function medicine() {
        return $this->belongsTo(Medicine::class, 'medicine_id', 'medicine_id');
    }
}