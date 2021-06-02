<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branchs;

class BranchsController extends Controller
{

    protected function fields()
    {
        return [
            'name' => "required",
            'address' => "required",
            // 'phone' => "required",
            // 'email' => "required",
            'iframe' => "required",
            'image' => "required",
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Tiêu đề không được bỏ trống.', 
            'address.required' => 'Địa chỉ không được bỏ trống.',
            'phone.required' => 'Số điệnt thoại không được bỏ trống.',
            'email.required' => 'Email không được bỏ trống.',
            'iframe.required' => 'Iframe không được bỏ trống.',
            'image.required' => 'Bạn chưa chọn hình ảnh.',
        ];
    }


    protected function module(){
        return [
            'name' => 'Chi nhánh',
            'module' => 'branchs',
            'table' =>[
                'name' => [
                    'title' => 'Tiêu đề chi nhánh', 
                    'with' => '',
                ],
                'phone' => [
                    'title' => 'Số điện thoại', 
                    'with' => '',
                ],
                'email' => [
                    'title' => 'Email', 
                    'with' => '',
                ],
                'status' => [
                    'title' => 'Trạng thái', 
                    'with' => '150px',
                ],
            ]
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['data'] = Branchs::order()->get();
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
        $input['status'] = $request->status ?? 0;
        Branchs::create($input);
        flash('Thêm mới thành công.')->success();
        return redirect()->route("{$this->module()['module']}.index");

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
        $data['data'] = Branchs::findOrFail($id);
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
        $this->validate($request, $this->fields(), $this->messages());
        $input = $request->all();
        $input['status'] = $request->status ?? 0;
        Branchs::findOrFail($id)->update($input);
        flash('Sửa thành công.')->success();
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
        Branchs::destroy($id);
        flash('Xóa thành công.')->success();
        return redirect()->back();
    }

    public function deleteMuti(Request $request)
    {
        if(!empty($request->chkItem)){
            foreach ($request->chkItem as $id) {
                Branchs::destroy($id);
            }
            flash('Xóa thành công.')->success();
            return back();
        }
        flash('Bạn chưa chọn dữ liệu cần xóa.')->error();
        return back();
    }
}
