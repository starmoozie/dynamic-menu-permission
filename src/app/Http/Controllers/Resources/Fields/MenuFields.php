<?php

namespace Starmoozie\DynamicPermission\app\Http\Controllers\Resources\Fields;

/**
 * 
 */
trait MenuFields
{

    private function setupFields()
    {
        $this->crud->addFields([
            [
                'name'       => 'nama',
                'label'      => __('dynamic_trans::label.name'),
                'wrapper'    => ['class' => 'form-group col-md-4'],
                'attributes' => ['required' => 'required', 'pattern' => '[a-z A-Z]+', 'maxlength' => 10]
            ],
            [
                'name'                 => 'parent_id',
                'label'                => __('dynamic_trans::label.parent'),
                'wrapper'              => ['class' => 'form-group col-md-4'],
                'type'                 => 'select2_from_ajax',
                'entity'               => 'parent',
                'attribute'            => "nama",
                'data_source'          => starmoozie_url("api/menu-parent"),
                'placeholder'          => __('dynamic_trans::placeholder.select_parent'),
                'minimum_input_length' => 0,
                'hint'                 => __('dynamic_trans::hint.parent_menu')
            ],
            [
                'name'       => 'url',
                'label'      => __('dynamic_trans::label.route'),
                'wrapper'    => ['class' => 'form-group col-md-4'],
                'attributes' => ['required' => 'required', 'pattern' => '[a-z#]+', 'maxlength' => 20],
                'hint'       => __('dynamic_trans::hint.route_menu')
            ],
            [
                'label'                => __('dynamic_trans::label.permissions'),
                'type'                 => "select2_from_ajax_multiple",
                'name'                 => 'permission', 
                'entity'               => 'permission',
                'attribute'            => "nama",
                'data_source'          => starmoozie_url("api/permission"),
                'pivot'                => true,
                'model'                => "Starmoozie\DynamicPermission\app\Models\Permission",
                'placeholder'          => __('dynamic_trans::placeholder.select_permissions'),
                'minimum_input_length' => 0,
            ],
            [
                'name'    => 'for_backend',
                'label'   => __('dynamic_trans::label.menu_for'),
                'type'    => 'radio',
                'options' => [
                    0 => __('dynamic_trans::label.frontend'),
                    1 => __('dynamic_trans::label.backend')
                ],
                'default' => 1,
                'inline'  => true,
                'wrapper' => ['class' => 'form-group col-md-6'],
            ]
        ]);
    }
}
