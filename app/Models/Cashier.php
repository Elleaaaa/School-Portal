<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    use HasFactory;

    protected $fillable = [
        'cashierId',
        'firstName',
        'lastName',
        'middleName',
        'suffix',
        'birthday',
        'age',
        'religion',
        'landlineNumber',
        'mobileNumber',
        'gender',
        'placeOfBirth',
    ];
}
