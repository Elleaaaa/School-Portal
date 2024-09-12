<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Handle the login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // Authentication passed...

            $user = Auth::user(); // Get the authenticated user

            // Check user's usertype and redirect accordingly 
            //$studentId in user is the id itself not students ID
            switch ($user->usertype) {
                case 'superadmin':
                    return redirect()->intended(route('supadmin-dashboard.show', ['supAdminId' => $user->studentId]));
                    break;
                case 'admin':
                    return redirect()->intended(route('admin-dashboard.show', ['studentId' => $user->studentId]));
                    break;
                case 'cashier':
                    return redirect()->intended(route('cashier-dashboard.show', ['cashierId' => $user->studentId]));
                    break;
                case 'teacher':
                    return redirect()->intended(route('teacher-dashboard.show', ['teacherId' => $user->studentId]));
                    break;
                default:
                if ($user->completeProfile == True) {
                    return redirect()->route('student-dashboard.show');
                }
                else
                    notify()->warning('Please Complete your Details First!');
                    return redirect()->route('profile-details.show', ['studentId' => $user->studentId]);
            }
        }

        // Authentication failed...
        return redirect()->back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    /**
     * Logout the authenticated user.
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('/'); // Redirect to login page after logout
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
