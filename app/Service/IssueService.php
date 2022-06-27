<?php

namespace App\Service;

use App\Models\Client;
use App\Models\Department;
use App\Models\Issue;
use App\Models\IssueStatus;
use App\Models\Position;
use App\Models\Project;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class IssueService
{
    public function createIssue(array $issueData): void
    {
        $issue = new Issue();
        $issue->title = $issueData['title'];
        $issue->description = $issueData['description'];
        $status = IssueStatus::where('status', 'new')->first();
        $issue->status()->associate($status);
        $project = Project::where('title', $issueData['project'])->first();
        $this->projectStatusCheck($project);
        $issue->project()->associate($project);
        $assignee = User::find($issueData['assignee']);
        $issue->assignee()->associate($assignee);
        $issue->save();
    }

    public function dataToShowIssue(Issue $issue): array
    {
        $issue->load(['status', 'project', 'assignee', 'assignee.position']);
        $project = $issue->project;
        $assignee = $issue->assignee;

        return [
            'issue' => $issue,
            'project' => $project,
            'assignee' => $assignee,
        ];
    }

    public function issueStatus(Issue $issue)
    {
        if ($issue->status->status === 'new') {
            $status = IssueStatus::where('status', 'in progress')->first();
        } else {
            $status = IssueStatus::where('status', 'closed')->first();
            $issue->finished_at = date('Y-m-d H:i:s');
        }
        $issue->status()->associate($status);
        $issue->save();
    }

    private function projectStatusCheck(Project $project)
    {
        if (isset($project->finished_at)) {
            throw ValidationException::withMessages(['error' => 'Impossible to add an Issue to closed Project']);
        }
    }
}
