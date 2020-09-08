<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class MenuController extends Controller
{
    public function index()
    {
        $data['permissions'] = Permission::orderBy('name', 'ASC')->get();
        $data['menu_ids'] = Menu::pluck('id')->toArray();
        $data['menus'] = Menu::rootMenu()->get();
        return view('entrust.menu.index', $data);
    }

    public function search(Request $request)
    {
        $permission = Permission::search($request->search)->orderBy('name', 'ASC')->get();
        $menus = Menu::pluck('id')->toArray();
        return response()->json(['permission' => $permission, 'menu' => $menus]);
    }

    public function store(Request $request)
    {
        $input = Input::all();
        $menu = Menu::create($input);
        return response()->json('success');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $menu = Menu::find($id);
        $menu->delete();
        return response()->json('success');
    }

    public function buildMenu(Request $request)
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
            if (!empty($menu['item_id'])) {
                $new_menu = Menu::find($menu['item_id']);
                if ($menu['parent_id'] == null) {
                    $new_menu->order = $p_order;
                } else {
                    $new_menu->order = $i;
                }

                $new_menu->parent_id = $parent_id;
                $new_menu->save();
            }
        }
        $data = array();
        $data['sucess'] = 1;
        return response()->json($data);
    }

    public function displayNameStore(Request $request)
    {
        $values = $request->permission;

        foreach ($values as $key => $value) {
            $new_menu = Menu::where('menu_name', $key)->first();
            if(!empty($new_menu)){
                $new_menu->icon = $value['icon'];
                $new_menu->display_name = $value['display_name'];
                $new_menu->update();
            }
        }
        return redirect()->back();
    }
}
