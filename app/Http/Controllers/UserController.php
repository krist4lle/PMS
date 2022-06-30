<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\PositionRequest;
use App\Http\Requests\User\ProjectRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use App\Service\IssueService;
use App\Service\PositionService;
use App\Service\UserService;

class UserController extends Controller
{
    public function index(PositionRequest $request, UserService $service)
    {
        $positions = Position::all();
        $filteredPositionId = $request->validated('position');
        $users = $service->positionFilter($filteredPositionId);

        return view('users.index', [
            'users' => $users,
            'positions' => $positions,
        ]);
    }

    public function show(User $user)
    {
        $user->load(['department', 'position', 'projects', 'issues'])
            ->loadCount(['projects', 'issues', 'managerProjects']);

        return view('users.show', [
            'user' => $user
        ]);
    }

    public function projects(User $user, UserService $service)
    {
        $user->load(['projects', 'managerProjects']);
        $projects = $service->retrieveUserProjects($user);

        return view('projects.index', [
            'projects' =>  $projects,
        ]);
    }

    public function issues(User $user, ProjectRequest $request, IssueService $service)
    {
        $user->load(['issues', 'issues.status', 'projects', 'managerProjects']);
        $filteredProjectId = $request->validated('project');
        $issues = $service->projectFilter($user, $filteredProjectId);
        $user->department->slug === 'management' ? $projects = $user->managerProjects : $projects = $user->projects;


        return view('users.issues', [
            'issues' => $issues,
            'projects' => $projects,
            'filteredProjectId' => $filteredProjectId,
            'user' => $user,
        ]);
    }

    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        $parents = User::whereHas('children')->with('position')->get();

        return view('users.create', [
            'departments' => $departments,
            'positions' => $positions,
            'parents' => $parents,
        ]);
    }

    public function store(StoreRequest $request, UserService $service)
    {
        $userData = $request->validated();
        $service->createUser($userData);

        return redirect()->route('users.index')->with('success', 'User successfully created');
    }

    public function edit(User $user)
    {
        $user->load(['department', 'position', 'parent.position']);
        $departments = Department::all();
        $positions = Position::all();
        $parents = User::whereHas('children')->with('position')->get();

        return view('users.edit', [
            'user' => $user,
            'departments' => $departments,
            'positions' => $positions,
            'parents' => $parents,
        ]);
    }

    public function update(User $user, UpdateUserRequest $userRequest, UserService $service)
    {
        $userData = $userRequest->validated();
        $service->updateUser($user, $userData);
        $service->changePassword($user, $userData['password']);

        return redirect()->back()->with('success', 'User successfully updated');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User successfully fired');
    }
}
