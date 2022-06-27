<?php

namespace App\Http\Controllers;

use App\Http\Requests\Issue\StoreRequest;
use App\Models\Issue;
use App\Models\IssueStatus;
use App\Models\Project;
use App\Models\User;
use App\Service\IssueService;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreRequest $request, IssueService $service)
    {
        $issueData = $request->validated();
        $service->createIssue($issueData);

        return redirect()->back()->with('success', 'Issue successfully added');
    }

    public function show(Issue $issue, IssueService $service)
    {
        return view('issues.show', $service->dataToShowIssue($issue));
    }

    public function edit($id)
    {
        //
    }

    public function status(Issue $issue, IssueService $service)
    {
        $service->issueStatus($issue);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
