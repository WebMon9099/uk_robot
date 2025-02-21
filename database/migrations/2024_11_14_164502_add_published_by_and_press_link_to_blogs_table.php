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
            $table->string('published_by')->nullable()->after('description');  // Add the Published By field
            $table->string('press_link')->nullable()->after('published_by');   // Add the Press Link field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('published_by');  // Drop the Published By field
            $table->dropColumn('press_link');   // Drop the Press Link field
        });
    }
};
