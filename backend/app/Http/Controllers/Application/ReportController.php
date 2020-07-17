<?php

namespace App\Http\Controllers\Application;

use App\Http\Requests\ReportRequest;
use App\Models\TrApplication;
use App\Http\Controllers\Controller as Controller;

class ReportController extends Controller
{

    public function create(TrApplication $trApplication)
    {
        $this->authorize('viewOwner', $trApplication);

        return view('application.report_create', compact('trApplication'));
    }

    public function store(TrApplication $trApplication, ReportRequest $request)
    {
        $this->authorize('viewOwner', $trApplication);

        $trApplication->tr_application_reports()->create($request->validated());

        return redirect()
            ->route('application.report.complete')
            ->with('tr_application_id', $trApplication->id);
    }

    public function complete()
    {
        return view('application.report_complete');
    }
}
