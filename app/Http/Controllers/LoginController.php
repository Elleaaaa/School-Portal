<?php

namespace App\Http\Controllers;

use App\Models\Log;
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
    // public function login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         // Authentication passed...

    //         $user = Auth::user(); // Get the authenticated user
    //         $ipAddress = $request->ip();

    //         $activity = "Logged in as " . $user->studentId . " from " . $ipAddress;

    //         $logs = new Log();
    //         $logs->studentId = $user->studentId;
    //         $logs->type = "login";
    //         $logs->activity = $activity;
    //         $logs->save();

    //         // Check user's usertype and redirect accordingly 
    //         //$studentId in user is the id itself not students ID
    //         switch ($user->usertype) {
    //             case 'superadmin':
    //                 return redirect()->intended(route('supadmin-dashboard.show', ['supAdminId' => $user->studentId]));
    //                 break;
    //             case 'admin':
    //                 return redirect()->intended(route('admin-dashboard.show', ['studentId' => $user->studentId]));
    //                 break;
    //             case 'cashier':
    //                 return redirect()->intended(route('cashier-dashboard.show', ['cashierId' => $user->studentId]));
    //                 break;
    //             case 'assessor':
    //                 return redirect()->intended(route('assessor-dashboard.show', ['assessorId' => $user->studentId]));
    //                 break;
    //             case 'teacher':
    //                 return redirect()->intended(route('teacher-dashboard.show', ['teacherId' => $user->studentId]));
    //                 break;
    //             default:
    //                 if ($user->completeProfile == True) {
    //                     return redirect()->route('student-dashboard.show');
    //                 } else
    //                     notify()->warning('Please Complete your Details First!');
    //                 return redirect()->route('profile-details.show', ['studentId' => $user->studentId]);
    //         }
    //     }

    //     // Authentication failed...
    //     return redirect()->back()->withErrors([
    //         'email' => 'These credentials do not match our records.',
    //     ]);
    // }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Check if "remember me" is selected
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Authentication passed...

            $user = Auth::user(); // Get the authenticated user
            $ipAddress = $request->ip();

            $activity = "Logged in as " . $user->studentId . " from " . $ipAddress;

            $logs = new Log();
            $logs->studentId = $user->studentId;
            $logs->type = "login";
            $logs->activity = $activity;
            $logs->save();

            // Check user's usertype and redirect accordingly
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
                case 'assessor':
                    return redirect()->intended(route('assessor-dashboard.show', ['assessorId' => $user->studentId]));
                    break;
                case 'teacher':
                    return redirect()->intended(route('teacher-dashboard.show', ['teacherId' => $user->studentId]));
                    break;
                default:
                    if ($user->completeProfile == true) {
                        return redirect()->route('student-dashboard.show');
                    } else {
                        notify()->warning('Please Complete your Details First!');
                        return redirect()->route('profile-details.show', ['studentId' => $user->studentId]);
                    }
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
    public function logout(Request $request)
    {
        Auth::logout(); // Log out the user
    
        // Invalidate the user's session
        $request->session()->invalidate();
    
        // Regenerate the CSRF token to prevent session fixation
        $request->session()->regenerateToken();
    
        // Redirect to the login page
        return redirect('/login'); // Corrected redirect method
    }
    
}
