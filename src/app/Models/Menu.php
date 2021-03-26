<?php

namespace Starmoozie\DynamicPermission\app\Models;

use Illuminate\Database\Eloquent\Model;
use Starmoozie\CRUD\app\Models\Traits\CrudTrait;

class Menu extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | permission Columns
    | [{"label": "Read", "value": "list"}] etc
    | Users Table menu_permission columns
    | [{"menu_id": 1, "permissions": [{"label": "Read", "value": "list"}]}]
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table       = 'menu';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded     = ['id'];
    protected $fillable    = ['nama', 'for_backend', 'url', 'parent_id'];
    // protected $hidden = [];
    // protected $dates = [];
    // protected $fakeColumns = ['permissions'];
    // protected $casts       = ['permissions' => 'json'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function scopeSelectList($query)
    {
        return $query->select(['parent_id', 'id', 'nama', 'url', 'for_backend']);
    }

    public static function getTree()
    {
        $auth  = starmoozie_user();

        if ($auth && $auth->level) {
            $menu_id = $auth->level->menuPermission->pluck('menu_id')->toArray();
            $menu    = self::whereIn('id', $menu_id)->orderBy('lft')->get();

            if ($menu->count()) {
                foreach ($menu as $k => $menu_item) {
                    $menu_item->children = collect([]);

                    foreach ($menu as $i => $menu_subitem) {
                        if ($menu_subitem->parent_id == $menu_item->id) {
                            $menu_item->children->push($menu_subitem);

                            // remove the subitem for the first level
                            $menu = $menu->reject(function ($item) use ($menu_subitem) {
                                return $item->id == $menu_subitem->id;
                            });
                        }
                    }
                }
            }

            return $menu;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function parent()
    {
        return $this->belongsTo('Starmoozie\DynamicPermission\app\Models\Menu', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('Starmoozie\DynamicPermission\app\Models\Menu', 'parent_id');
    }

    public function permission()
    {
        return $this->belongsToMany(Permission::class)
            ->withPivot(['alias']);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = ucwords(strtolower($value));
    }
}
