<?php

namespace Starmoozie\DynamicPermission\database\seeds;

use Illuminate\Database\Seeder;

use App\User;

class UserSeeder extends Seeder
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
                'nama'     => 'root',
                'email'    => 'root@mail.com',
                'password' => bcrypt('rahasi4dong'),
                'level_id' => 1
            ],
            [
                'nama'     => 'admin',
                'email'    => 'admin@mail.com',
                'password' => bcrypt('password'),
                'level_id' => null
            ],
        ];

        foreach ($data as $value) {
            User::updateOrCreate([
                'email' => $value['email']
            ], $value);
        }
    }
}
