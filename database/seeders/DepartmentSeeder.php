<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            $department->slug = Str::slug($departmentName, '_');

            $department->save();
        }
    }
}
