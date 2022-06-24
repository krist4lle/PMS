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
        $this->authorize('viewAny', [User::class]);
        $user = auth()->user();
        $user->key === 'ceo'
            ? $users = User::with(['position', 'department', 'parent'])
            ->whereHas('parent')
            ->paginate(10)
            : $users = User::with(['position', 'department', 'parent'])
            ->whereRelation('parent', 'key', $user->key)
            ->paginate(10);

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $this->authorize('create', [User::class]);
        $user = auth()->user();
        $user->key === 'ceo'
            ? $departments = Department::all()
            : $departments = Department::whereRelation('users', 'department_id', $user->department->id)->get();
        $user->key === 'ceo'
            ? $positions = Position::all()
            : $positions = Position::whereRelation('department', 'name', $user->department->name)->get();

        return view('users.create', [
            'departments' => $departments,
            'positions' => $positions,
            'user' => $user,
        ]);
    }

    public function store(StoreRequest $request, UserService $service)
    {
        $this->authorize('create', [User::class]);
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
        $this->authorize('update', [User::class, $user]);
        $user->key === 'ceo'
            ? $departments = Department::all()
            : $departments = Department::whereRelation('users', 'department_id', $user->department->id)->get();
        $user->key === 'ceo'
            ? $positions = Position::all()
            : $positions = Position::whereRelation('department', 'name', $user->department->name)->get();

        return view('users.edit', [
            'user' => $user,
            'departments' => $departments,
            'positions' => $positions,
        ]);
    }

    public function update(User $user, UpdateUserRequest $userRequest, UserService $service)
    {
        $this->authorize('update', [User::class, $user]);
        $service->updateUser($user, $userRequest->validated());
        $service->changePassword($user, $userRequest['password']);

        return redirect()->back()->with('success', 'User successfully updated');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', [User::class, $user]);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User successfully fired');
    }
}
