<?php

namespace Starmoozie\DynamicPermission\app\Http\Controllers\Resources\Columns;

/**
 * 
 */
trait PenggunaColumns
{
    private function setupColumns()
    {
        $this->crud->addColumns([
            [
                'name'  => 'nama',
                'label' => __('dynamic_trans::label.name')
            ],
            [
                'name'  => 'email',
                'label' => __('dynamic_trans::label.email')
            ],
            [
                'name'      => 'level_id',
                'label'     => __('dynamic_trans::label.level'),
                'type'      => 'select',
                'entity'    => 'level',
                'model'     => 'Starmoozie\DynamicPermission\app\Models\Level',
                'attribute' => 'nama'
            ],
        ]);
    }
}
