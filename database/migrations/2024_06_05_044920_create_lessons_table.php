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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('teacherId', 255)->nullable();
            $table->string('gradeLevel', 255)->nullable();
            $table->string('subjectId', 255)->nullable();
            $table->string('sectionId', 255)->nullable();
            $table->string('room', 255)->nullable();
            $table->string('day', 255)->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
