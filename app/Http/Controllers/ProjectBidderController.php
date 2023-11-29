<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectBidderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $project->bidders()->attach($request->user()->id);

        return back()->with([
            'message' => 'Successfully petitioned to bid.',
        ]);
    }
}
