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
        $roles = $rolesAndPermissions->where('type', 'role');
        $users = User::all();
        return view('roles', compact('rolesAndPermissions', 'users', 'roles'));
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
        $rolePermission = RolePermission::where('id', $request->input('role_permission'))
                                       ->where('type', 'role')
                                       ->first();

        if ($user && $rolePermission) {
            $user->rolePermissions()->attach($rolePermission);
            return redirect()->back()->with('success', 'Role assigned successfully!');
        }
        return redirect()->back()->with('error', 'Failed to assign role. Make sure you are assigning a role.');
    }
}