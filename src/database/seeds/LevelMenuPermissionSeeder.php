<?php

namespace Starmoozie\DynamicPermission\database\seeds;

use Illuminate\Database\Seeder;

use Starmoozie\DynamicPermission\app\Models\LevelMenuPermission;

class levelMenuPermissionSeeder extends Seeder
{
    private $data = [
        [
            'level_id'           => 1,
            'menu_permission_id' => 1,
        ],
        [
            'level_id'           => 1,
            'menu_permission_id' => 2,
        ],
        [
            'level_id'           => 1,
            'menu_permission_id' => 3,
        ],
        [
            'level_id'           => 1,
            'menu_permission_id' => 4,
        ],
        [
            'level_id'           => 1,
            'menu_permission_id' => 5,
        ],
        [
            'level_id'           => 1,
            'menu_permission_id' => 6,
        ],
        [
            'level_id'           => 1,
            'menu_permission_id' => 7,
        ],
        [
            'level_id'           => 1,
            'menu_permission_id' => 8,
        ],
        [
            'level_id'           => 1,
            'menu_permission_id' => 9,
        ],
        [
            'level_id'           => 1,
            'menu_permission_id' => 10,
        ],
        [
            'level_id'           => 1,
            'menu_permission_id' => 11,
        ],
        [
            'level_id'           => 1,
            'menu_permission_id' => 12,
        ],
        [
            'level_id'           => 1,
            'menu_permission_id' => 13,
        ],
        [
            'level_id'           => 1,
            'menu_permission_id' => 14,
        ],
        [
            'level_id'           => 1,
            'menu_permission_id' => 15,
        ],
        [
            'level_id'           => 1,
            'menu_permission_id' => 16,
        ],
        [
            'level_id'           => 1,
            'menu_permission_id' => 17,
        ],
        [
            'level_id'           => 1,
            'menu_permission_id' => 18,
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
            LevelMenuPermission::updateOrCreate([
                'level_id'           => $value['level_id'],
                'menu_permission_id' => $value['menu_permission_id'],
            ], $value);
        }
    }
}