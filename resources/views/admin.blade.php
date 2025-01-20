<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KCSS CMS - Admin Settings</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
        }

        .sidebar a {
            color: white;
            padding: 15px;
            display: block;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            padding: 20px;
        }

        .navbar-brand {
            color: white;
        }

        .card {
            margin-bottom: 20px;
        }

        .form-control {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Navbar for small screens -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-md-none">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('dashboard') }}">KCSS CMS</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>

            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-2 d-md-block sidebar collapse">
                <div class="sidebar-sticky">
                    <a class="navbar-brand" href="{{ route('dashboard') }}">KCSS CMS</a>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <a href="{{ route('client.index') }}">Client Management</a>
                    <a href="{{ route('case.index') }}">Case Management</a>
                    <a href="{{ route('report.index') }}">Reporting</a>
                    <a href="{{ route('admin.index') }}">Admin Settings</a>
                    <a href="{{ route('roles.index') }}">User Roles & Permissions</a>
                    <a href="{{ route('logout') }}">Logout</a>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
                <h1>Admin Settings</h1>

                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row">
                    <!-- User Role Management -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>User Roles & Permissions</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('roles.store') }}" method="post">
                                    @csrf
                                    <label for="roleName">Role Name</label>
                                    <input type="text" class="form-control" id="roleName" name="roleName" placeholder="Enter role name">
                                    
                                    <label for="permissions">Permissions</label>
                                    <select multiple class="form-control" id="permissions" name="permissions[]">
                                        <option>Manage Clients</option>
                                        <option>Manage Cases</option>
                                        <option>View Reports</option>
                                        <option>Admin Settings Access</option>
                                    </select>
                                    
                                    <button type="submit" class="btn btn-primary mt-3">Save Role</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Password Reset -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Reset User Password</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('users.resetPassword') }}" method="post">
                                    @csrf
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">

                                    <label for="newPassword">New Password</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter new password">

                                    <button type="submit" class="btn btn-danger mt-3">Reset Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Configuration -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>System Configuration</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('system.config.update') }}" method="post">
                                    @csrf
                                    <label for="systemName">System Name</label>
                                    <input type="text" class="form-control" id="systemName" name="systemName" value="{{ $systemConfig['name'] }}">

                                    <label for="adminEmail">Admin Email</label>
                                    <input type="email" class="form-control" id="adminEmail" name="adminEmail" value="{{ $systemConfig['adminEmail'] }}">

                                    <label for="theme">Theme Color</label>
                                    <select class="form-control" id="theme" name="theme">
                                        <option value="dark" {{ $systemConfig['theme'] === 'dark' ? 'selected' : '' }}>Dark</option>
                                        <option value="light" {{ $systemConfig['theme'] === 'light' ? 'selected' : '' }}>Light</option>
                                        <option value="blue" {{ $systemConfig['theme'] === 'blue' ? 'selected' : '' }}>Blue</option>
                                    </select>

                                    <button type="submit" class="btn btn-success mt-3">Save Configuration</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>