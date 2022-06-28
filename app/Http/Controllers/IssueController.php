<?php

namespace App\Http\Controllers;

use App\Http\Requests\Issue\StoreRequest;
use App\Http\Requests\Issue\UpdateRequest;
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
        return view('issues.show', $service->prepareDataToShowIssue($issue));
    }

    public function edit($id)
    {
        //
    }

    public function status(Issue $issue, IssueService $service)
    {
        $service->changeIssueStatus($issue);

        return redirect()->back();
    }

    public function update(UpdateRequest $request, Issue $issue, IssueService $service)
    {
        $issueData = $request->validated();
        $service->updateIssue($issue, $issueData);

        return redirect()->back()->with('success', 'Issue successfully updated');
    }

    public function destroy(Issue $issue)
    {
        $project = $issue->project;
        $issue->delete();

        return redirect()->route('projects.show', $project)->with('success', 'Issue successfully deleted');
    }
}
