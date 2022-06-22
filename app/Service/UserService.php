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
