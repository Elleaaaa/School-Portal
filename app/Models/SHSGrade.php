<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SHSGrade extends Model
{
    use HasFactory;

    protected $table = 'grades_shs';

    protected $fillable = [
        'studentId',
        'gradeLevel',
        'section',
        'subject',
        'midterm',
        'finals',
        'semester',
        'schoolYear',
    ];
}
