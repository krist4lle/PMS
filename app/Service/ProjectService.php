<?php

namespace App\Service;

use App\Exceptions\ProjectHasIssuesException;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;

class ProjectService
{
    public function prepareDataToCreateProject(): array
    {
        $clients = Client::all();
        $ceo = User::where('key', 'ceo')->first();
        $managers = User::whereRelation('department', 'name', 'Management')->get()->prepend($ceo);
        $users = User::with('position')->get();

        return [
            'clients' => $clients,
            'managers' => $managers,
            'users' => $users,
        ];
    }

    public function prepareDataToShowProject(Project $project): array
    {
        $project->load(['users', 'issues'])->loadCount('issues');
        $issues = $project->issues()->with(['status', 'assignee'])
            ->orderByDesc('updated_at')->paginate(10);
        $manager = $project->manager;
        $users = $project->users()->with('position')->get()->prepend($manager);

        return [
            'project' => $project,
            'client' => $project->client,
            'users' => $users,
            'issues' => $issues,
            'manager' => $manager,
        ];
    }

    public function prepareDataToEditProject(Project $project): array
    {
        return array_merge($this->prepareDataToCreateProject(), [
            'project' => $project,
            'assignedWorkers' => $project->users,
        ]);
    }

    public function createProject(Project $project, array $projectData): Project
    {
        $this->saveProject($project, $projectData);
        $project->users()->attach($projectData['workers']);

        return $project;
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

            throw new ProjectHasIssuesException();
            //return redirect()->back()->with('error', 'Impossible to close Project with active Issues');
        }
        $project->finished_at = $this->finishedDateAssignment($project);

        $project->save();
    }

    private function saveProject(Project $project, array $projectData): void
    {
        $project->title = $projectData['title'];
        $project->description = $projectData['description'];
        if (isset($projectData['deadline'])) {
            $project->deadline = $projectData['deadline'];
        }
        if (isset($projectData['client'])) {
            $this->addClient($project, $projectData['client']);
        }
        if (isset($projectData['manager'])) {
            $this->addManager($project, $projectData['manager']);
        }
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
        return $project->finished_at !== null ? null : date('Y-m-d');
    }
}
