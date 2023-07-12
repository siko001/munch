<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetails extends Model {
    use HasFactory;
    protected $fillable = [
        "order_id",
        "product_name",
        "quanitity",
        "price",
        "discount_applied"
    ];

    public function order() {
        return $this->belongsTo(Order::class, "order_number");
    }
}
