<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KCSS CMS - Case Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {font-family: Arial, sans-serif; background-color: #f8f9fa;}
        .sidebar {min-height: 100vh; background-color: #343a40; padding-top: 20px;}
        .sidebar a {color: white; padding: 15px; display: block; text-decoration: none;}
        .sidebar a:hover {background-color: #495057;}
        .content {padding: 20px;}
        .navbar-brand {color: white;}
        .card {margin-bottom: 20px;}
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
                    {{-- <a href="{{ route('report.index') }}">Reporting</a> --}}
                    {{-- <a href="{{ route('admin.index') }}">Admin Settings</a>
                    <a href="{{ route('roles.index') }}">User Roles & Permissions</a>
                    <a href="{{ route('logout') }}">Logout</a> --}}
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
                <h1>Case Management</h1>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Case Management Table -->
                        <div class="card">
                            <div class="card-header">
                                <h5>Case List</h5>
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                        data-bs-target="#addCaseModal">Add New Case</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Case ID</th>
                                                <th scope="col">Case Title</th>
                                                <th scope="col">Client Name</th>
                                                <th scope="col">National ID</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cases as $case)
                                            <tr>
                                                <th scope="row">{{ $case->id }}</th>
                                                <td>{{ $case->title }}</td>
                                                <td>{{ $case->client->name }}</td>
                                                <td>{{ $case->national_id }}</td>
                                                <td>{{ $case->status }}</td>
                                                <td>
                                                    <a href="{{ route('case.edit', $case->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('case.destroy', $case->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Add Case Modal -->
    <!-- Include the modal here or in a separate file like case.create -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>