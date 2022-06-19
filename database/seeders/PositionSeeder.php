<?php

namespace Database\Seeders;

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
        $positions = [
            'CEO',
            'Head Management of Department',
            'Art Director',
            'Head Frontend of Department',
            'Head Backend of Department',
            'Project Manager',
            'Graphic Designer',
            'UI/UX Designer',
            'Frontend Developer',
            'Backend PHP Developer',
            'Backend Node.js Developer',
        ];

        foreach ($positions as $positionTitle) {
            $position = new Position();
            $position->title = $positionTitle;
            $position->save();
        }
    }
}
