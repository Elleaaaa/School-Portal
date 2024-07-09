<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'eventName',
        'status',
        'category',
        'start_time',
        'end_time',
        'start_date',
        'end_date',
    ];
}
