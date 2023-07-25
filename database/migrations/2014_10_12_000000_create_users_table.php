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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('surname', 100);
            $table->string('phone',10);
            $table->string('email')->unique();
            $table->string('profile_picture', 100);
            $table->string('username', 100);
            $table->string('password', 100);
            $table->unsignedBigInteger('user_type');
            $table->foreign('user_type')->references('id')->on('user_types');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
