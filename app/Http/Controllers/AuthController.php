<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register Form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Register User
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Check existing Student
        $student = Student::where('email', $request->email)->first();

        // Check existing Teacher
        $teacher = Teacher::where('email', $request->email)->first();

        // Email does not exist in Student or Teacher records
        if (!$student && !$teacher) {
            return back()
                ->withErrors([
                    'email' => 'This email is not registered by Admin.'
                ])
                ->withInput();
        }

        // Same email exists in both tables
        if ($student && $teacher) {
            return back()
                ->withErrors([
                    'email' => 'This email is linked to multiple records. Please contact Admin.'
                ])
                ->withInput();
        }

        // Prevent duplicate account
        if (User::where('email', $request->email)->exists()) {
            return back()
                ->withErrors([
                    'email' => 'An account with this email already exists. Please login.'
                ])
                ->withInput();
        }

        // Determine role automatically
        if ($student) {
            $name = $student->name;
            $role = 'Student';
        } else {
            $name = $teacher->name;
            $role = 'Teacher';
        }

        // Create user
        User::create([
            'name' => $name,
            'email' => $request->email,
            'role' => $role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('login')
            ->with('status', 'Registration successful. Please login.');
    }

    // Login Form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Login User
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid Email or Password.'
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
