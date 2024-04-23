<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    // protected $primaryKey = 'teacherId';

    protected $fillable = [
        'teacherId',
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
        'displayPhoto',
        'placeOfBirth',
    ];

}
