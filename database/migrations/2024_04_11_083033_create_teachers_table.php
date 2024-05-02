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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('teacherId', 255)->nullable();
            $table->string('firstName', 255)->nullable();
            $table->string('lastName', 255)->nullable();
            $table->string('middleName', 255)->nullable();
            $table->string('suffix', 255)->nullable();
            $table->date('birthday')->nullable();
            $table->string('age', 255)->nullable();
            $table->string('religion', 255)->nullable();
            $table->string('landlineNumber', 255)->nullable();
            $table->string('mobileNumber', 255)->nullable();
            $table->string('gender', 255)->nullable();
            $table->string('placeOfBirth', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
