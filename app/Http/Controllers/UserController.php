<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Database\Eloquent\Builder;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['position', 'department', 'parent'])->paginate(10);

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        $parents = User::whereHas('children')->get();

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

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        $departments = Department::all();
        $positions = Position::all();
        $parents = User::whereHas('children')->get();

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
