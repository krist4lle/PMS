<?php

namespace App\Service;

use App\Models\Client;
use App\Models\Department;
use App\Models\Issue;
use App\Models\IssueStatus;
use App\Models\Position;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class IssueService
{
    public function createIssue(array $issueData): void
    {
        $issue = new Issue();
        $status = IssueStatus::where('slug', 'new')->first();
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

    public function prepareDataToShowIssue(Issue $issue): array
    {
        $issue->load([
            'status',
            'project',
            'project.users',
            'project.users.position',
            'assignee',
            'assignee.position',
            'comments',
            'comments.user',
        ]);

        return [
            'issue' => $issue->loadCount('comments'),
            'project' => $issue->project,
            'assignee' => $issue->assignee,
            'users' => $issue->project->users,
            'comments' => $issue->comments,
        ];
    }

    public function changeIssueStatus(Issue $issue): void
    {
        switch ($issue->status->slug) {
            case 'new':
                $status = IssueStatus::where('slug', 'in_progress')->first();
                break;
            case 'in_progress':
                $status = IssueStatus::where('slug', 'review')->first();
                break;
            case 'review':
                $status = IssueStatus::where('slug', 'done')->first();
                $issue->finished_at = date('Y-m-d H:i:s');
                break;
        }
        $issue->status()->associate($status);

        $issue->save();
    }

    public function projectFilter(User $user, int|null $filteredProjectId)
    {
        $query = $user->issues();
        if ($filteredProjectId !== null) {
            $query->myIssues($filteredProjectId);
        }

        return $query->paginate(10);
    }

    private function projectStatusCheck(Project $project)
    {
        if (isset($project->finished_at)) {
            throw ValidationException::withMessages(['error' => 'Impossible to add an Issue to closed Project']);
        }
    }

    private function issueStatusCheck(Issue $issue, string $assigneeId): void
    {
        if ($issue->assignee->id != $assigneeId) {
            $status = IssueStatus::where('slug', 'new')->first();
            $issue->status()->associate($status);
        }
    }
}
