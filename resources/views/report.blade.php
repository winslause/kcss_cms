<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KCSS CMS - Reporting</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .chart-container {
            position: relative;
            height: 300px;
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

    <!-- Previous body content -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
        <h1>Reporting</h1>

        <div class="row">
            <!-- Case Status Distribution -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Case Status Distribution (Pie Chart)</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cases Over Time -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Cases Over Time (Line Chart)</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Clients by Case Count -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Clients by Case Count (Bar Chart)</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Case Resolution Time -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Case Resolution Time (Histogram)</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="histogram"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Pie Chart for Case Status
        var pieCtx = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_keys($caseStatusData)) !!},
                datasets: [{
                    label: 'Case Status',
                    data: {!! json_encode(array_values($caseStatusData)) !!},
                    backgroundColor: ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)']
                }]
            },
            options: {
                responsive: true
            }
        });
    
        // Line Chart for Cases Over Time (using hours)
        var lineCtx = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(lineCtx, {
            type: 'line',
            data: {
                datasets: {!! json_encode(array_map(function($date, $data) {
                    return [
                        'label' => $date,
                        'data' => array_map(function($entry) {
                            return ['x' => $entry['hour'], 'y' => $entry['count']];
                        }, $data),
                        'fill' => false,
                        'borderColor' => 'rgba(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ', 0.5)'
                    ];
                }, array_keys($casesOverTime), $casesOverTime)) !!}
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        type: 'linear',
                        position: 'bottom',
                        title: {
                            display: true,
                            text: 'Hour of the Day'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Cases'
                        }
                    }
                }
            }
        });
    
        // Bar Chart for Clients by Case Count
        var barCtx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($clientCaseCount)) !!},
                datasets: [{
                    label: 'Case Count',
                    data: {!! json_encode(array_values($clientCaseCount)) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    
        // Histogram for Case Resolution Time (using hours)
        var histCtx = document.getElementById('histogram').getContext('2d');
        var resolutionTimeData = {!! json_encode($resolutionTimeData) !!};
        var histogram = new Chart(histCtx, {
            type: 'bar',
            data: {
                labels: Array.from({length: Math.max(...resolutionTimeData) + 1}, (_, i) => i + ' Hours'),
                datasets: [{
                    label: 'Cases',
                    data: resolutionTimeData.reduce((acc, val) => {
                        acc[val] = (acc[val] || 0) + 1;
                        return acc;
                    }, {}),
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Cases'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Resolution Time (Hours)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</body>
</html>