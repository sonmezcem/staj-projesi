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
            $table->string('kullanici_adi',100);
            $table->string('parola',100);
            $table->string('ad', 100);
            $table->string('soyad', 100);
            $table->string('telefon_numarasi', 10)->unique();
            $table->string('eposta',100)->unique();
            $table->string('profil_resmi', 100)->nullable();
            $table->unsignedBigInteger('kullanici_tipi');
            $table->foreign('kullanici_tipi')->references('id')->on('kullanici_tipi');
            $table->boolean('durum');
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
