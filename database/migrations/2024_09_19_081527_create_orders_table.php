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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('orderNumber')->unique();
            $table->double('sub_total',10,2);
            $table->double('shipping',10,2);
            $table->string('coupon_code')->nullable();
            $table->string('coupon_code_id')->nullable();
            $table->double('discount',10,2);
            $table->double('grand_total',10,2);
            $table->string('payment_id'); 
            $table->string('payment_method'); 
            $table->enum('payment_status',['paid','not paid'])->default('not paid');
            $table->enum('status',['pending','shipped','deliverd'])->default('pending');
            $table->timestamps();

           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
