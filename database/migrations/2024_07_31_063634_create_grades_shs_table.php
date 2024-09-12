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
        Schema::create('grades_shs', function (Blueprint $table) {
            $table->id();
            $table->string('studentId', 255)->nullable();
            $table->string('gradeLevel', 255)->nullable();
            $table->string('section', 255)->nullable();
            $table->string('subject', 255)->nullable();
            $table->string('midterm', 255)->nullable();
            $table->string('finals', 255)->nullable();
            $table->string('semester', 255)->nullable();
            $table->string('schoolYear', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades_shs');
    }
};
