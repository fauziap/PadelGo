<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number');
            $table->date('booking_date');
            $table->enum('payment_status', [
                'pending',
                'success',
                'challenge',
                'failed'
            ])->default('pending');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('court_id');
            $table->string('snap_token')->nullable();
            $table->string('order_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('court_id')->references('id')->on('courts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
