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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('studentId', 255)->nullable();
            $table->string('firstName', 255)->nullable();
            $table->string('middleName', 255)->nullable();
            $table->string('lastName', 255)->nullable();
            $table->string('suffixName', 255)->nullable();
            $table->string('feeId', 255)->nullable();
            $table->string('feeReceiptId', 255)->nullable();
            $table->string('feeType', 255)->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('discountedPrice', 10, 2)->nullable();
            $table->decimal('amountPaid', 10, 2)->nullable();
            $table->decimal('amountLeft', 10, 2)->nullable();
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('discountAmount', 10, 2)->nullable();
            $table->string('reciever', 255)->nullable();
            $table->string('status', 255)->default('Not Paid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
