<?php

namespace Starmoozie\DynamicPermission\app\Http\Controllers;

use Starmoozie\DynamicPermission\app\Http\Requests\LevelRequest;
use Starmoozie\CRUD\app\Http\Controllers\CrudController;
use Starmoozie\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use Starmoozie\DynamicPermission\app\Models\Level;

/**
 * Class LevelCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Starmoozie\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LevelCrudController extends CrudController
{
    use \Starmoozie\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Starmoozie\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Starmoozie\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Starmoozie\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Starmoozie\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Starmoozie\DynamicPermission\app\Traits\PermissionTrait;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        $label = __('dynamic_trans::label.level');
        CRUD::setModel(Level::class);
        CRUD::setRoute(config('starmoozie.base.route_prefix') . '/level');
        CRUD::setEntityNameStrings($label, $label);
        $this->permissionCheck();
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(LevelRequest::class);

        $this->setupFields();

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    private function setupFields()
    {
        CRUD::addFields([

            [
                'name'       => 'nama',
                'label'      => __('dynamic_trans::label.name'),
                'attributes' => ['required' => 'required', 'pattern' => '[a-z A-Z]+', 'maxlength' => 10],
            ],
            [
                'label'       => __('dynamic_trans::label.permissions'), // Table column heading
                'type'        => "select2_from_ajax_multiple",
                'name'        => 'menuPermission', // a unique identifier (usually the method that defines the relationship in your Model) 
                'entity'      => 'menuPermission', // the method that defines the relationship in your Model
                'attribute'   => "alias", // foreign key attribute that is shown to user
                'data_source' => starmoozie_url("api/menu-permission"), // url to controller search function (with /{id} should return model)
                'pivot'       => true, // on create&update, do you need to add/delete pivot table entries?
                'delay'                => 100, // the minimum amount of time between ajax requests when searching in the field
                'model'                => "Starmoozie\DynamicPermission\app\Models\MenuPermission", // foreign key model
                'placeholder'          => __('dynamic_trans::placeholder.select_permissions'), // placeholder for the select
                'minimum_input_length' => 0,
            ],
        ]);
    }
}
