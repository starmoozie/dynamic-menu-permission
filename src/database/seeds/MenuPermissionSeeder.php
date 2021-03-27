<?php

namespace Starmoozie\DynamicPermission\database\seeds;

use Illuminate\Database\Seeder;

use Starmoozie\DynamicPermission\app\Models\MenuPermission;

class MenuPermissionSeeder extends Seeder
{
    private $data = [
        [
            'menu_id'       => 1,
            'permission_id' => 1,
            'alias'         => 'Setting-list'
        ],
        [
            'menu_id'       => 2,
            'permission_id' => 1,
            'alias'         => 'User Management-list'
        ],
        [
            'menu_id'       => 3,
            'permission_id' => 1,
            'alias'         => 'Permission-list'
        ],
        [
            'menu_id'       => 3,
            'permission_id' => 2,
            'alias'         => 'Permission-create'
        ],
        [
            'menu_id'       => 3,
            'permission_id' => 3,
            'alias'         => 'Permission-update'
        ],
        [
            'menu_id'       => 3,
            'permission_id' => 4,
            'alias'         => 'Permission-delete'
        ],
        [
            'menu_id'       => 4,
            'permission_id' => 1,
            'alias'         => 'Menu-list'
        ],
        [
            'menu_id'       => 4,
            'permission_id' => 2,
            'alias'         => 'Menu-create'
        ],
        [
            'menu_id'       => 4,
            'permission_id' => 3,
            'alias'         => 'Menu-update'
        ],
        [
            'menu_id'       => 4,
            'permission_id' => 4,
            'alias'         => 'Menu-delete'
        ],
        [
            'menu_id'       => 5,
            'permission_id' => 1,
            'alias'         => 'Level-list'
        ],
        [
            'menu_id'       => 5,
            'permission_id' => 2,
            'alias'         => 'Level-create'
        ],
        [
            'menu_id'       => 5,
            'permission_id' => 3,
            'alias'         => 'Level-update'
        ],
        [
            'menu_id'       => 5,
            'permission_id' => 4,
            'alias'         => 'Level-delete'
        ],
        [
            'menu_id'       => 6,
            'permission_id' => 1,
            'alias'         => 'Pengguna-list'
        ],
        [
            'menu_id'       => 6,
            'permission_id' => 2,
            'alias'         => 'Pengguna-create'
        ],
        [
            'menu_id'       => 6,
            'permission_id' => 3,
            'alias'         => 'Pengguna-update'
        ],
        [
            'menu_id'       => 6,
            'permission_id' => 4,
            'alias'         => 'Pengguna-delete'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $value) {
            MenuPermission::updateOrCreate([
                'menu_id'       => $value['menu_id'],
                'permission_id' => $value['permission_id'],
                'alias'         => $value['alias'],
            ], $value);
        }
    }
}