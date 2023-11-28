<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Project;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('projects.index', ['projects' => Project::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Company $company)
    {
        $validated = $request->validate([
            'title' => 'required|string',
        ]);

        try {
            $company->projects()->create($validated);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->withErrors([
                    'title' => 'Similar project already in progress.',
                ]);
            }
        }

        return redirect(route('companies.show', $company))->with([
            'message' => 'Project initiated successfully.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company, Project $project)
    {
        return view('projects.show', [
            'company' => $company,
            'project' => $project,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
