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
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->string('studentId', 255)->nullable();
            $table->string('mothersFirstName', 255)->nullable();
            $table->string('mothersLastName', 255)->nullable();
            $table->string('motherAge', 255)->nullable();
            $table->string('motherOccupation', 255)->nullable();
            $table->string('motherContact', 255)->nullable();
            $table->string('motherAddress', 255)->nullable();
            $table->string('fathersFirstName', 255)->nullable();
            $table->string('fathersLastName', 255)->nullable();
            $table->string('fathersSuffix', 255)->nullable();
            $table->string('fatherAge', 255)->nullable();
            $table->string('fatherOccupation', 255)->nullable();
            $table->string('fatherContact', 255)->nullable();
            $table->string('fatherAddress', 255)->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};
