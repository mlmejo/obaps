<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompanyCommitteeController extends Controller
{
    public function store(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'position' => [
                'required',
                Rule::in([
                    'chairman',
                    'vice_chairman',
                    'treasurer',
                    'secretary',
                    'member',
                ]),
            ],
        ]);

        if ($company->committee()->where('position', 'chairman')->count() >= 1) {
            return back()->with([
                'position' => 'Can only have 1 BAC chairman.',
            ]);
        }

        if ($company->committee()->where('position', 'vice_chairman')->count() >= 1) {
            return back()->with([
                'position' => 'Can only have 1 BAC vice chairman.',
            ]);
        }

        if ($company->committee()->where('position', 'treasurer')->count() >= 1) {
            return back()->with([
                'position' => 'Can only have 1 BAC treasurer.',
            ]);
        }

        if ($company->committee()->where('position', 'secretary')->count() >= 1) {
            return back()->with([
                'position' => 'Can only have 1 BAC secretary.',
            ]);
        }

        if ($company->committee()->where('position', 'member')->count() >= 3) {
            return back()->with([
                'position' => 'Cannot have more than 3 BAC members.',
            ]);
        }

        $company->committee()->create($validated);

        return redirect(route('companies.show', $company))->with([
            'message' => 'Committee member added succcessfully',
        ]);
    }
}
