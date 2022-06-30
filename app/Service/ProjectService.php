<?php

namespace App\Service;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    public function prepareDataToCreateProject(): array
    {
        $clients = Client::all();
        $managers = User::whereRelation('department', 'name', 'Management')->get();
        $workers = $this->workers();
        $data = array_merge($workers, [
            'clients' => $clients,
            'managers' => $managers,
        ]);

        return $data;
    }

    public function prepareDataToShowProject(Project $project): array
    {
        $project->load([
            'client',
            'manager',
            'manager.position',
            'users',
            'users.position',
            'issues',
            'issues.status',
            'issues.assignee',
        ])->loadCount('issues');
        $issues = $project->issues()->orderByDesc('updated_at')->paginate(10);

        return [
            'project' => $project,
            'client' => $project->client,
            'manager' => $project->manager,
            'users' => $project->users,
            'issues' => $issues,
        ];
    }

    public function prepareDataToEditProject(Project $project): array
    {
        $project->load(['client', 'manager', 'users']);

        return array_merge($this->prepareDataToCreateProject(), [
            'project' => $project,
            'assignedWorkers' => $project->users,
        ]);
    }

    public function createProject(Project $project, array $projectData): void
    {
        $this->saveProject($project, $projectData);
        $project->users()->attach($projectData['workers']);
    }

    public function updateProject(Project $project, array $projectData): void
    {
        $this->saveProject($project, $projectData);
        $project->users()->sync($projectData['workers']);
    }

    public function projectStatusChange(Project $project)
    {
        $newStatus = $project->issues()->whereRelation('status', 'slug', 'new')
            ->get()->isNotEmpty();
        $inProgressStatus = $project->issues()->whereRelation('status', 'slug', 'in_progress')
            ->get()->isNotEmpty();
        $reviewStatus = $project->issues()->whereRelation('status', 'slug', 'review')
            ->get()->isNotEmpty();


        if ($newStatus || $inProgressStatus || $reviewStatus) {

            return redirect()->back()->with('error', 'Impossible to close Project with active Issues');
        }
        $project->finished_at = $this->finishedDateAssignment($project);

        $project->save();

    }

    private function workers(): array
    {
        $ceo = User::with('position')->where('key', 'ceo')->first();
        $designers = User::with('position')
            ->whereRelation('department', 'slug', 'design')->get();
        $frontenders = User::with('position')
            ->whereRelation('department', 'slug', 'frontend')->get();
        $backenders = User::with('position')
            ->whereRelation('department', 'slug', 'backend')->get();

        return [
            'designers' => $designers,
            'frontenders' => $frontenders,
            'backenders' => $backenders,
            'ceo' => $ceo,
        ];
    }

    private function saveProject(Project $project, array $projectData): void
    {
        $project->title = $projectData['title'];
        $project->description = $projectData['description'];
        $project->deadline = $projectData['deadline'];
        $this->addClient($project, $projectData['client']);
        $this->addManager($project, $projectData['manager']);
        $project->save();
    }

    private function addClient(Project $project, int $clientId): void
    {
        $client = Client::find($clientId);
        $project->client()->associate($client);
    }

    private function addManager(Project $project, int $managerId): void
    {
        $manager = User::find($managerId);
        $project->manager()->associate($manager);
    }

    private function finishedDateAssignment(Project $project): null|string
    {
        if ($project->finished_at !== null) {

            return null;
        }

        return date('Y-m-d');
    }
}
