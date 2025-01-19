<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Assuming you have a User model

class AdminSettingsController extends Controller
{
    /**
     * Display the admin settings page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch system configuration from database or config files if needed
        $systemConfig = [
            'name' => 'KCSS CMS',
            'adminEmail' => 'admin@kcss.com',
            'theme' => 'dark'
        ];

        // Fetch all users from the database with selected fields
        $users = User::select('id', 'name', 'email', 'phone', 'roles')->get();

        return view('admin', compact('systemConfig', 'users'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'roles' => 'required|in:admin,normal', // Assuming roles is stored as a string in the database
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'roles' => $validatedData['roles'], // Assuming roles is stored as a string in the database
            'password' => bcrypt($validatedData['password']),
            'is_active' => true, // Default to active, you can adjust this based on your needs
        ]);

        return response()->json(['message' => 'User added successfully'], 201);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'roles' => 'required|in:admin,normal',
        ]);

        $user->update($validatedData);

        return response()->json(['message' => 'User updated successfully'], 200);
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}