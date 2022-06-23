<?php

namespace Database\Seeders;

use App\Models\Department;
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
        $this->ceo();
        $this->managementPositions();
        $this->designPositions();
        $this->frontendPositions();
        $this->backendPositions();
    }

    private function createPosition(array $positionTitles, Department $department): void
    {
        foreach ($positionTitles as $positionTitle) {
            $position = new Position();
            $position->title = $positionTitle;
            $position->department()->associate($department);
            $position->save();
        }
    }

    private function ceo()
    {
        $ceo = new Position();
        $ceo->title = 'CEO';
        $ceo->save();
    }

    private function managementPositions(): void
    {
        $managementDepartment = Department::where('name', 'Management')->first();
        $managementPositions = [
            'Head of Management Department',
            'Project Manager',
        ];
        $this->createPosition($managementPositions, $managementDepartment);
    }

    private function designPositions(): void
    {
        $designDepartment = Department::where('name', 'Design')->first();
        $designPositions = [
            'Art Director',
            'Graphic Designer',
            'UI/UX Designer',
        ];
        $this->createPosition($designPositions, $designDepartment);
    }

    private function frontendPositions(): void
    {
        $frontendDepartment = Department::where('name', 'Frontend')->first();
        $frontendPositions = [
            'Head of Frontend Department',
            'Frontend Developer',
        ];
        $this->createPosition($frontendPositions, $frontendDepartment);
    }

    private function backendPositions(): void
    {
        $backendDepartment = Department::where('name', 'Backend')->first();
        $backendPositions = [
            'Head of Backend Department',
            'Backend PHP Developer',
            'Backend Node.js Developer',
        ];
        $this->createPosition($backendPositions, $backendDepartment);
    }
}
