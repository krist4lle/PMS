<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Permission;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCeo();
        $this->headManagement();
        $this->headDesign();
        $this->headFrontend();
        $this->headBackend();
        $this->managementPositions();
        $this->designPositions();
        $this->frontendPositions();
        $this->backendPositions();
    }

    private function createPosition(array $positionTitles, Department $department): void
    {
        $permission = Permission::where('title', 'worker')->first();

        foreach ($positionTitles as $positionTitle) {
            $position = new Position();
            $position->title = $positionTitle;
            $position->department()->associate($department);
            $position->permission()->associate($permission);
            $position->save();
        }
    }

    private function createCeo(): void
    {
        $permission = Permission::where('title', 'ceo')->first();
        $ceo = new Position();
        $ceo->title = 'CEO';
        $ceo->permission()->associate($permission);
        $ceo->save();
    }

    private function headPermission(): Permission
    {
        return Permission::where('title', 'head')->first();
    }

    private function managementDepartment(): Department
    {
        return Department::where('name', 'Management')->first();
    }

    private function designDepartment(): Department
    {
        return Department::where('name', 'Design')->first();
    }

    private function frontendDepartment(): Department
    {
        return Department::where('name', 'Frontend')->first();
    }

    private function backendDepartment(): Department
    {
        return Department::where('name', 'Backend')->first();
    }

    private function headManagement()
    {
        $headManagement = new Position();
        $headManagement->title = 'Head of Management Department';
        $headManagement->permission()->associate($this->headPermission());
        $headManagement->department()->associate($this->managementDepartment());
        $headManagement->save();
    }

    private function headDesign()
    {
        $headDesign = new Position();
        $headDesign->title = 'Art Director';
        $headDesign->permission()->associate($this->headPermission());
        $headDesign->department()->associate($this->designDepartment());
        $headDesign->save();
    }

    private function headFrontend()
    {
        $headFrontend = new Position();
        $headFrontend->title = 'Head of Frontend Department';
        $headFrontend->permission()->associate($this->headPermission());
        $headFrontend->department()->associate($this->frontendDepartment());
        $headFrontend->save();
    }

    private function headBackend()
    {
        $headBackend = new Position();
        $headBackend->title =  'Head of Backend Department';
        $headBackend->permission()->associate($this->headPermission());
        $headBackend->department()->associate($this->backendDepartment());
        $headBackend->save();
    }

    private function managementPositions(): void
    {
        $managementPositions = [
            'Project Manager',
        ];
        $this->createPosition($managementPositions, $this->managementDepartment());
    }

    private function designPositions(): void
    {
        $designPositions = [
            'Graphic Designer',
            'UI/UX Designer',
        ];
        $this->createPosition($designPositions, $this->designDepartment());
    }

    private function frontendPositions(): void
    {
        $frontendPositions = [
            'Frontend Developer',
        ];
        $this->createPosition($frontendPositions, $this->frontendDepartment());
    }

    private function backendPositions(): void
    {
        $backendPositions = [
            'Backend PHP Developer',
            'Backend Node.js Developer',
        ];
        $this->createPosition($backendPositions, $this->backendDepartment());
    }
}
