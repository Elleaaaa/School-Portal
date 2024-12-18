<?php

namespace App\Services;

use Carbon\Carbon;

class TimeService
{
    public function generateTimeRange($from, $to)
    {
        $time = Carbon::parse($from);
        $time_display = Carbon::parse($from);
        $timeRange = [];

        do 
        {
            array_push($timeRange, [
                // 24hr format
                'start' => $time->format("H:i"),
                'end' => $time->addMinutes(30)->format("H:i"),

                'start_display' => $time_display->format("H:i"),
                'end_display' => $time_display->addMinutes(30)->format("H:i"),
                // 12hr format
                // 'start' => $time->format("h:i A"),
                // 'end' => $time->addMinutes(30)->format("h:i A")

            ]);    
        } while ($time->format("H:i") !== $to);

        return $timeRange;
    }
}