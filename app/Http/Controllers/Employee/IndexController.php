<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('employees.index', $this->employees());
    }

    public function profile(User $user)
    {
        return view('employees.profile', [
            'user' => $user,
        ]);
    }

    public function employees(): array
    {
        $ceo = User::whereRelation('position', 'title', 'CEO')->first();
        $headManagement = User::whereRelation('position', 'title', 'Head of Management Department')->first();
        $artDirector = User::whereRelation('position', 'title', 'Art Director')->first();
        $headFrontend = User::whereRelation('position', 'title', 'Head of Frontend Department')->first();
        $headBackend = User::whereRelation('position', 'title', 'Head of Backend Department')->first();

        $managementEmployees = User::whereRelation('department', 'name', 'Management')
            ->get()
            ->reject(function ($employee) {
                return $employee->position->title === 'Head of Management Department';
            });
        $designEmployees = User::whereRelation('department', 'name', 'Design')
            ->get()
            ->reject(function ($employee) {
                return $employee->position->title === 'Art Director';
            });
        $frontendEmployees = User::whereRelation('department', 'name', 'Frontend')
            ->get()
            ->reject(function ($employee) {
                return $employee->position->title === 'Head of Frontend Department';
            });
        $backendEmployees = User::whereRelation('department', 'name', 'Backend')
            ->get()
            ->reject(function ($employee) {
                return $employee->position->title === 'Head of Backend Department';
            });

        return [
            'ceo' => $ceo,
            'headManagement' => $headManagement,
            'artDirector' => $artDirector,
            'headFrontend' => $headFrontend,
            'headBackend' => $headBackend,
            'managementEmployees' => $managementEmployees,
            'designEmployees' => $designEmployees,
            'frontendEmployees' => $frontendEmployees,
            'backendEmployees' => $backendEmployees,
        ];
    }
}
