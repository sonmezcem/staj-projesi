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
        Schema::create('evraklar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ogrenci_id');
            $table->foreign('ogrenci_id')->references('id')->on('ogrenciler');
            $table->unsignedBigInteger('evrak_turu');
            $table->foreign('evrak_turu')->references('id')->on('evrak_turleri');
            $table->tinyText('dosya_yolu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evraklar');
    }
};
