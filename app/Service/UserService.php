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
        $department = Department::where('name', $userData['department'])->first();
        $position = Position::where('title', $userData['position'])->first();
        $parent = User::query()->where('key', "head{$userData['department']}")->first();
        $this->positionCheck($position, $department);

        $user = new User;
        $user->first_name = $userData['first_name'];
        $user->last_name = $userData['last_name'];
        $user->email = $this->emailCreate($userData['first_name'], $userData['last_name']);
        $user->password = Hash::make($userData['password']);
        $user->avatar = $this->avatarCreate($userData['gender']);
        $user->position()->associate($position);
        $user->department()->associate($department);
        $user->parent()->associate($parent);
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
        $user->save();
    }

    public function changePassword(User $user, string $password): void
    {
        $user->password = Hash::make($password);
        $user->save();
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
}
