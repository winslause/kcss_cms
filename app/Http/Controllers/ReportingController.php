<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\CaseModel;
use Carbon\Carbon;

class ReportingController extends Controller
{
    /**
     * Display the reporting page with chart data.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Case Status Distribution (Pie Chart) - Unchanged as it doesn't involve time
        $caseStatusData = CaseModel::selectRaw('status, COUNT(*) as count')
                                   ->groupBy('status')
                                   ->pluck('count', 'status')
                                   ->toArray();

        // Cases Over Time (Line Chart) - Now using hours
        // Cases Over Time (Line Chart) - Now using hours
$casesOverTime = CaseModel::selectRaw('DATE(created_at) as date, HOUR(created_at) as hour, COUNT(*) as count')
->groupBy('date', 'hour')
->orderBy('date', 'asc')
->orderBy('hour', 'asc')
->get()
->mapToGroups(function ($item) {
    // Convert the date string to a Carbon instance
    $carbonDate = Carbon::parse($item->date);
    return [$carbonDate->format('Y-m-d') => ['hour' => $item->hour, 'count' => $item->count]];
})
->map(function ($dayData) {
    return $dayData->sortBy('hour')->values()->all();
})
->toArray();

        // Clients by Case Count (Bar Chart) - Unchanged as it doesn't involve time
        $clientCaseCount = Client::select('clients.name', \DB::raw('COUNT(cases.id) as case_count'))
                                 ->leftJoin('cases', 'clients.id', '=', 'cases.client_id')
                                 ->groupBy('clients.id', 'clients.name')
                                 ->orderBy('case_count', 'desc')
                                 ->limit(10) // Show top 10 clients for clarity
                                 ->get()
                                 ->pluck('case_count', 'name')
                                 ->toArray();

        // Case Resolution Time (Histogram) - Using hours
        $resolutionTimeData = CaseModel::where('status', 'Closed')
                                       ->selectRaw('TIMESTAMPDIFF(HOUR, created_at, updated_at) as hours')
                                       ->pluck('hours')
                                       ->toArray();

        return view('report', compact('caseStatusData', 'casesOverTime', 'clientCaseCount', 'resolutionTimeData'));
    }
}