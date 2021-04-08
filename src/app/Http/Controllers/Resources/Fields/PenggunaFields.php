<?php

namespace Starmoozie\DynamicPermission\app\Http\Controllers\Resources\Fields;

/**
 * 
 */
trait PenggunaFields
{
    private function setupFields()
    {
        $this->crud->addFields([
            [
                'name'  => 'nama',
                'label' => __('dynamic_trans::label.name'),
                'wrapper'    => ['class' => 'form-group col-md-4'],
                'attributes' => ['required' => 'required', 'pattern' => '[a-z A-Z]+', 'maxlength' => 50]
            ],
            [
                'name'  => 'email',
                'label' => __('dynamic_trans::label.email'),
                'type'  => 'email',
                'wrapper'    => ['class' => 'form-group col-md-4'],
                'attributes' => ['required' => 'required', 'maxlength' => 40]
            ],
            [
                'name'  => 'nip',
                'label' => __('dynamic_trans::label.nip'),
                'wrapper'    => ['class' => 'form-group col-md-4'],
                'attributes' => ['required' => 'required', 'maxlength' => 30]
            ],
            [
                'name'  => 'password',
                'label' => __('dynamic_trans::label.password'),
                'type'  => 'password',
                'wrapper'    => ['class' => 'form-group col-md-4'],
            ],
            [
                'name'  => 'password_confirmation',
                'label' => __('dynamic_trans::label.password_confirmation'),
                'type'  => 'password',
                'wrapper'    => ['class' => 'form-group col-md-4'],
            ],
            [
                'name'      => 'level_id',
                'label'     => __('dynamic_trans::label.level'),
                'type'      => 'select2',
                'entity'    => 'level',
                'attribute' => 'nama',
                'model'     => 'Starmoozie\DynamicPermission\app\Models\Level',
                'attributes' => ['required' => 'required'],
                'wrapper'    => ['class' => 'form-group col-md-4'],
            ]
        ]);
    }
}
