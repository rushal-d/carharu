<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PermissionController extends Controller
{
    public function index()
    {
        $data['i'] = 1;
        $data['permissions'] = Permission::with('parents')->get();
        return view('entrust.permission.index', $data);
    }

    public function create()
    {
        $not_found = [];
        $url_checks = Permission::where('isURL', '1')->get();
        foreach ($url_checks as $permission) {
            //$role->attachPermission($permission->id);
            $status = false;
            foreach (Route::getRoutes()->getRoutes() as $route) {
                $action = $route->getAction();
                if (array_key_exists('as', $action)) {
                    if ($permission->name == $action['as']) {
                        $status = true;
                    }
                }
            }
            if (!$status) {
                $permission->delete();
            }
        }
        $route_name = [];
        foreach (Route::getRoutes()->getRoutes() as $route) {
            $action = $route->getAction();
            if (array_key_exists('as', $action)) {
                $route_name[] = $action['as'];
                $name = $action['as'];
                $permission_route=Permission::where('name',$name)->first();
                if(empty($permission_route)){
                    $new_permission_route=new Permission();
                    $new_permission_route->name=$name;
                    $new_permission_route->parent_id= 0;
                    $new_permission_route->save();
                }
            }
        }
        $permissions = Permission::rootPermission()->get();
        return view('entrust.permission.create', compact('permissions', 'not_found'));
    }

    public function add(Request $request)
    {
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->isURL = 0;
        $permission->parent_id = 0;
        $permission->save();
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $p_order = 1;
        $i = 1;
        foreach ($request->menu as $menu) {
            $i++;
            if ($menu['parent_id'] == null) {
                $i = 1;
                $p_order++;
                $parent_id = 0;
            } else {
                $parent_id = $menu['parent_id'];
            }
//            echo $parent_id;
            if (!empty($menu['item_id'])) {
                $permission = Permission::find($menu['item_id']);
                if ($menu['parent_id'] == null) {
                    $permission->order = $p_order;

                } else {
                    $permission->order = $i;
                }

                $permission->parent_id = $parent_id;
                $permission->update();
            }
        }
        $data = array();
        $data['success']  = 1;
        return response()->json($data);
    }

    public function displayNameStore(Request $request)
    {
        $values = $request->permission;
        foreach ($values as $key => $value) {
            $permission = Permission::where('name', $key)->first();
            if(!empty($permission)){
                $permission->display_name = $value['display_name'];
                $permission->update();
            }
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $data = Permission::findorfail($id)->delete();
        return response()->json($data);
    }
}
