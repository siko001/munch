<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("order_id");
            $table->string("product_name");
            $table->integer("quantity");
            $table->decimal("price", 8, 2);
            $table->enum("discount_applied", ["yes", "no"])->default("no");
            $table->foreign("order_id")->references("order_number")->on("orders")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('order_details');
    }
};
