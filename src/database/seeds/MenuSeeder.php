<?php

namespace Starmoozie\DynamicPermission\database\seeds;

use Illuminate\Database\Seeder;

use Starmoozie\DynamicPermission\app\Models\Menu;

class MenuSeeder extends Seeder
{
    private $menu = [
        [
            'nama'        => 'pengaturan aplikasi',
            'for_backend' => 1,
            'url'         => '#',
            'parent_id'   => null,
            'lft'         => null,
            'rgt'         => null,
            'depth'       => null
        ],
        [
            'nama'        => 'manajemen pengguna',
            'for_backend' => 1,
            'url'         => '#',
            'parent_id'   => null,
            'lft'         => null,
            'rgt'         => null,
            'depth'       => null
        ],
        [
            'nama'        => 'permission',
            'for_backend' => 1,
            'url'         => 'permission',
            'parent_id'   => 1,
            'lft'         => null,
            'rgt'         => null,
            'depth'       => null
        ],
        [
            'nama'        => 'menu',
            'for_backend' => 1,
            'url'         => 'menu',
            'parent_id'   => 1,
            'lft'         => null,
            'rgt'         => null,
            'depth'       => null
        ],
        [
            'nama'        => 'level',
            'for_backend' => 1,
            'url'         => 'level',
            'parent_id'   => 2,
            'lft'         => null,
            'rgt'         => null,
            'depth'       => null
        ],
        [
            'nama'        => 'pengguna',
            'for_backend' => 1,
            'url'         => 'pengguna',
            'parent_id'   => 2,
            'lft'         => null,
            'rgt'         => null,
            'depth'       => null
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->menu as $value) {
            $menu = Menu::updateOrCreate([
                'nama'        => $value['nama'],
                'for_backend' => $value['for_backend'],
                'url'         => $value['url'],
                'parent_id'   => $value['parent_id']
            ], $value);
        }
    }
}
