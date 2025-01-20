<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function resetPassword(Request $request)
    {
        // Validate request
        $request->validate([
            'username' => 'required|string',
            'newPassword' => 'required|string|min:8',
        ]);

        // Find user by username
        $user = User::where('username', $request->input('username'))->first();

        if (!$user) {
            return redirect()->back()->withErrors(['username' => 'User not found']);
        }

        // Update the password
        $user->password = Hash::make($request->input('newPassword'));
        $user->save();

        return redirect()->back()->with('success', 'Password reset successfully');
    }
}
