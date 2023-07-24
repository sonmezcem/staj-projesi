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
        Schema::create('ogrenciler', function (Blueprint $table) {
            $table->id();
            $table->integer('ogrenci_no');
            $table->date('staj_baslama_tarihi');
            $table->date('staj_bitis_tarihi');
            $table->unsignedBigInteger('kullanici_id');
            $table->foreign('kullanici_id')->references('id')->on('kullanicilar');
            $table->unsignedBigInteger('isletme_id');
            $table->foreign('isletme_id')->references('id')->on('isletmeler');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ogrenciler');
    }
};
