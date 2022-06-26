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
}
