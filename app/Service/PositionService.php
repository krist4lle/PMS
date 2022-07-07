<?php

namespace App\Service;

use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class PositionService
{
    public function positionSave(Position $position, array $positionData): void
    {
        $position->title = $positionData['title'];
        $this->departmentCheck($positionData['department'], $position);
        $position->save();
    }

    public function positionDelete(Position $position)
    {
        $position->loadCount('users');
        if ($position->users_count > 0) {

            throw ValidationException::withMessages(['errorMessage' => 'Impossible to delete Position with employees']);
        }
        $position->delete();
    }

    private function departmentCheck(string|null $departmentSlug, Position $position): void
    {
        $department = Department::where('slug', $departmentSlug)->first();
        $department !== null
            ? $position->department()->associate($department)
            : $position->department()->dissociate();
    }
}
