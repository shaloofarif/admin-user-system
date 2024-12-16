<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Check if admin is logged in by checking the session or authentication logic
        // If no session or admin authentication exists, redirect to login page

        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
