<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userType = Auth::user()->usertype;
        $userId = Auth::user()->studentId;
        $notifications = Notification::where('is_read', false)
                            ->where('userId', $userId)
                            ->where('userRole', $userType)
                            ->get();
        return response()->json($notifications);
    }

    public function displayNotif()
    {
        $userType = Auth::user()->usertype;
        $userId = Auth::user()->studentId;
        $notifications = Notification::where('userId', $userId)
                            ->where('userRole', $userType)
                            ->orderBy('created_at', 'desc')
                            ->get();
        return view('notification', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        $notification->is_read = true;
        $notification->save();

        return response()->json(['status' => 'success']);
    }

    public function clearAll()
    {
        Notification::where('is_read', false)->update(['is_read' => true]);
        return response()->json(['status' => 'success']);
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
