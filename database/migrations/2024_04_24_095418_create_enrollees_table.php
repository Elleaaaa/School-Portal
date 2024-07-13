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
        Schema::create('enrollees', function (Blueprint $table) {
            $table->id();
            $table->string('studentId', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('subjects', 255)->nullable();
            $table->string('gradeLevel', 255)->nullable();
            $table->string('section', 255)->nullable();
            $table->string('semester', 255)->nullable();
            $table->string('classType', 255)->nullable();
            $table->string('schoolYear', 255)->nullable();
            $table->string('status', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollees');
    }
};
