<?php

namespace Starmoozie\DynamicPermission\app\Http\Controllers;

use Starmoozie\DynamicPermission\app\Http\Requests\MenuRequest as Request;
use Starmoozie\CRUD\app\Http\Controllers\CrudController;
use Starmoozie\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use Starmoozie\DynamicPermission\app\Models\Menu;
use Starmoozie\DynamicPermission\app\Models\Permission;

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
        $this->permissionCheck();
        CRUD::addClause('selectList');
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

    private function updatePivot()
    {
        $entry      = $this->crud->entry;
        $permission = Permission::selectIdNama(CRUD::getRequest()->permissions)->get();

        foreach ($permission as $key => $value) {
            $pivot[$value->id] = ['alias' => $entry->nama.'-'.$value->nama];
        }

        return $entry->permissions()->sync($pivot);
    }

    protected function setupReorderOperation()
    {
        // define which model attribute will be shown on draggable elements 
        $this->crud->set('reorder.label', 'nama');
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        $this->crud->set('reorder.max_level', 2);
    }

    private function setupColumns()
    {
        CRUD::addColumns([
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

    private function setupFields()
    {
        CRUD::addFields([
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
                'data_source'          => starmoozie_url("api/parent-menu"),
                'placeholder'          => __('dynamic_trans::placeholder.select_parent'),
                'minimum_input_length' => 0,
                'hint'                 => __('dynamic_trans::hint.parent_menu')
            ],
            [
                'name'       => 'url',
                'label'      => __('dynamic_trans::label.route'),
                'wrapper'    => ['class' => 'form-group col-md-4'],
                'attributes' => ['required' => 'required', 'pattern' => '[a-z#]+', 'maxlength' => 10],
                'hint'       => __('dynamic_trans::hint.route_menu')
            ],
            [
                'label'                => __('dynamic_trans::label.permissions'),
                'type'                 => "select2_from_ajax_multiple",
                'name'                 => 'permissions', 
                'entity'               => 'permissions',
                'attribute'            => "nama",
                'data_source'          => starmoozie_url("api/permission"),
                'pivot'                => true,
                'model'                => "Starmoozie\DynamicPermission\app\Models\Permission",
                'placeholder'          => "Select a city",
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
                'inline'  => true,
                'wrapper' => ['class' => 'form-group col-md-6'],
            ]
        ]);
    }
}
