<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    public function processLogin(Request $request)
    {
        // Validate form input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {

            // Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();

            return redirect()->route('user.dashboard'); // Adjust to your desired route
        }

        // If login fails, return with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Log out the user
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate and regenerate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the login page
        return redirect()->route('user.login')->with('success', 'You have been logged out.');
    }

    // Show the Sign-Up form
    public function showSignUpForm()
    {
        return view('auth.signup'); // Return the signup form view
    }
    
    public function register(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:15|unique:users,mobile_no',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user
        User::create([
            'first_name' => $validatedData['first_name'],
            'mobile_no' => $validatedData['mobile_no'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Redirect to the login page with success message
        return redirect()->route('user.login')->with('success', 'Registration successful. Please log in.');
    }

    // Show User Dashboard
    public function dashboard()
    {
        return view('user.dashboard'); // Create dashboard view
    }

    // Show Edit Profile Form
    public function editProfile()
    {
        $user = Auth::user(); // Get logged-in user
        return view('user/edit', compact('user'));
    }

    // Update Profile
    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'mobile_no' => 'required|numeric|unique:users,mobile_no,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->first_name = $request->input('first_name');
        $user->email = $request->input('email');
        $user->mobile_no = $request->input('mobile_no');

        // If the user wants to update the password
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return redirect()->route('user.profile.edit')->with('success', 'Profile updated successfully!');
    }
}
