## About

- Dynamic Level based on Menu Permission

## Requirement

- laravel 5 - 6

## Install

- Composer

``` bash
composer require starmoozie/dynamic-menu-permission
```

Then add the following line to database/seeds/DatabaseSeeder

``` bash

    ///

    public function run()
    {
        $this->call(\Starmoozie\DynamicPermission\database\seeds\PermissionSeeder::class);
        $this->call(\Starmoozie\DynamicPermission\database\seeds\MenuSeeder::class);
        $this->call(\Starmoozie\DynamicPermission\database\seeds\MenuPermissionSeeder::class);
        $this->call(\Starmoozie\DynamicPermission\database\seeds\LevelSeeder::class);
        $this->call(\Starmoozie\DynamicPermission\database\seeds\LevelMenuPermissionSeeder::class);
        $this->call(\Starmoozie\DynamicPermission\database\seeds\UserSeeder::class);
    }

    ///

```

## User

``` bash

- root@mail.com
  rahasi4dong
- admin@mail.com
  password

```