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
            min-height: 100vh; /* Full viewport height */
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

                <!-- User Management Section -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>User Management</h5>
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone ?? 'N/A' }}</td>
                                            <td>{{ $user->roles }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">Edit</button>
                                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteUser({{ $user->id }})">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rest of your existing content for User Role Management, Password Reset, and System Configuration -->

                <!-- Add User Modal -->
                <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="addUserForm" action="{{ route('admin.storeUser') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone">
                                    </div>
                                    <div class="mb-3">
                                        <label for="roles" class="form-label">Role</label>
                                        <select class="form-control" id="roles" name="roles">
                                            <option value="admin">Admin</option>
                                            <option value="normal">Normal</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit User Modal -->
                @foreach($users as $user)
                <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="editUserForm{{ $user->id }}" action="{{ route('admin.updateUser', ['id' => $user->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="editName{{ $user->id }}" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="editName{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editEmail{{ $user->id }}" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="editEmail{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editPhone{{ $user->id }}" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="editPhone{{ $user->id }}" name="phone" value="{{ $user->phone }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editRoles{{ $user->id }}" class="form-label">Role</label>
                                        <select class="form-control" id="editRoles{{ $user->id }}" name="roles">
                                            <option value="admin" {{ $user->roles == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="normal" {{ $user->roles == 'normal' ? 'selected' : '' }}>Normal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function deleteUser(id) {
            if (confirm("Are you sure you want to delete this user?")) {
                fetch('/admin/deleteUser/' + id, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                });
            }
        }

        // Event listener for add user form
        document.getElementById('addUserForm').addEventListener('submit', function(e) {
            e.preventDefault();
            let form = this;
            let formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json())
            .then(data => {
                alert(data.message);
                location.reload();
            });
        });

        // Event listeners for edit user forms
        @foreach($users as $user)
        document.getElementById('editUserForm{{ $user->id }}').addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('Form submission attempted for user ' + {{ $user->id }});  // Debugging line
    let form = this;
    let formData = new FormData(form);
    fetch(form.action, {
        method: 'PUT',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    }).then(response => response.json())
    .then(data => {
        console.log('Server response:', data);  // Log server response
        alert(data.message);
        document.getElementById('editUserModal{{ $user->id }}').querySelector('.btn-close').click();
        location.reload();
    }).catch(error => {
        console.error('Error:', error);  // Log any errors
    });
});
        @endforeach
    </script>
</body>

</html>