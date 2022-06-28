<?php

namespace App\Http\Controllers;

use App\Http\Requests\Department\UpdateRequest;
use App\Models\Department;
use App\Service\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::withCount('users')->get();

        return view('departments.index', [
            'departments' => $departments,
        ]);
    }

    public function edit(Department $department)
    {
        return view('departments.edit', [
            'department' => $department
        ]);
    }

    public function update(UpdateRequest $request, Department $department, DepartmentService $service)
    {
        $dataName = $request->validated();
        $service->departmentSave($department, $dataName['name']);

        return redirect(route('departments.index'));
    }

    public function destroy(Department $department, DepartmentService $service)
    {
        $service->departmentDelete($department);

        return redirect(route('departments.index'));
    }
}
