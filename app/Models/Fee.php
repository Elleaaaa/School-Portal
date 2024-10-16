<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'studentId',
        'firstName',
        'lastName',
        'middleName',
        'suffixName',
        'schoolYear',
        'feeId',
        'feeType',
        'amount',
        'discountedPrice',
        'amountPaid',
        'amountLeft',
        'discount',
        'discountAmount',
        'reciever',
        'status',
    ];
}
