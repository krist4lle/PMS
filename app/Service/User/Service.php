<?php

namespace App\Service\User;

use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Service
{
    public function avatarSave($data)
    {
        if (isset($data['avatar'])) {
            $data['avatar'] = Storage::disk('local')->put('avatars', $data['avatar']);
        } else {
            $avatar = new File(database_path("avatars/no_avatar/no-avatar.png"));
            $data['avatar'] = Storage::disk('local')->put('avatars', $avatar);
        }

        return $data;
    }

    public function avatarUpdate($data)
    {
        if (isset($data['avatar'])) {
            $oldAvatar = User::query()->where('email', $data['email'])->first()->avatar;
            Storage::disk('local')->delete( $oldAvatar);
            $data['avatar'] = Storage::disk('local')->put('avatars', $data['avatar']);
        }

        return $data;
    }

    public function dataAsigning(mixed $data)
    {
        $data['password'] = Hash::make($data['password']);
        $department = Department::find($data['department_id']);
        $position = Position::find($data['position_id']);
        $parent = User::find($data['parent_id']);

        return [
            'data' => $data,
            'department' => $department,
            'position' => $position,
            'parent' => $parent,
        ];
    }

    public function userCreate(array $completeData)
    {
        $user = new User();
        $user->fill($completeData['data']);
        $user->department()->associate($completeData['department']);
        $user->parent()->associate($completeData['parent']);
        $user->position()->associate($completeData['position']);
        $user->save();
    }

    public function passwordCheck($data)
    {
        if ($data['password'] !== null) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $data;
    }
}
