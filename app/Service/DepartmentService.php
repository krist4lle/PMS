<?php

namespace App\Service;

use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DepartmentService
{
    public function departmentSave(Department $department, string $departmentName)
    {
        $department->loadCount('users');
        if ($department->users_count > 0) {

            return redirect(route('departments.index'))
                ->with('errorMessage', 'Impossible to edit Department with employees');
        }
        $department->name = $departmentName;

        $department->save();
    }

    public function departmentDelete(Department $department)
    {
        $department->loadCount('users');
        if ($department->users_count > 0) {

            return redirect(route('departments.index'))
                ->with('errorMessage', 'Impossible to delete Department with employees');
        }
        $department->delete();
    }
}
