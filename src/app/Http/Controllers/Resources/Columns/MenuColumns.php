<?php

namespace Starmoozie\DynamicPermission\app\Http\Controllers\Resources\Columns;

/**
 * 
 */
trait MenuColumns
{

    private function setupColumns()
    {
        $this->crud->addColumns([
            [
                'name'      => 'parent_id',
                'label'     => __('dynamic_trans::label.parent'),
                'type'      => 'select',
                'entity'    => 'parent',
                'model'     => 'Stamoozie\DynamicPermission\app\Models\Menu',
                'attribute' => 'nama'
            ],
            [
                'name'  => 'nama',
                'label' => __('dynamic_trans::label.name')
            ],
            [
                'name'  => 'url',
                'label' => __('dynamic_trans::label.route')
            ],
            [
                'name'  => 'for_backend',
                'label' => __('dynamic_trans::label.backend'),
                'type'  => 'boolean'
            ],
        ]);
    }
}
