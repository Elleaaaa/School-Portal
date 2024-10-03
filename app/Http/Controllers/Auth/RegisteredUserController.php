<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Admin;
use App\Models\Assessor;
use App\Models\Cashier;
use App\Models\Guardian;
use App\Models\Student;
use App\Models\SuperAdmin;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use PhpParser\Node\Stmt\ElseIf_;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => ['required', 'string', 'max:255', 'unique:students'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'usertype' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $user = User::create([
            'studentId'=> $request->id,
            'email' => $request->email,
            'usertype' => $request->usertype,
            'password' => Hash::make($request->password),
        ]);
        $address = Address::create([
            'studentId'=> $request->id
        ]);
        
        // Add record in the appropriate table based on user type
        if ($request->usertype == 'student') {
            $student = Student::create([
                'studentId'=> $request->id
            ]);
        
            $guardian = Guardian::create([
                'studentId'=> $request->id
            ]);
        
            event(new Registered($student));
            event(new Registered($guardian));
        } 
        elseif ($request->usertype === 'teacher') {
            $teacher = Teacher::create([
                'teacherId'=> $request->id
            ]);
            event(new Registered($teacher));
        } 
        elseif ($request->usertype === 'admin') {
            $admin = Admin::create([
                'adminId'=> $request->id
            ]);
            event(new Registered($admin));
        } 
        elseif ($request->usertype === 'superadmin') {
            $superadmin = SuperAdmin::create([
                'supAdminId'=> $request->id
            ]);
            event(new Registered($superadmin));
        }
        elseif ($request->usertype === 'cashier') {
            $cashier = Cashier::create([
                'cashierId'=> $request->id
            ]);
            event(new Registered($cashier));
        }
        elseif ($request->usertype === 'assessor') {
            $assessor = Assessor::create([
                'assessorId'=> $request->id
            ]);
            event(new Registered($assessor));
        }
        
        event(new Registered($user));
        event(new Registered($address));
        
        return redirect('/login');
    }

}
