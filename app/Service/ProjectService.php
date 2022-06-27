<?php

namespace App\Service;

use App\Models\Client;
use App\Models\Department;
use App\Models\Position;
use App\Models\Project;
use App\Models\User;

class ProjectService
{
    public function dataToCreateProject(): array
    {
        $clients = Client::all();
        $managers = User::whereRelation('department', 'name', 'Management')->get();
        $designers = User::with('position')
            ->whereRelation('department', 'name', 'Design')->get();
        $frontenders = User::with('position')
            ->whereRelation('department', 'name', 'Frontend')->get();
        $backenders = User::with('position')
            ->whereRelation('department', 'name', 'Backend')->get();

        return [
            'clients' => $clients,
            'managers' => $managers,
            'designers' => $designers,
            'frontenders' => $frontenders,
            'backenders' => $backenders,
        ];
    }

    public function dataToShowProject(Project $project): array
    {
        $project->load([
            'client',
            'manager',
            'users',
            'users.position',
            'issues',
            'issues.status',
            'issues.assignee',
        ]);
        $client = $project->client;
        $manager = $project->manager;
        $users = $project->users;
        $issues = $project->issues;

        return [
            'project' => $project,
            'client' => $client,
            'manager' => $manager,
            'users' => $users,
            'issues' => $issues,
        ];
    }

    public function dataToEditProject(Project $project): array
    {
        $project->load(['client', 'manager', 'users']);
        $assignedWorkers = $project->users->pluck('id')->toArray();
        $dataToEditProject = [
            'project' => $project,
            'assignedWorkers' => $assignedWorkers
        ];

        return array_merge($dataToEditProject, $this->dataToCreateProject());
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

    public function projectStatus(Project $project, string $finishedAtDate): void
    {
        if (empty($project->issues)) {
            $project->finished_at !== null ? $project->finished_at = null : $project->finished_at = $finishedAtDate;
            $project->save();
        } else {
            redirect()->back()->with('error', 'Impossible to close Project with active Issues');
        }
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

    private function addClient(Project $project, string $clientTitle): void
    {
        $client = Client::where('title', $clientTitle)->first();
        $project->client()->associate($client);
    }

    private function addManager(Project $project, string $managerId): void
    {
        $manager = User::find($managerId);
        $project->manager()->associate($manager);
    }
}
