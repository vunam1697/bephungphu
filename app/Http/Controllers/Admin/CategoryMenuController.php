<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryMenu;
use App\Models\Menu;

class CategoryMenuController extends Controller
{
    public function getList(Request $request)
    {
    	$parent_id = $request->parent_id;
    	$type = $request->type;
    	$data = CategoryMenu::where('parent_id', $parent_id)->whereType($type)->orderBy('position', 'asc')->get();
    	return view('backend.menu-category.create-edit', compact('data'));
    }


    public function postAddItem(Request $request)
    {
        $menu           = new CategoryMenu;
        $menu->title    = $request->title;
        $menu->url      = $request->url;
        $menu->parent_id = !empty($request->parent_id) ? $request->parent_id : null;
        $menu->type = !empty($request->type) ? $request->type : null;
        $menu->position = 0;
        $menu->class    = $request->class;
        $menu->icon     = $request->icon;      
        $menu->save();
        flash('Thêm mới thành công.')->success();
        return redirect()->back();
    }

    public function postUpdateMenu(Request $request)
    {
        $jsonMenu = json_decode($request->jsonMenu);
        $this->saveMenu($jsonMenu);
        if (!$request->ajax()) {
            flash('Cập nhập thành công.')->success();
            return back();
        }
    }
    public function saveMenu($jsonMenu)
    {
        $count = 0;
        foreach ($jsonMenu as $item) {
            $menu = CategoryMenu::find($item->id);
            if ($menu) {
                $menu->position  = $count;
                $menu->save();
                if (!empty($item->children)) {
                    $this->saveMenu($item->children, $menu->id);
                }
            }
            $count++;
        }
    }


    public function getDelete($id)
    {
        $menu = CategoryMenu::find($id);
        $menu->delete();
        flash('Xóa thành công.')->success();
        return back();
    }


    public function getEditItem($id)
    {
        $menu = CategoryMenu::find($id);
        if (isset($menu)) {
            $data = [
                'status' => 'success',
                'data'   => $menu,
            ];
        } else {
            $data = [
                'status' => 'error',
            ];
        }
        return response()->json($data);
    }


    public function postEditItem(Request $request)
    {
        $menu        = CategoryMenu::find($request->id);
        $menu->title = $request->title;
        $menu->url   = $request->url;
        $menu->icon     = $request->icon;
        $menu->save();
        flash('Cập nhập thành công.')->success();
        return back();
    }

    public function getMoveMenu()
    {
        return view('backend.menu-category.move');
    }


    public function postMoveMenu(Request $request)
    {
        $menu_old = Menu::where('parent_id', $request->parent_id_old)->get();// sửa
        $index = 0;
        foreach ($menu_old as $value) {
            $new = new CategoryMenu;
            $new->title     = $value->title;
            $new->url       = $value->url;
            $new->type      = $request->type;
            $new->position  = ++$index;
            $new->parent_id = $request->parent_id_new; // sửa
            $new->save();
        }
        return back();
    }



}
