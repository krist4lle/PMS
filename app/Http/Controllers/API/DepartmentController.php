<?php

namespace App\Http\Controllers\API;

use App\Exceptions\DepartmentNotEmptyException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Department\UpdateRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Service\DepartmentService;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::withCount('users')->get();

        return DepartmentResource::collection($departments);
    }

    public function update(UpdateRequest $request, Department $department, DepartmentService $service)
    {
        $department->loadCount('users');
        $this->authorize('update', $department);
        $dataName = $request->validated();

        try {
            $service->departmentSave($department, $dataName['name']);
        } catch (DepartmentNotEmptyException $exception) {

            return response()->json([
                'error' => [
                    'code' => $exception->getCode(),
                    'message' => $exception->getMessage(),
                ],
            ], 400);
        }

        return new DepartmentResource($department);
    }

    public function destroy(Department $department, DepartmentService $service)
    {
        $this->authorize('delete', $department);
        try {
            $service->departmentDelete($department);
        } catch (DepartmentNotEmptyException $exception) {

            return response()->json([
                'error' => [
                    'code' => $exception->getCode(),
                    'message' => $exception->getMessage(),
                ],
            ], 400);
        }

        return response()->json([
            'success' => true,
        ]);
    }
}
