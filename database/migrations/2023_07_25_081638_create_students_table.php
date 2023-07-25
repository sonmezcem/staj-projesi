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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('student_number');
            $table->date('internship_start_date');
            $table->date('internship_finish_date');
            $table->unsignedBigInteger('user_name_id');
            $table->foreign('user_name_id')->references('id')->on('users');
            $table->unsignedBigInteger('business_name_id');
            $table->foreign('business_name_id')->references('id')->on('businesses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
