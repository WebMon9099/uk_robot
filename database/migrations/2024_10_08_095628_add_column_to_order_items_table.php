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
        Schema::table('order_items', function (Blueprint $table) {
            $table->enum('status',['pending','shipped','delivered','cancelled'])->default('pending')->after('total');
            $table->timestamp('shipped_date')->nullable()->after('status');
            $table->string('delivery_partner')->nullable()->after('shipped_date');
            $table->string('tracking_number')->nullable()->after('delivery_partner');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            //
        });
    }
};
