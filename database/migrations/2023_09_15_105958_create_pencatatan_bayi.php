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
        Schema::create('pencatatan_bayi', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable(false);
            $table->string('berat_badan')->nullable(false);
            $table->string('tinggi_badan')->nullable(false);
            $table->enum('golongan_darah', array(['A -/+','B -/+','O -/+', 'AB -/+']))->nullable(false);
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencatatan_bayi');
    }
};
