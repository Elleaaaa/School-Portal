<?php

namespace App\Services;

use App\Models\Lesson;
use App\Services\TimeService;


class CalendarService
{
    public function generateCalendarData($weekDays)
    {
        $calendarData = [];
        $timeRange = (new TimeService)->generateTimeRange(config('app.calendar.start_time'), config('app.calendar.end_time'));
        $lessons   = Lesson::all();

        foreach ($timeRange as $time)
        {
            $timeText = $time['start'] . ' - ' . $time['end'];
            $calendarData[$timeText] = [];

            foreach ($weekDays as $index => $day)
            {
                $lesson = $lessons->where('day', $index)->where('start_time', $time['start'])->first();

                if ($lesson)
                {
                    $start_time = strtotime($lesson->start_time); // Convert start time to Unix timestamp
                    $end_time = strtotime($lesson->end_time); // Convert end time to Unix timestamp
                    $duration_minutes = ($end_time - $start_time) / 60; // Calculate duration in minutes

                    array_push($calendarData[$timeText], [
                        'class_name'   => $lesson->subjectId,
                        'teacher_name' => $lesson->teacher->firstName." ". $lesson->teacher->lastName,
                        'rowspan'      => $duration_minutes / 30,
                        'room'   => $lesson->room,
                    ]);
                }
                else if (!$lessons->where('day', $index)->where('start_time', '<', $time['start'])->where('end_time', '>=', $time['end'])->count())
                {
                    array_push($calendarData[$timeText], 1);
                }
                else
                {
                    array_push($calendarData[$timeText], 0);
                }
            }
        }
        // dd($calendarData);

        return $calendarData;
    }

    // USED FOR FILTERING SCHEDULE BASED ON THE SECTION OF THE STUDENT
    public function generateCalendarDataFiltered($weekDays, $lessons)
    {
        $calendarData = [];
        $timeRange = (new TimeService)->generateTimeRange(config('app.calendar.start_time'), config('app.calendar.end_time'));

        foreach ($timeRange as $time) {
            $timeText = $time['start'] . ' - ' . $time['end'];
            $calendarData[$timeText] = [];

            foreach ($weekDays as $index => $day) {
                $lesson = $lessons->where('day', $index)->where('start_time', $time['start'])->first();

                if ($lesson) {
                    $start_time = strtotime($lesson->start_time); // Convert start time to Unix timestamp
                    $end_time = strtotime($lesson->end_time); // Convert end time to Unix timestamp
                    $duration_minutes = ($end_time - $start_time) / 60; // Calculate duration in minutes

                    array_push($calendarData[$timeText], [
                        'class_name'   => $lesson->subjectId,
                        'teacher_name' => $lesson->teacher->firstName." ". $lesson->teacher->lastName,
                        'rowspan'      => $duration_minutes / 30,
                        'room'         => $lesson->room,
                    ]);
                } else if (!$lessons->where('day', $index)->where('start_time', '<', $time['start'])->where('end_time', '>=', $time['end'])->count()) {
                    array_push($calendarData[$timeText], 1);
                } else {
                    array_push($calendarData[$timeText], 0);
                }
            }
        }

        return $calendarData;
    }

     // USED FOR FILTERING SCHEDULE OF TEACHERS
     public function generateCalendarDataFilteredTeacher($weekDays, $lessons)
     {
         $calendarData = [];
         $timeRange = (new TimeService)->generateTimeRange(config('app.calendar.start_time'), config('app.calendar.end_time'));
 
         foreach ($timeRange as $time) {
             $timeText = $time['start'] . ' - ' . $time['end'];
             $calendarData[$timeText] = [];
 
             foreach ($weekDays as $index => $day) {
                 $lesson = $lessons->where('day', $index)->where('start_time', $time['start'])->first();
 
                 if ($lesson) {
                     $start_time = strtotime($lesson->start_time); // Convert start time to Unix timestamp
                     $end_time = strtotime($lesson->end_time); // Convert end time to Unix timestamp
                     $duration_minutes = ($end_time - $start_time) / 60; // Calculate duration in minutes
 
                     array_push($calendarData[$timeText], [
                         'class_name'   => $lesson->subjectId,
                         'teacher_name' => $lesson->teacher->firstName." ". $lesson->teacher->lastName,
                         'rowspan'      => $duration_minutes / 30,
                         'room'         => $lesson->room,
                     ]);
                 } else if (!$lessons->where('day', $index)->where('start_time', '<', $time['start'])->where('end_time', '>=', $time['end'])->count()) {
                     array_push($calendarData[$timeText], 1);
                 } else {
                     array_push($calendarData[$timeText], 0);
                 }
             }
         }
 
         return $calendarData;
     }

}

