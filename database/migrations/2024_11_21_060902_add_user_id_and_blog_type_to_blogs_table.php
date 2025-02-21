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
        Schema::table('blogs', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('user_id')->nullable()->after('press_link'); // Add user_id column
            $table->string('blog_type')->after('user_id'); // Add blog_type column

            // If user_id is a foreign key referencing users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            //
            $table->dropForeign(['user_id']); // Drop foreign key
            $table->dropColumn(['user_id', 'blog_type']); // Drop columns
        });
    }
};
