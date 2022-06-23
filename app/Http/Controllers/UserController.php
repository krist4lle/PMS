<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('position')->paginate(10);

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();

        return view('users.create', [
            'departments' => $departments,
            'positions' => $positions,
        ]);
    }

    public function store(StoreRequest $request, UserService $service)
    {
        $userData = $request->validated();
        $service->createUser($userData);

        return redirect(route('users.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        $departments = Department::all();
        $positions = Position::all();

        return view('users.edit', [
            'user' => $user,
            'departments' => $departments,
            'positions' => $positions,
        ]);
    }

    public function update(User $user, UpdateUserRequest $userRequest, UserService $service)
    {
        $service->updateUser($user, $userRequest->validated());
        $service->changePassword($user, $userRequest['password']);

        return redirect()->back();
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User successfully fired');
    }
}
