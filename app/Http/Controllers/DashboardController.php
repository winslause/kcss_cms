<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\CaseModel;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch data from the database
        $totalClients = Client::count();
        $openCases = CaseModel::where('status', 'Open')->count();
        $closedCases = CaseModel::where('status', 'Closed')->count();
        // Assuming 'Pending Tasks' refers to cases with some other status or additional table
        $pendingTasks = CaseModel::whereNotIn('status', ['Open', 'Closed'])->count();
        
        // Fetch recent cases, limit to 5 for example, sorted by most recent first
        $recentCases = CaseModel::with('client')
                                ->orderBy('updated_at', 'desc') // This ensures sorting by most recent first
                                ->limit(5)
                                ->get();

        return view('index', compact('totalClients', 'openCases', 'closedCases', 'pendingTasks', 'recentCases'));
    }
}