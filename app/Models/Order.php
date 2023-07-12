<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'total_including_vat',
        'total_excluding_vat',
        'only_vat',
        'payment',
        "status",
        "delivery_method",
        'date',
        'time',
        'order_notes',
        "time_to_deliver",
        "rated",
        "discount_applied"
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function items() {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }
}
