<?php

Route::group([
    'prefix'     => config('starmoozie.base.route_prefix', 'admin'),
    'namespace'  => 'Starmoozie\DynamicPermission\app\Http\Controllers',
    'middleware' => array_merge(
        (array) config('starmoozie.base.web_middleware', 'web'),
        (array) config('starmoozie.base.middleware_key', 'admin')
    ),
], function () {
    Route::crud('menu', 'MenuCrudController');
    Route::crud('pengguna', 'PenggunaCrudController');
    Route::crud('permission', 'PermissionCrudController');
    Route::crud('level', 'LevelCrudController');
    
    Route::get('api/permission', 'Api\ApiController@permission');
    Route::get('api/menu-permission', 'Api\ApiController@menuPermission');
});