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
use Illuminate\Support\Arr;

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
            'filteredPositionId' => $filteredPositionId,
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

    public function create(UserService $service)
    {
        $user = auth()->user();
        $this->authorize('create', $user);

        return view('users.create', $service->prepareData($user));
    }

    public function store(StoreRequest $request, UserService $service)
    {
        $this->authorize('create', auth()->user());
        $userData = $request->validated();
        $service->createUser($userData);

        return redirect()->route('users.index')->with('success', 'User successfully created');
    }

    public function edit(User $user, UserService $service)
    {
        $this->authorize('update', $user);
        $user->load(['department', 'position', 'parent.position']);
        $data = Arr::add($service->prepareData(auth()->user()), 'user', $user);

        return view('users.edit', $data);
    }

    public function update(User $user, UpdateUserRequest $userRequest, UserService $service)
    {
        $this->authorize('update', $user);
        $userData = $userRequest->validated();
        $service->updateUser($user, $userData);
        $service->changePassword($user, $userData['password']);

        return redirect()->back()->with('success', 'User successfully updated');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User successfully fired');
    }
}
