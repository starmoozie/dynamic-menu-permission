<?php

namespace Starmoozie\DynamicPermission\app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Starmoozie\DynamicPermission\app\Models\Permission;
use Starmoozie\DynamicPermission\app\Models\MenuPermission;

class ApiController extends Controller
{
    public function permission(Request $request)
    {
        $search  = $request->input('q');
        $results = Permission::query();

        if ($search)
        {
            $results = $results->where('name', 'LIKE', '%'.$search.'%');
        }

        return $results->paginate(10);
    }

    public function menuPermission(Request $request)
    {
        $search  = $request->input('q');
        $results = MenuPermission::join('menu as m', 'menu_permission.menu_id', 'm.id')
            ->join('permission as p', 'menu_permission.permission_id', 'p.id')
            ->select('menu_permission.id', \DB::raw("CONCAT(m.nama, ' ', p.nama) AS alias"));

        if ($search)
        {
            $results = $results->where('alias', 'LIKE', '%'.$search.'%');
        }

        return $results->paginate(10);
    }
}
