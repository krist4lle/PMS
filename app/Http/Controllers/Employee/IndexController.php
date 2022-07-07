<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(UserService $service)
    {
        $employees = $service->retrievingEmployees();

        return view('employees.index', $employees);
    }

    public function profile(User $user)
    {
        $user->load(['position', 'department']);

        return view('employees.profile', [
            'user' => $user,
        ]);
    }
}
