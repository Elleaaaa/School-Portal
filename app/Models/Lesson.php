<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacherId',
        'subjectId',
        'sectionId',
        'room',
        'day',
        'start_time',
        'end_time',
    ];

    const DAYS = [
        'Monday' => 'Monday',
        'Tuesday' => 'Tuesday',
        'Wednesday' => 'Wednesday',
        'Thursday' => 'Thursday',
        'Friday' => 'Friday',
        'Saturday' => 'Saturday',
        'Sunday' => 'Sunday',
    ];

    //format of time
    public function getDifferenceAttribute()
    {
        return Carbon::parse($this->end_time)->diffInMinutes($this->start_time);
    }

    public function getStartTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value)->format(config('panel.lesson_time_format')) : null;
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = $value ? Carbon::createFromFormat(config('panel.lesson_time_format'),
            $value)->format('H:i:s') : null;
    }

    public function getEndTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value)->format(config('panel.lesson_time_format')) : null;
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = $value ? Carbon::createFromFormat(config('panel.lesson_time_format'),
            $value)->format('H:i:s') : null;
    }
    //format of time

    //relationship
    function class()
    {
        return $this->belongsTo(Lesson::class, 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacherId', 'teacherId');
    }
    //relationship
    
}
