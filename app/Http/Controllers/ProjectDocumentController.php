<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectDocumentController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'document' => 'required|file',
        ]);

        $file = $request->file('document');

        $project->documents()->create([
            'original_filename' => $file->getClientOriginalName(),
            'path' => $file->store('documents'),
        ]);

        return back()->with([
            'message' => 'Document uploaded successfully.',
        ]);
    }
}
