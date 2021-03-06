<?php

namespace App\Http\Controllers;

use App\Http\Requests\Me\ProjectRequest;
use App\Http\Requests\Me\UpdatePasswordRequest;
use App\Http\Requests\Me\UpdateRequest;
use App\Service\IssueService;
use App\Service\UserService;

class MeController extends Controller
{
    public function index()
    {
        $user = auth()->user()->loadCount(['issues', 'projects', 'managerProjects']);

        return view('me.index', [
            'user' => $user,
        ]);
    }

    public function update(UpdateRequest $request, UserService $service)
    {
        $user = $request->user();
        $userData = $request->validated();
        $service->updateUser($user, $userData);

        return redirect()->route('me.index')->with('success', 'Data successfully updated');
    }

    public function changePassword(UpdatePasswordRequest $request, UserService $service)
    {
        $user = $request->user();
        $newPassword = $request->validated('password');
        $service->changePassword($user, $newPassword);

        return redirect(route('me.index'))->with('successMessage', 'Password changed successfully');
    }

    public function issues(ProjectRequest $request, IssueService $service)
    {
        $user = auth()->user();
        $user->projects->isEmpty() ? $projects = $user->managerProjects : $projects = $user->projects;
        $filteredProjectId = $request->validated('project');
        $issues = $service->projectFilter($user, $filteredProjectId);

        return view('me.issues', [
            'issues' => $issues,
            'projects' => $projects,
            'filteredProjectId' => $filteredProjectId,
        ]);
    }

    public function projects(UserService $service)
    {
        $user = auth()->user()->load(['projects', 'managerProjects']);
        $projects = $service->retrieveUserProjects($user);

        return view('projects.index', [
            'projects' => $projects,
        ]);
    }
}
