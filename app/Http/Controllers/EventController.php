<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create a new event instance
        $event = new Event();
        $event->eventName = $request->input('eventName');
        $event->status = 'active';
        $event->start_datetime = $request->input('start_datetime');
        $event->end_datetime = $request->input('end_datetime');
        $event->category = $request->input('category');
        // dd($request->all());

        // Save the event to the database
        $event->save();
        // Redirect or return a response
        notify()->success('Event created successfully!');
        return redirect()->back();

    }

    // public function getEvents()
    // {
    //     try {
    //         $events = Event::all()->map(function ($event) {
    
    //             Ensure start and end datetime are formatted correctly
    //             $start_datetime = Carbon::parse($event->start_datetime)->format('Y-m-d\TH:i:s');
    //             $end_datetime = Carbon::parse($event->end_datetime)->format('Y-m-d\TH:i:s');

    //             return [
    //                 'id' => $event->id,
    //                 'title' => $event->eventName,
    //                 'start' => $start_datetime,
    //                 'end' => $end_datetime,
    //                 'category' => $event->category,
    //                 'allDay' => false,
    //             ];
    //         });
    
    //         return response()->json(['data' => $events]);
    //     } catch (\Exception $e) {
    //         Log::error('Error fetching events: ' . $e->getMessage());
    //         return response()->json(['error' => 'Error fetching events'], 500);
    //     }
    // }

    public function getEvents()
    {
        try {
            // Check user type (assuming you have access to the authenticated user)
            $userType = auth()->user()->usertype;
    
            // If the user is a student, filter events by category 'general'
            $eventsQuery = Event::query();
            if ($userType == 'student') {
                $eventsQuery->where('category', 'general');
            }
    
            // Get and format the events
            $events = $eventsQuery->get()->map(function ($event) {
                // Ensure start and end datetime are formatted correctly
                $start_datetime = Carbon::parse($event->start_datetime)->format('Y-m-d\TH:i:s');
                $end_datetime = Carbon::parse($event->end_datetime)->format('Y-m-d\TH:i:s');
    
                return [
                    'id' => $event->id,
                    'title' => $event->eventName,
                    'start' => $start_datetime,
                    'end' => $end_datetime,
                    'category' => $event->category,
                    'allDay' => false,
                ];
            });
    
            return response()->json(['data' => $events]);
        } catch (\Exception $e) {
            Log::error('Error fetching events: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching events'], 500);
        }
    }
    
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        // Validation and update logic here
        $event = Event::findOrFail($id);
        $event->eventName = $request->input('eventName');
        $event->category = $request->input('category');
        $event->start_datetime = $request->input('start_datetime');
        $event->end_datetime = $request->input('end_datetime');
        $event->save();
    
        notify()->success('Event Updated Successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
