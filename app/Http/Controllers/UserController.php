<?php

namespace App\Http\Controllers;

use App\Models\User;  // Assuming you have a User model
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show a listing of users
    public function index()
    {
        $users = User::paginate(10);  // Get users with pagination
        return view('users.index', compact('users'));  // Pass to the view
    }

    // Show the form for creating a new user
    public function create()
    {
        return view('users.create');  // Add a view for creating a user
    }

    // Store a newly created user in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('users.index');
    }

    // Show the form for editing the specified user
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update the specified user in storage
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validated['password']) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index');
    }

    // Remove the specified user from storage
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
