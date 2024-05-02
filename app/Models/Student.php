<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // protected $primaryKey = 'id';
    
    protected $fillable = [
        'studentId',
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
