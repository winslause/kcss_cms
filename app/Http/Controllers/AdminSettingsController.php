<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    /**
     * Display the admin settings page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Fetch admin settings from the database or configuration files.
        // Here, we'll use static data for demonstration.
        $systemConfig = [
            'name' => 'KCSS CMS',
            'adminEmail' => 'admin@kcss.com',
            'theme' => 'dark'
        ];

        return view('admin', compact('systemConfig'));
    }

    /**
     * Handle the form submission for user role management.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeRole(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'roleName' => 'required|string|max:255',
            'permissions' => 'required|array',
        ]);

        // Here, you would typically save the role and permissions to the database
        // For example:
        // $role = Role::create(['name' => $validatedData['roleName']]);
        // $role->givePermissionTo($validatedData['permissions']);

        // Redirect back with a success message
        return redirect()->route('admin.index')->with('success', 'Role saved successfully!');
    }

    /**
     * Handle password reset for a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'username' => 'required|string|exists:users,username',
            'newPassword' => 'required|string|min:8|confirmed',
        ]);

        // Here, you would typically update the user's password in the database
        // For example:
        // $user = User::where('username', $request->username)->first();
        // $user->password = Hash::make($request->newPassword);
        // $user->save();

        return redirect()->route('admin.index')->with('success', 'Password reset successfully!');
    }

    /**
     * Handle system configuration updates.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSystemConfig(Request $request)
    {
        $request->validate([
            'systemName' => 'required|string|max:255',
            'adminEmail' => 'required|email',
            'theme' => 'required|in:dark,light,blue',
        ]);

        // Here, you would typically update the system configuration in the database or config file
        // For example:
        // Config::set('system.name', $request->systemName);
        // Config::save(); // If using a package for dynamic config updates

        return redirect()->route('admin.index')->with('success', 'System configuration updated!');
    }
}