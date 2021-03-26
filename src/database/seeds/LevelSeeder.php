<?php

namespace Starmoozie\DynamicPermission\database\seeds;

use Illuminate\Database\Seeder;

use Starmoozie\DynamicPermission\app\Models\Level;

class LevelSeeder extends Seeder
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
                'nama' => 'root'
            ],
            [
                'nama' => 'admin'
            ],
        ];

        foreach ($data as $value) {
            Level::updateOrCreate([
                'nama' => $value['nama']
            ], $value);
        }
    }
}