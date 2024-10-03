<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessor extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessorId',
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
