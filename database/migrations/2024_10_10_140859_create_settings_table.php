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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('live_client_id')->nullable();
            $table->string('live_client_secret')->nullable();
        
            // Fields for sandbox credentials
            $table->string('sandbox_client_id')->nullable();
            $table->string('sandbox_client_secret')->nullable();
        
            $table->enum('mode', ['live', 'sandbox'])->default('sandbox');
  
            $table->enum('payment_type', ['paypal']);
            $table->integer('status')->nullable();


            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
