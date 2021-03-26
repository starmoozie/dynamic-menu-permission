<?php

namespace Starmoozie\DynamicPermission\app\Http\Controllers;

use Starmoozie\DynamicPermission\app\Http\Requests\MenuRequest as Request;
use Starmoozie\CRUD\app\Http\Controllers\CrudController;
use Starmoozie\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use Starmoozie\DynamicPermission\app\Models\Menu;

/**
 * Class MenuCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Starmoozie\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MenuCrudController extends CrudController
{
    use \Starmoozie\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Starmoozie\CRUD\app\Http\Controllers\Operations\CreateOperation{ store as traitStore; }
    use \Starmoozie\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Starmoozie\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Starmoozie\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Starmoozie\CRUD\app\Http\Controllers\Operations\ReorderOperation;
    use \Starmoozie\DynamicPermission\app\Traits\PermissionTrait;
    use Resources\Fields\MenuFields;
    use Resources\Columns\MenuColumns;
    use Resources\Concern\MenuTrait;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        $label = __('dynamic_trans::label.menu');

        CRUD::setModel(Menu::class);
        CRUD::setRoute(config('starmoozie.base.route_prefix') . '/menu');
        CRUD::setEntityNameStrings($label, $label);
        CRUD::addClause('selectList');

        $this->permissionCheck();
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @return void
     */
    protected function setupListOperation()
    {
        $this->setupColumns();
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(Request::class);

        $this->setupFields();
    }

    public function store()
    {
        $response   = $this->traitStore();

        $this->updatePivot();

        return $response;
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

    public function update()
    {
        $response   = $this->traitUpdate();

        $this->updatePivot();

        return $response;
    }

    protected function setupReorderOperation()
    {
        $this->crud->set('reorder.label', 'nama');
        $this->crud->set('reorder.max_level', 2);
    }
}
