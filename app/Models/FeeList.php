<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeList extends Model
{
    use HasFactory;

    protected $table = 'feelists'; //use this to specify what table your inserting or updating

    protected $fillable = [
        'feeName',
        'amount',
        'status',
    ];
}
