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
        $status = IssueStatus::where('status', 'new')->first();
        $issue->status()->associate($status);
        $project = Project::where('title', $issueData['project'])->first();
        $this->projectStatusCheck($project);
        $issue->project()->associate($project);
        $issue->title = $issueData['title'];
        $issue->description = $issueData['description'];
        $assignee = User::find($issueData['assignee']);
        $issue->assignee()->associate($assignee);
        $issue->save();

    }

    public function updateIssue(Issue $issue, array $issueData): void
    {
        $issue->title = $issueData['title'];
        $issue->description = $issueData['description'];
        $this->issueStatusCheck($issue, $issueData['assignee']);
        $assignee = User::find($issueData['assignee']);
        $issue->assignee()->associate($assignee);
        $issue->save();
    }

    public function dataToShowIssue(Issue $issue): array
    {
        $issue->load(['status', 'project', 'project.users', 'project.users.position', 'assignee', 'assignee.position']);
        $project = $issue->project;
        $assignee = $issue->assignee;
        $users = $project->users;

        return [
            'issue' => $issue,
            'project' => $project,
            'assignee' => $assignee,
            'users' => $users,
        ];
    }

    public function issueStatus(Issue $issue): void
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

    public function issueStatusCheck(Issue $issue, string $assigneeId): void
    {
        if ($issue->assignee->id != $assigneeId) {
            $status = IssueStatus::where('status', 'new')->first();
            $issue->status()->associate($status);
        }
    }
}
