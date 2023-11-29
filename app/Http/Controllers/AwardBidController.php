<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class AwardBidController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Project $project)
    {
        $request->validate([
            'awardee' => 'required|exists:users,id',
        ]);

        $project->bidders()->where('bidder_id', $request->awardee)
            ->first()->update(['awardee' => true]);

        return back()->with([
            'message' => 'Bid has been awarded.',
        ]);
    }
}
