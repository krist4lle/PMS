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
        $project->load(['client', 'manager', 'users', 'users.position']);
        $client = $project->client;
        $manager = $project->manager;
        $users = $project->users;

        return [
            'project' => $project,
            'client' => $client,
            'manager' => $manager,
            'users' => $users,
        ];
    }

    public function createProject(array $projectData)
    {
        $project = new Project();
        $project->title = $projectData['title'];
        $project->description = $projectData['description'];
        $project->deadline = $projectData['deadline'];
        $this->addClient($project, $projectData['client']);
        $this->addManager($project, $projectData['manager']);
        $project->save();
        $this->addWorkers($project, $projectData['workers']);
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

    private function addWorkers(Project $project, array $workers): void
    {
        foreach ($workers as $workerId) {
            $worker = User::find($workerId);
            $project->users()->attach($worker);
        }
    }
}
