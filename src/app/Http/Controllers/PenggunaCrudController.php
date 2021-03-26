<?php

namespace Starmoozie\DynamicPermission\app\Http\Controllers;

use Starmoozie\DynamicPermission\app\Http\Requests\UserRequest;
use Starmoozie\CRUD\app\Http\Controllers\CrudController;
use Starmoozie\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use App\User;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Starmoozie\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PenggunaCrudController extends CrudController
{
    use \Starmoozie\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Starmoozie\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Starmoozie\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Starmoozie\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Starmoozie\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Starmoozie\CRUD\app\Http\Controllers\Operations\FetchOperation;
    use \Starmoozie\DynamicPermission\app\Traits\PermissionTrait;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        $label = __('dynamic_trans::label.user');
        CRUD::setModel(User::class);
        CRUD::setRoute(config('starmoozie.base.route_prefix') . '/pengguna');
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
        // $this->apiMenuPermission();
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
        CRUD::setValidation(UserRequest::class);
        // dd(CRUD::getRequest()->all());

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
                'name'  => 'nama',
                'label' => __('dynamic_trans::label.name')
            ],
            [
                'name'      => 'level_id',
                'label'     => __('dynamic_trans::label.level'),
                'type'      => 'select2',
                'entity'    => 'level',
                'attribute' => 'nama',
                'model'     => 'Starmoozie\DynamicPermission\app\Models\Level'
            ]
        ]);
    }
}
