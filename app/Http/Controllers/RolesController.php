<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display the roles and permissions page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Here, you could fetch roles and permissions from the database.
        // For this example, we'll use static data.
        $roles = [
            [
                'name' => 'Admin',
                'permissions' => ['Manage Clients', 'Manage Cases', 'View Reports', 'Admin Settings Access']
            ],
            [
                'name' => 'Manager',
                'permissions' => ['Manage Clients', 'View Reports']
            ],
            [
                'name' => 'Editor',
                'permissions' => ['Manage Cases']
            ],
            [
                'name' => 'Viewer',
                'permissions' => ['View Reports']
            ]
        ];

        return view('roles', compact('roles'));
    }
}