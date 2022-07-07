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
        $project = Project::find($issueData['project']);
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
            'comments',
        ]);
        $comments = $issue->comments()->with('user')->orderByDesc('updated_at')->get();
        $users = $issue->project->users()->with('position')->get()->prepend($issue->project->manager);
        $timeSpent = $this->timeSpent($issue->created_at, $issue->updated_at);

        return [
            'issue' => $issue->loadCount('comments'),
            'project' => $issue->project,
            'assignee' => $issue->assignee,
            'comments' => $comments,
            'timeSpent' => $timeSpent,
            'manager' => $issue->project->manager,
            'users' => $users,
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
        $query = $user->issues()->with(['status', 'project']);
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

    private function timeSpent($createdAt, $updatedAt): string
    {
        $startDate = new \DateTime($createdAt);
        $finishDate = new \DateTime($updatedAt);

        return $startDate->diff($finishDate)->format('%H:%I');
    }
}
