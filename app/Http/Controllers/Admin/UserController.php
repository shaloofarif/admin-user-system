<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
     // Display a list of users
     public function index()
     {
         $users = User::all(); // Get all users
         return view('admin.users.index', compact('users'));
     }

    /**
     * Show the form for creating a new resource.
     */
    // Show the form for creating a new user
    public function create()
    {
        return view('admin.users.create');
    }

    // Store a newly created user
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:15|unique:users,mobile_no',
            'email' => 'required|email|unique:users,email',
        ]);

        // Generate a random password
        $password = Str::random(10);

        User::create([
            'first_name' => $validatedData['first_name'],
            'mobile_no' => $validatedData['mobile_no'],
            'email' => $validatedData['email'],
            'password' => bcrypt($password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    // Show the form for editing an existing user
    public function edit($id)
    {
        $user = User::findOrFail($id); // Get user by id
        return view('admin.users.edit', compact('user'));
    }

    // Update an existing user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:15|unique:users,mobile_no,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user->update([
            'first_name' => $validatedData['first_name'],
            'mobile_no' => $validatedData['mobile_no'],
            'email' => $validatedData['email'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
