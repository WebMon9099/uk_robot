<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('press_release_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('press_release_id')->constrained()->onDelete('cascade');
            $table->string('file_path');
            $table->string('file_type'); // 'image' or 'pdf'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('press_release_files');
    }
};
