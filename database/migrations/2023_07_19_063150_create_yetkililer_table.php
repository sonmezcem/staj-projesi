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
        Schema::create('yetkililer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uye_id');
            $table->foreign('uye_id')->references('id')->on('kullanicilar');
            $table->unsignedBigInteger('gorev');
            $table->foreign('gorev')->references('id')->on('gorevler');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yetkililer');
    }
};
