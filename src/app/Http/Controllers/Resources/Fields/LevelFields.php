<?php

namespace Starmoozie\DynamicPermission\app\Http\Controllers\Resources\Fields;

/**
 * 
 */
trait LevelFields
{

    private function setupFields()
    {
        $this->crud->addFields([

            [
                'name'       => 'nama',
                'label'      => __('dynamic_trans::label.name'),
                'attributes' => ['required' => 'required', 'pattern' => '[a-z A-Z]+', 'maxlength' => 15],
            ],
            [
                'label'                => __('dynamic_trans::label.permissions'), // Table column heading
                'type'                 => "select2_from_ajax_multiple",
                'name'                 => 'menuPermission', // the method that defines the relationship in Model 
                'entity'               => 'menuPermission', // the method that defines the relationship in Model
                'attribute'            => "alias", // foreign key attribute that is shown to user
                'data_source'          => starmoozie_url("api/menu-permission"), // url to controller search function (with /{id} should return model)
                'pivot'                => true, // on create&update, do you need to add/delete pivot table entries?
                'delay'                => 100, // the minimum amount of time between ajax requests when searching in the field
                'model'                => "Starmoozie\DynamicPermission\app\Models\MenuPermission", // foreign key model
                'placeholder'          => __('dynamic_trans::placeholder.select_permissions'), // placeholder for the select
                'minimum_input_length' => 0,
            ],
        ]);
    }
}
