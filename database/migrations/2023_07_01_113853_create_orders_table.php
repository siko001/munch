<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("order_number")->unique();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->decimal("total_including_vat", 8, 2);
            $table->decimal("total_excluding_vat", 8, 2);
            $table->decimal("only_vat", 8, 2);
            $table->enum("payment", ["Cash on Delivery", "Paid"]);
            $table->string("status")->default("Order Accepted");
            $table->string("delivery_method");
            $table->string("date");
            $table->string("time");
            $table->string("order_notes")->nullable();
            $table->string("time_to_deliver");
            $table->enum('rated', ['true', 'false'])->default('false');
            $table->enum('discount_applied', ['true', 'false'])->default('false');
            $table->timestamps();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('orders');
    }
};
