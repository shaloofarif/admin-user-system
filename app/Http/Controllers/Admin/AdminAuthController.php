<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Hardcoded admin credentials
        $adminCredentials = [
            'email' => 'admin@gmail.com', // Set your admin username
            'password' => 'password123', // Set your admin password
        ];

        // Verify the credentials
        if ($request->email === $adminCredentials['email'] &&
            $request->password === $adminCredentials['password']) {
            // Store session data (use your preferred method)
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }

        // Invalid credentials
        return back()->withErrors(['login_failed' => 'Invalid username or password.']);
    }

    public function showLoginForm()
    {
        return view('admin.login'); // Show the login form
    }

    public function dashboard()
{
    // Total number of users
    $totalUsers = \App\Models\User::count();

    // Recent user logins (5 most recent)
    $recentLogins = \DB::table('ips')
        ->join('users', 'ips.user_id', '=', 'users.id')
        ->select('users.email', 'ips.ip_address', 'ips.created_at')
        ->orderBy('ips.created_at', 'desc')
        ->limit(5)
        ->get();

    // Pass data to the view
    return view('admin.dashboard', [
        'totalUsers' => $totalUsers,
        'recentLogins' => $recentLogins,
    ]);
}


    public function logout(Request $request)
    {
        // Log out the admin by removing session data or authentication details
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }
}


