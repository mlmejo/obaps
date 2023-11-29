<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class StartBiddingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Project $project)
    {
        $project->update([
            'status' => 'ongoing',
        ]);

        $project->biddingProgress()->create([
            'period' => 'first',
        ]);

        return back()->with([
            'message' => 'Bidding has now started.',
        ]);
    }
}
