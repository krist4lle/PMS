<?php

namespace App\Service;

use App\Mail\User\PasswordMail;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        $frontendEmployees = $headFrontend->children;
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
        $this->relations($user, $userData['position'], $userData['department'], $userData['parent']);
        $user->save();
        Mail::to($user->email)->send(new PasswordMail($userData['password']));
    }

    public function updateUser(User $user, array $userData): void
    {
        $user->first_name = $userData['first_name'];
        $user->last_name = $userData['last_name'];
        $user->email = $userData['email'];
        if (isset($userData['avatar'])) {
            $this->avatarUpdate($user, $userData['avatar']);
        }
        if (isset($userData['position'])) {
            $this->relations($user, $userData['position'], $userData['department'], $userData['parent']);
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

    private function avatarUpdate(User $user, UploadedFile $avatarFile): void
    {
        Storage::delete($user->avatar);
        $user->avatar = Storage::put('avatars', $avatarFile);
    }

    private function relations(User $user, string $positionTitle, string|null $departmentName, string|null $parentPosition): void
    {
        $position = Position::where('title', $positionTitle)->first();
        $department = Department::where('name', $departmentName)->first();
        $parent = User::whereRelation('position', 'title', $parentPosition)->first();
        $this->positionHasDepartment($user, $position, $department, $parent);
        $this->positionHasNotDepartment($user, $position, $department, $parent);

    }

    private function positionHasDepartment(User $user, Position $position, Department|null $department, User|null $parent): void
    {
        if (isset($position->department)) {
            $this->departmentRequired($department);
            $this->positionCheck($position, $department);
            $this->parentRequired($parent);
            $this->parentCheck($parent, $department);
            $user->position()->associate($position);
            $user->department()->associate($department);
            $user->parent()->associate($parent);
        }
    }

    private function positionHasNotDepartment(User $user, Position $position, Department|null $department, User|null $parent): void
    {
        if (empty($position->department)) {
            $this->departmentNotRequired($department);
            $user->department()->dissociate();
            $user->position()->associate($position);
            $this->parentRelation($user, $parent);
        }
    }

    private function positionCheck(Position $position, Department $department): void
    {
        if ($position->department->name !== $department->name) {
            throw ValidationException::withMessages(['This Position does not belong to this Department']);
        }
    }

    private function departmentRequired(Department|null $department): void
    {
        if ($department === null) {
            throw ValidationException::withMessages(['This Position required a Department']);
        }
    }

    private function departmentNotRequired(Department|null $department): void
    {
        if ($department !== null) {
            throw ValidationException::withMessages(['This Position does not require any Department']);
        }
    }

    private function parentRequired(User|null $parent): void
    {
        if ($parent === null) {
            throw ValidationException::withMessages(['This Position required a Supervisor']);
        }
    }

    private function parentCheck(User $parent, Department $department): void
    {
        if (empty($parent->position->department) || $parent->position->department->name !== $department->name) {
            throw ValidationException::withMessages(['This Supervisor does not belong to this Department']);
        }
    }

    private function parentRelation(User $user, User|null $parent): void
    {
        if ($parent !== null) {
            $user->parent()->associate($parent);
        }
        $user->parent()->dissociate();
    }
}
