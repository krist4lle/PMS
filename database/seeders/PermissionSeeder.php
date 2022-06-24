<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Permission;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{

    public function run()
    {
        $permissions = [
          'ceo',
          'head',
          'worker',
        ];

        foreach($permissions as $permissionTitle) {
            $permission = new Permission();
            $permission->title = $permissionTitle;
            $permission->save();
        }
    }


}
