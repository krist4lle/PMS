<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            'Management',
            'Design',
            'Frontend',
            'Backend',
        ];

        foreach ($departments as $departmentName) {
            $department = new Department();
            $department->name = $departmentName;
            $department->save();
        }
    }
}
