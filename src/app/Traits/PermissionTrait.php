<?php

namespace Starmoozie\DynamicPermission\app\Traits;

use Starmoozie\DynamicPermission\app\Models\Menu;

/**
 * 
 */
trait PermissionTrait
{
    public function permissionCheck()
    {
        $this->crud->denyAccess(['list', 'create', 'delete', 'update', 'show']); // set default access

        $url        = explode('/', $this->crud->getRoute()); // Get url path
        $url        = end($url); // get last url path
        $menu       = Menu::whereUrl($url)->first();
        $user_menu  = starmoozie_user()->level; // check user level

        if ($menu && $user_menu) {
            // get level menu permission
            $user_menu = $user_menu->menuPermission;

            foreach ($user_menu as $key => $value) {
                $alias = explode('-', $value->alias); // to get menu name and permission name to array
                if (reset($alias) === $menu->nama) {
                    
                    $permission[] = end($alias);
                }
            }

            if (empty(array_intersect(['show', 'delete', 'update'], $permission))) { // if permission haven't button in line, then remove action column
                $this->crud->removeAllButtonsFromStack('line');
            }
        }

        $this->crud->allowAccess($permission ??= []); // Allowed user access by level
    }
}