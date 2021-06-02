<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductAttributeTypes;

class ProductAttributeTypesController extends Controller
{

	 protected function module(){
        return [
            'name' => 'Thuộc tính sản phẩm',
            'module' => 'product-attributes',
            'table' =>[
                'name' => [
                    'title' => 'Tiêu đề', 
                    'with' => '',
                ],
                'slug' => [
                    'title' => 'Liên kết', 
                    'with' => '',
                ],
                'status' => [
                    'title' => 'Trạng thái', 
                    'with' => '200px',
                ],
            ]
        ];
    }

    public function getList()
    {
    	$data['data'] = ProductAttributeTypes::all();
    	$data['module'] = $this->module();
    	return view('backend.product-attribute.list', $data);
    }

    public function postStore(Request $request)
    {
        $input = $request->all();
        $input['slug'] = str_slug($request->name);
        $dataCheck = ProductAttributeTypes::where('slug', $input['slug'])->first();
        if(!empty($dataCheck)){
            return redirect()->back()->withInput()->withErrors(['Thuộc tính này đã tồn tại.']);
        }
        ProductAttributeTypes::create($input);
        flash('Thêm thành công.')->success();
        return back();
    }

    public function getEdit($id)
    {
        $data['data'] = ProductAttributeTypes::findOrFail($id);
        $data['module'] = $this->module();
        return view('backend.product-attribute.edit', $data);
    }

    public function postEdit($id, Request $request)
    {

        $input = $request->all();
        $dataCheck = ProductAttributeTypes::where('name', $input['name'])->where('id', '!=', $id)->first();
        if(!empty($dataCheck)){
            return redirect()->back()->withInput()->withErrors(['Thuộc tính này đã tồn tại.']);
        }
        ProductAttributeTypes::find($id)->update($input);
        flash('Cập nhật thành công.')->success();
        return back();
    }

    public function delete($id)
    {
        ProductAttributeTypes::destroy($id);
        flash('Xóa thành công.')->success();
        return back();
    }
}
