<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    
    // protected $primaryKey = 'studentId';
    
    protected $fillable = [
        'studentId',
        'gradeLevel',
        'subjectCode',
        'subjectTitle',
        'subjectTeacher',
        'subjectType',
        'subjectUnit',
        'subjectLectUnit',
        'subjectLabUnit',
    ];
}
