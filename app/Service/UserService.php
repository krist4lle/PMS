<?php

namespace App\Service;

use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UserService
{
    public function retrievingEmployees(): array
    {
        $ceo = User::where('key', 'ceo')->first();
        $headManagement = User::where('key', 'headManagement')->first();
        $artDirector = User::where('key', 'headDesign')->first();
        $headFrontend = User::where('key', 'headFrontend')->first();
        $headBackend = User::where('key', 'headBackend')->first();
        $managementEmployees = $headManagement->children;
        $designEmployees = $artDirector->children;
        $frontendEmployees =  $headFrontend->children;
        $backendEmployees = $headBackend->children;

        return [
            'ceo' => $ceo,
            'headManagement' => $headManagement,
            'artDirector' => $artDirector,
            'headFrontend' => $headFrontend,
            'headBackend' => $headBackend,
            'managementEmployees' => $managementEmployees,
            'designEmployees' => $designEmployees,
            'frontendEmployees' => $frontendEmployees,
            'backendEmployees' => $backendEmployees,
        ];
    }

    public function createUser(array $userData): void
    {
        $user = new User;
        $user->first_name = $userData['first_name'];
        $user->last_name = $userData['last_name'];
        $user->email = $this->emailCreate($userData['first_name'], $userData['last_name']);
        $user->password = Hash::make($userData['password']);
        $user->avatar = $this->avatarCreate($userData['gender']);
        $this->departmentRelation($user, $userData['department']);
        $this->positionRelation($user, $userData['position'], $userData['department']);
        $this->parentRelation($user, $userData['department']);
        $user->save();
    }

    public function updateUser(User $user, array $userData): void
    {
        $user->first_name = $userData['first_name'];
        $user->last_name = $userData['last_name'];
        $user->email = $userData['email'];
        if (!empty($userData['avatar'])) {
            $user->avatar = $this->avatarUpdate($user, $userData['avatar']);
        }
        if (!empty($userData['department'])) {
            $this->departmentRelation($user, $userData['department']);
            $this->parentRelation($user, $userData['department']);
        }
        if (!empty($userData['position'])) {
            $this->positionRelation($user, $userData['position'], $userData['department']);
        }
        $user->save();
    }

    public function changePassword(User $user, string|null $password): void
    {
        if ($password !== null) {
            $user->password = Hash::make($password);
            $user->save();
        }
    }

    private function emailCreate(string $firstName, string $lastName): string
    {
        return lcfirst($firstName) . '.' . lcfirst($lastName) . '@pms.test';
    }

    private function avatarCreate(string $gender): string
    {
        $gender = substr($gender, 0, 1);
        $i = rand(1, 8);
        $avatarFile = new File(database_path("avatars/avatar-{$i}-{$gender}.png"));

        return Storage::put('avatars', $avatarFile);
    }

    private function avatarUpdate(User $user, UploadedFile $avatarFile): string
    {
        Storage::delete($user->avatar);

        return Storage::put('avatars', $avatarFile);
    }

    private function positionCheck(Position $position, Department $department): void
    {
        if ($position->department->name !== $department->name) {
            throw ValidationException::withMessages(['This Position does not belong to this Department']);
        }
    }

    private function departmentRelation(User $user, string $departmentName): void
    {
        $department = Department::where('name', $departmentName)->first();
        $user->position()->associate($department);
    }

    private function positionRelation(User $user, string $positionTitle, string $departmentName): void
    {
        $department = Department::where('name', $departmentName)->first();
        $position = Position::where('title', $positionTitle)->first();
        $this->positionCheck($position, $department);
        $user->position()->associate($position);
    }

    private function parentRelation(User $user, string $departmentName): void
    {
        $parent = User::where('key', "head{$departmentName}")->first();
        $user->parent()->associate($parent);
    }
}
