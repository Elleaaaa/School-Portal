<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastSchool extends Model
{
    use HasFactory;

    protected $table = 'lastschools';

    protected $fillable = [
        'studentId',
        'school',
        'genAverage',
    ];
}
