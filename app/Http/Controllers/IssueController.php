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
    public function store(StoreRequest $request, IssueService $service)
    {
        $issueData = $request->validated();
        $project = Project::find($issueData['project']);
        $this->authorize('create', [Issue::class, $project]);
        $service->createIssue($issueData);

        return redirect()->back()->with('success', 'Issue successfully added');
    }

    public function show(Issue $issue, IssueService $service)
    {
        return view('issues.show', $service->prepareDataToShowIssue($issue));
    }

    public function status(Issue $issue, IssueService $service)
    {
        $this->authorize('status', [$issue, $issue->project]);
        $service->changeIssueStatus($issue);

        return redirect()->back();
    }

    public function update(UpdateRequest $request, Issue $issue, IssueService $service)
    {
        $this->authorize('update', [$issue, $issue->project]);
        $issueData = $request->validated();
        $service->updateIssue($issue, $issueData);

        return redirect()->back()->with('success', 'Issue successfully updated');
    }

    public function destroy(Issue $issue)
    {
        $project = $issue->project;
        $this->authorize('delete', [$issue, $project]);
        $issue->delete();

        return redirect()->route('projects.show', $project)->with('success', 'Issue successfully deleted');
    }
}
