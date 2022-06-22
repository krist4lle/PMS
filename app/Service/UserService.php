<?php

namespace App\Service;

use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function retrievingEmployees(): array
    {
        $ceo = User::whereRelation('position', 'title', 'CEO')->first();
        $headManagement = User::whereRelation('position', 'title', 'Head of Management Department')->first();
        $artDirector = User::whereRelation('position', 'title', 'Art Director')->first();
        $headFrontend = User::whereRelation('position', 'title', 'Head of Frontend Department')->first();
        $headBackend = User::whereRelation('position', 'title', 'Head of Backend Department')->first();

        $managementEmployees = User::whereRelation('department', 'name', 'Management')
            ->get()
            ->reject(function ($employee) {
                return $employee->position->title === 'Head of Management Department';
            });
        $designEmployees = User::whereRelation('department', 'name', 'Design')
            ->get()
            ->reject(function ($employee) {
                return $employee->position->title === 'Art Director';
            });
        $frontendEmployees = User::whereRelation('department', 'name', 'Frontend')
            ->get()
            ->reject(function ($employee) {
                return $employee->position->title === 'Head of Frontend Department';
            });
        $backendEmployees = User::whereRelation('department', 'name', 'Backend')
            ->get()
            ->reject(function ($employee) {
                return $employee->position->title === 'Head of Backend Department';
            });

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
        $user->password = $this->passwordHash($password);
        $user->save();
    }

    private function passwordHash(string $password): string
    {
        return Hash::make($password);
    }

    private function avatarUpdate(User $user, UploadedFile $avatarFile): string
    {
        Storage::delete($user->avatar);

        return Storage::put('avatars', $avatarFile);
    }
}
