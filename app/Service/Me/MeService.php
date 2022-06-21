<?php

namespace App\Service\Me;

use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MeService
{
    public function nullCheck(array $userChanges)
    {
        if (in_array(null, $userChanges, true) === true) {
            foreach ($userChanges as $field => $userChange) {
                if ($userChange === null) {
                    unset($userChanges[$field]);
                }
            }
        }

        return $userChanges;
    }

    public function passwordHash(string $password)
    {
        return Hash::make($password);
    }

    public function avatarUpdate(UploadedFile $avatarFile)
    {
        Storage::delete(auth()->user()->avatar);

        return Storage::put('avatars', $avatarFile);
    }
}
