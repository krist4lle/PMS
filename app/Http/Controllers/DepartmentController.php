<?php

namespace App\Http\Controllers;

use App\Exceptions\DepartmentNotEmptyException;
use App\Http\Requests\Department\UpdateRequest;
use App\Models\Department;
use App\Service\DepartmentService;

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
        $this->authorize('update', $department);

        return view('departments.edit', [
            'department' => $department
        ]);
    }

    public function update(UpdateRequest $request, Department $department, DepartmentService $service)
    {
        $this->authorize('update', $department);
        $dataName = $request->validated();

        try {
            $service->departmentSave($department, $dataName['name']);
        } catch (DepartmentNotEmptyException $exception) {

            return redirect(route('departments.index'))
                ->with('errorMessage', 'Impossible to edit Department with employees');
        }

        return redirect(route('departments.index'));
    }

    public function destroy(Department $department, DepartmentService $service)
    {
        $this->authorize('delete', $department);
        $service->departmentDelete($department);

        return redirect(route('departments.index'));
    }
}
