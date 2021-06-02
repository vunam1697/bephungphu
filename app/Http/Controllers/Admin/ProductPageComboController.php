<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductPageCombo;
use DataTables;

class ProductPageComboController extends Controller
{  
    protected function module(){
        return [
            'name' => 'Trang combo sản phẩm',
            'module' => 'products-combo',
            'table' =>[
                'name' => [
                    'title' => 'Tên trang', 
                    'with' => '',
                ],
                'link' => [
                    'title' => 'Liên kết', 
                    'with' => '',
                ],
            ]
        ];
    }


    protected function fields()
    {

        return [
            'slug' => 'required|unique:product_pages_combo,slug',
            'name' => 'required',
        ];
    }

    protected function messages()
    {
        return [
            'sku.required' => 'Bạn chưa nhập đường dẫn tĩnh.',
            'sku.unique' => 'Đường dẫn tĩnh đã tồn tại.',
            'name.required' => 'Tiêu đề không được bỏ trống.',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $list_products = ProductPageCombo::orderBy('created_at', 'DESC')->get();
            return Datatables::of($list_products)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('link', function ($data) {
                    return '<a href="' . url('pages/'.$data->slug) . '" title="Sửa" target="_blank">
                            '.url('pages/'.$data->slug).'
                        </a>';
                })->addColumn('action', function ($data) {
                    return '<a href="' . route('products-combo.edit', ['id' => $data->id ]) . '" title="Sửa">
                            <i class="fa fa-pencil fa-fw"></i> Sửa
                        </a> &nbsp; &nbsp; &nbsp;
                            <a href="javascript:;" class="btn-destroy" 
                            data-href="' . route('products-combo.destroy', $data->id) . '"
                            data-toggle="modal" data-target="#confim">
                            <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                        ';
                })->rawColumns(['checkbox', 'image', 'link', 'action', 'slug', 'name', 'price'])
                ->addIndexColumn()
                ->make(true);
        }
        $data['module'] = $this->module();
        return view("backend.{$this->module()['module']}.list", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['module'] = $this->module();
        return view("backend.{$this->module()['module']}.create-edit", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->fields(), $this->messages());
        $input = $request->all();

        $pages = ProductPageCombo::create($input);
        
        flash('Thêm mới thành công.')->success();
        
        return redirect()->route($this->module()['module'].'.edit', $pages->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['module'] = array_merge($this->module(),[
            'action' => 'update'
        ]);
        $data['data'] = ProductPageCombo::findOrFail($id);
        return view("backend.{$this->module()['module']}.create-edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fields = $this->fields();
        $fields['slug'] = 'required|unique:product_pages_combo,slug,'.$id;
        $this->validate($request, $fields, $this->messages());
        $input = $request->all();
        $pages = ProductPageCombo::findOrFail($id)->update($input);
        flash('Cập nhật thành công.')->success();
        return redirect()->back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductPageCombo::destroy($id);
        flash('Xóa thành công.')->success();
        return redirect()->back(); 
    }
}
