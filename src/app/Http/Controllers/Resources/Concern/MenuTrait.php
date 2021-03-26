<?php

namespace Starmoozie\DynamicPermission\app\Http\Controllers\Resources\Concern;

use Starmoozie\DynamicPermission\app\Models\Permission;

/**
 * 
 */
trait MenuTrait
{

    private function updatePivot()
    {
        $entry      = $this->crud->entry;
        $permission = Permission::selectIdNama($this->crud->getRequest()->permission)->get();

        foreach ($permission as $key => $value) {
            $pivot[$value->id] = ['alias' => $entry->nama.'-'.$value->nama];
        }

        return $entry->permission()->sync($pivot);
    }
}
