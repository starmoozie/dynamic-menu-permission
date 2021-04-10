<?php

namespace Starmoozie\DynamicPermission\database\seeds;

use Illuminate\Database\Seeder;

use Starmoozie\DynamicPermission\app\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama' => 'list'
            ],
            [
                'nama' => 'create'
            ],
            [
                'nama' => 'update'
            ],
            [
                'nama' => 'delete'
            ],
            [
                'nama' => 'show'
            ],
            [
                'nama' => 'details_row'
            ],
            [
                'nama' => 'reorder'
            ],
            [
                'nama' => 'export'
            ],
            [
                'nama' => 'print'
            ],
            [
                'nama' => 'personal'
            ]
        ];

        foreach ($data as $value) {
            Permission::updateOrCreate([
                'nama' => $value['nama']
            ], $value);
        }
    }
}
