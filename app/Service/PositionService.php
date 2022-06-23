<?php

namespace App\Service;

use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PositionService
{
    public function positionSave(Position $position, array $positionData)
    {
        $position->title = $positionData['title'];
        $department = $this->departmentForPosition($positionData['department_name']);
        $position->department()->associate($department);
        $position->save();
    }

    public function positionDelete(Position $position)
    {
        $position->loadCount('users');
        if ($position->users_count > 0) {

            return redirect(route('departments.index'))
                ->with('errorMessage', 'Impossible to delete Position with employees');
        }
        $position->delete();
    }

    private function departmentForPosition(string $departmentName): Department
    {
        return Department::where('name', $departmentName)->first();
    }
}
