<?php

namespace App\Http\Controllers;

use App\Http\Requests\Issue\StoreRequest;
use App\Models\Issue;
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
        $projects = Project::all();
        $assignees = User::whereHas('parent')->with('position')->get();

        return view('issues.create', [
            'projects' => $projects,
            'assignees' => $assignees,
        ]);
    }

    public function store(StoreRequest $request, IssueService $service)
    {
        $issueData = $request->validated();
        $service->createIssue($issueData);

    }

    public function show(Issue $issue)
    {
        $issue->load(['status', 'project', 'assignee', 'assignee.position']);
        $project = $issue->project;
        $assignee = $issue->assignee;

        return view('issues.show', [
            'issue' => $issue,
            'project' => $project,
            'assignee' => $assignee,
        ]);
    }

    public function edit($id)
    {
        //
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
