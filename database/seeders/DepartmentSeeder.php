<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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
            $department->image = $this->uploadImage($departmentName);
            $department->save();
        }
    }

    private function uploadImage(string $departmentName)
    {
        $image = new File(database_path("departments/{$departmentName}.png"));

        return Storage::putFile("departments", $image);
    }


}
