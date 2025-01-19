<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CaseModel;
use App\Models\Client;

class CaseManagementController extends Controller
{
    /**
     * Display a listing of the cases.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cases = CaseModel::with('client')->get();
        $clients = Client::all(['id', 'name', 'nationalid']);
        return view('case', ['cases' => $cases, 'clients' => $clients]);
    }

    /**
     * Show the form for creating a new case.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all(['id', 'name', 'nationalid']);
        return view('case-create', ['clients' => $clients]);
    }

    /**
     * Store a newly created case in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,id',
            'status' => 'required|in:Open,Closed',
            'description' => 'required|string',
        ]);

        try {
            $client = Client::findOrFail($validatedData['client_id']);
            $validatedData['national_id'] = $client->nationalid;

            $case = CaseModel::create($validatedData);

            return redirect()->route('case.index')->with('success', 'Case created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create case: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified case.
     *
     * @param  \App\Models\CaseModel  $case
     * @return \Illuminate\Http\Response
     */
    public function edit(CaseModel $case)
    {
        $clients = Client::all(['id', 'name', 'nationalid']);
        return view('case-edit', ['case' => $case, 'clients' => $clients]);
    }

    /**
     * Update the specified case in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CaseModel  $case
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CaseModel $case)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,id',
            'status' => 'required|in:Open,Closed',
            'description' => 'required|string',
        ]);

        try {
            $client = Client::findOrFail($validatedData['client_id']);
            $validatedData['national_id'] = $client->nationalid;

            $case->update($validatedData);

            return redirect()->route('case.index')->with('success', 'Case updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update case: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified case from storage.
     *
     * @param  \App\Models\CaseModel  $case
     * @return \Illuminate\Http\Response
     */
    public function destroy(CaseModel $case)
    {
        try {
            $case->delete();
            return redirect()->route('case.index')->with('success', 'Case deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete case: ' . $e->getMessage());
        }
    }
}