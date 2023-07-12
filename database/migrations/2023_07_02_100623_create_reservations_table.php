<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name");
            $table->string("time");
            $table->string("email")->nullable();
            $table->string("phone");
            $table->string("date");
            $table->integer("people");
            $table->string('seating_area')->default('random')->nullable();
            $table->string("requests")->nullable();
            $table->enum("status", ["Confirmed", "Cancelled by Restaurant", "Cancelled by Guest", "Awaiting Confirmation", "Completed", "No Show"])->default("Awaiting Confirmation")->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('reservations');
    }
};
