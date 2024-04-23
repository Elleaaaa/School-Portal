<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    protected $fillable = [
        'studentId',
        'mothersFirstName',
        'mothersLastName',
        'motherAge',
        'motherOccupation',
        'motherContact',
        'motherAddress',

        'fathersFirstName',
        'fathersLastName',
        'fathersSuffix',
        'fatherAge',
        'fatherOccupation',
        'fatherContact',
        'fatherAddress',
    ];
}
