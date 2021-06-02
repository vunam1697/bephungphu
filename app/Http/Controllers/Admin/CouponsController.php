<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupons;
use DataTables;

class CouponsController extends Controller
{
    protected function module(){
        return [
            'name' => 'Mã giảm giá',
            'module' => 'coupons',
            'table' =>[
                'code' => [
                    'title' => 'Mã', 
                    'with' => '',
                ],
                'name' => [
                    'title' => 'Tên mã', 
                    'with' => '',
                ],
                'type' => [
                    'title' => 'Loại', 
                    'with' => '',
                ],
                'value' => [
                	'title' => 'Giá trị', 
                    'with' => '',
                ],
                'status' => [
                	'title' => 'Trạng thái', 
                    'with' => '',
                ],
            ]
        ];
    }

    protected function fields()
    {
        return [
            'code' => 'required|unique:coupons,code',
            'name' => "required",
            'value' => 'required',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Tiêu đề không được bỏ trống.', 
            'code.required' => 'Mã code không được bỏ trống',
            'value.required' => 'Giá trị không được bỏ trống',
            'code.unique' => 'Mã code đã tồn tại.',
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
            $list_products = Coupons::orderBy('created_at', 'DESC')->get();
            return Datatables::of($list_products)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('type', function ($data) {
                    return $data->type == 1 ? 'Khuyến mại theo %' : 'Khuyến mại theo tiền';
                })->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        $status = ' <span class="label label-success">Cho phép áp dụng</span>';
                    } else {
                        $status = ' <span class="label label-danger">Không phép áp dụng</span>';
                    }
                    return $status;
                })->addColumn('action', function ($data) {
                    return '<a href="' . route('coupons.edit', ['id' => $data->id ]) . '" title="Sửa">
                            <i class="fa fa-pencil fa-fw"></i> Sửa
                        </a> &nbsp; &nbsp; &nbsp;
                            <a href="javascript:;" class="btn-destroy" 
                            data-href="' . route('coupons.destroy', $data->id) . '"
                            data-toggle="modal" data-target="#confim">
                            <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                        ';
                })->rawColumns(['checkbox', 'image', 'status', 'action', 'slug', 'name', 'price'])
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
        if($request->type == 1 && $request->value > 100){
            return redirect()->back()->withInput()->withErrors(['Giá trị không được lớn 100%.']);
        }
        $input = $request->all();
        $input['status'] = $request->status ?? 0;
        $input['is_display_pages_cart'] = $request->is_display_pages_cart ?? 0;
        $coupons = Coupons::create($input);
        
        flash('Thêm mới thành công.')->success();
        
        return redirect()->route($this->module()['module'].'.edit', $coupons->id);
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
        $data['data'] = Coupons::findOrFail($id);
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
    	$fields['code'] = 'required|unique:coupons,code,'.$id;
        $this->validate($request, $fields, $this->messages());
        $input = $request->all();
        $input['status'] = $request->status ?? 0;
        $input['is_display_pages_cart'] = $request->is_display_pages_cart ?? 0;
        $coupons = Coupons::findOrFail($id)->update($input);
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
        Coupons::destroy($id);
        flash('Xóa thành công.')->success();
        return redirect()->back(); 
    }
}
