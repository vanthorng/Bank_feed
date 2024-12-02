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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('original_name'); // Original file name
            $table->string('s3_path'); // Path to file in S3
            $table->string('url'); // Public URL of the file
            $table->string('ct_02')->nullable(); // Public URL of the file
            $table->string('ct_03')->nullable(); // Public URL of the file
            $table->string('ct_04')->nullable(); // Public URL of the file
            $table->string('ct_05')->nullable(); // Public URL of the file
            $table->string('ct_06')->nullable(); // Public URL of the file
            $table->string('ct_07')->nullable(); // Public URL of the file
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
