<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deal extends Model {
    protected $fillable = ['name', 'start_date', 'end_date', 'discount', 'coupon_code', "description", "img" ,"type"];

    public function menuItems() {
        return $this->belongsToMany(Product::class);
    }

    public static function activeDeals() {
        $today = Carbon::now()->englishDayOfWeek;

        return self::where('start_date', '=', $today)
            ->where('end_date', '=', $today)
            ->get();
    }
}
