<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KCSS CMS</title>
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
                    <a href="{{ route('report.index') }}">Reporting</a>
                    <a href="{{ route('admin.index') }}">Admin Settings</a>
                    <a href="{{ route('roles.index') }}">User Roles & Permissions</a>
                    <a href="{{ route('logout') }}">Logout</a>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
                <h1>Dashboard</h1>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Clients</h5>
                                <p class="card-text">{{ $totalClients }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Open Cases</h5>
                                <p class="card-text">{{ $openCases }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Closed Cases</h5>
                                <p class="card-text">{{ $closedCases }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Pending Tasks</h5>
                                <p class="card-text">{{ $pendingTasks }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Cases -->
                <h2>Recent Cases</h2>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Case ID</th>
                                <th scope="col">Client Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Last Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentCases as $case)
                            <tr>
                                <th scope="row">{{ $case->id }}</th>
                                <td>{{ $case->client->name }}</td>
                                <td>{{ $case->description }}</td>
                                <td>{{ $case->status }}</td>
                                <td>{{ $case->updated_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>