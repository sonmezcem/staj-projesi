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
        Schema::create('kullanicilar', function (Blueprint $table) {
            $table->id();
            $table->tinyText('ad');
            $table->tinyText('soyad');
            $table->string('telefon_numarasi', 10);
            $table->tinyText('eposta')->unique();
            $table->tinyText('parola');
            $table->string('kullanici_tipi', 10);
            $table->tinyText('profil_resmi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kullanicilar');
    }
};
