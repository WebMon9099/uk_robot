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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('user_category_id')->nullable()->constrained('user_categories')->onDelete('set null')->after('password');
            $table->string('phone')->nullable()->after('user_category_id');
            $table->string('company_name')->after('phone');
            $table->string('user_type')->default('2')->comment('1=Admin,2=User');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['user_category_id']);
            $table->dropColumn(['user_category_id', 'phone', 'company_name', 'user_type']);
        });
    }
};
