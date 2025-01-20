<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RolePermission;
use App\Models\User;

class RolesController extends Controller
{
    public function index()
    {
        $rolesAndPermissions = RolePermission::all();
        $users = User::all();
        return view('roles', compact('rolesAndPermissions', 'users'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|in:role,permission',
        'description' => 'nullable|string',
    ]);

    RolePermission::create($request->only(['name', 'type', 'description']));

    return redirect()->back()->with('success', 'Role or Permission created successfully!');
}

    public function assign(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,id',
            'role_permission' => 'required|exists:roles_permissions,id',
        ]);

        $user = User::find($request->input('username'));
        $rolePermission = RolePermission::find($request->input('role_permission'));

        if ($user && $rolePermission) {
            $user->rolePermissions()->attach($rolePermission);
            return redirect()->back()->with('success', 'Role or Permission assigned successfully!');
        }
        return redirect()->back()->with('error', 'Failed to assign role or permission.');
    }
}
