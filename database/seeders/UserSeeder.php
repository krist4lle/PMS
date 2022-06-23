<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Faker\Factory as FakerFactory;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = FakerFactory::create();
    }

    public function run()
    {
        $ceo = $this->createCEO();
        $headManagement = $this->createHeadOfManagementDepartment($ceo);
        $artDirector = $this->createArtDirector($ceo);
        $headFrontend = $this->createHeadOfFrontendDepartment($ceo);
        $headBackend = $this->createHeadOfBackendDepartment($ceo);
        $this->createProjectManagers($headManagement);
        $this->createDesigners($artDirector);
        $this->createFrontendDevelopers($headFrontend);
        $this->createBackendDevelopers($headBackend);
    }

    private function uploadAvatar($gender = null)
    {
        if ($gender === null) {
            $gender = $this->faker->randomElement(['m', 'f']);
        }
        $i = $this->faker->numberBetween(1, 8);
        $avatar = new File(database_path("avatars/avatar-{$i}-{$gender}.png"));

        return Storage::putFile("avatars", $avatar);
    }

    private function createUser($data, $position, $parent = null, $department = null)
    {
        $position = Position::where('title', $position)->first();
        $department = Department::where('name', $department)->first();

        $user = new User();
        $user->fill($data);
        $user->department()->associate($department);
        $user->parent()->associate($parent);
        $user->position()->associate($position);
        $user->save();

        return $user;
    }

    private function randomUserData()
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        $firstName = $this->faker->firstName($gender);
        $lastName = $this->faker->lastName();
        $email = Str::lower("{$firstName}.{$lastName}@pms.test");

        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => Hash::make('qwe123'),
            'avatar' => $this->uploadAvatar($gender[0]),
        ];
    }

    private function createCEO()
    {
        $data = [
            'first_name' => 'Oleksandr',
            'last_name' => 'Kuznietsov',
            'email' => 'alex.krist4lle@pms.test',
            'email_verified_at' => now(),
            'password' => Hash::make('qwe123'),
            'avatar' => $this->uploadAvatar('m'),
            'key' => 'ceo',
        ];

        return $this->createUser($data, 'CEO');
    }

    private function createHeadOfManagementDepartment($parent)
    {
        $data = [
            'first_name' => 'Vitalik',
            'last_name' => 'S2pac',
            'email' => 'vs@pms.test',
            'email_verified_at' => now(),
            'password' => Hash::make('qwe123'),
            'avatar' => $this->uploadAvatar('m'),
            'key' => 'headManagement',
        ];

        return $this->createUser($data, 'Head of Management Department', $parent, 'Management');
    }

    private function createArtDirector($parent)
    {
        $data = [
            'first_name' => 'Vadim',
            'last_name' => 'Kassik',
            'email' => 'kassik@pms.test',
            'email_verified_at' => now(),
            'password' => Hash::make('qwe123'),
            'avatar' => $this->uploadAvatar('m'),
            'key' => 'headDesign',
        ];

        return $this->createUser($data, 'Art Director', $parent, 'Design');
    }

    private function createHeadOfFrontendDepartment($parent)
    {
        $data = [
            'first_name' => 'Artem',
            'last_name' => 'Zubr',
            'email' => 'tom@pms.test',
            'email_verified_at' => now(),
            'password' => Hash::make('qwe123'),
            'avatar' => $this->uploadAvatar('m'),
            'key' => 'headFrontend',
        ];

        return $this->createUser($data, 'Head of Frontend Department', $parent, 'Frontend');
    }

    private function createHeadOfBackendDepartment($parent)
    {
        $data = [
            'first_name' => 'Andrew',
            'last_name' => 'Polisoprano',
            'email' => 'soprano@pms.test',
            'email_verified_at' => now(),
            'password' => Hash::make('qwe123'),
            'avatar' => $this->uploadAvatar('m'),
            'key' => 'headBackend',
        ];

        return $this->createUser($data, 'Head of Backend Department', $parent, 'Backend');
    }

    private function createProjectManagers($parent)
    {
        for ($i = 0; $i < 8; $i++) {
            $data = $this->randomUserData();
            $this->createUser($data, 'Project Manager', $parent, 'Management');
        }
    }

    private function createDesigners($parent)
    {
        for ($i = 0; $i < 2; $i++) {
            $data = $this->randomUserData();
            $this->createUser($data, 'Graphic Designer', $parent, 'Design');
        }

        for ($i = 0; $i < 3; $i++) {
            $data = $this->randomUserData();
            $this->createUser($data, 'UI/UX Designer', $parent, 'Design');
        }
    }

    private function createFrontendDevelopers($parent)
    {
        for ($i = 0; $i < 6; $i++) {
            $data = $this->randomUserData();
            $this->createUser($data, 'Frontend Developer', $parent, 'Frontend');
        }
    }

    private function createBackendDevelopers($parent)
    {
        for ($i = 0; $i < 4; $i++) {
            $data = $this->randomUserData();
            $this->createUser($data, 'Backend PHP Developer', $parent, 'Backend');
        }

        for ($i = 0; $i < 2; $i++) {
            $data = $this->randomUserData();
            $this->createUser($data, 'Backend Node.js Developer', $parent, 'Backend');
        }
    }

}
