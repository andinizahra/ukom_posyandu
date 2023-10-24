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
        Schema::create('catatan_imunisasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_catatan_vaksin');
            $table->unsignedBigInteger('id_user');
            $table->string('catatan_imunisasi');
            $table->dateTime('tanggal_imunisasi')->default('2023-01-01 00:00:00');
            $table->text('ringkasan');
            $table->text('file');

            $table->foreign('id_catatan_vaksin')->references('id_catatan_vaksin')->on('catatan_vaksin');
            $table->foreign('id_user')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_imunisasi');
    }
};
