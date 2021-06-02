<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\OrderDetail;
use DataTables;

class OrdersController extends Controller
{

	protected function module(){
        return [
            'name' => 'Đơn hàng',
            'module' => 'order',
            'table' =>[
                'code' => [
                    'title' => 'Mã đơn hàng', 
                    'with' => '',
                ],
                'name' => [
                    'title' => 'Tên khách hàng', 
                    'with' => '',
                ],
                'phone' => [
                    'title' => 'Số điện thoại', 
                    'with' => '',
                ],
                'grand_total' => [
                    'title' => 'Tổng tiền khách phải trả', 
                    'with' => '',
                ],
                'subtotal_total' => [
                    'title' => 'Tổng tiền', 
                    'with' => '',
                ],
                'type_pay' => [
                	'title' => 'Hình thức thanh toán', 
                    'with' => '',
                ],
                'date_create' => [
                	'title' => 'Ngày đặt', 
                    'with' => '',
                ],
                'date_receive' => [
                	'title' => 'Ngày nhận', 
                    'with' => '',
                ],
                'status' => [
                	'title' => 'Trạng thái', 
                    'with' => '',
                ],
                'view' => [
                	'title' => 'Chi tiết', 
                    'with' => '',
                ],
            ]
        ];
    }

    public function getList(Request $request)
    {
    	if($request->ajax()){
            $order = Orders::orderBy('id','DESC')->get();
            return Datatables::of($order)
            ->addColumn('grand_total', function ($data) {
                return number_format($data->grand_total).'đ';
            })->addColumn('subtotal_total', function ($data) {
                return number_format($data->subtotal_total).'đ';
            })->addColumn('name', function ($data) {
                return @$data->Customers->name;
            })->addColumn('phone', function ($data) {
                return @$data->Customers->phone;
            })->addColumn('date_create', function ($data) {
                return $data->created_at;
            })->addColumn('date_receive', function ($data) {
                if($data->status == 4){
                    return $data->updated_at;
                }
                return '-------';
            })->addColumn('type_pay', function ($data) {
                if($data->type_pay == 'COD'){
                    return '<span class="badge label-success">Thanh toán khi nhận hàng</span>';
                }else {
                	return '<span class="badge label-success">Thanh toán online</span>';
                }
            })->editColumn('status', function ($data) {
                if ($data->status == 1) {
                    return '<span class="badge label-warning"> Mới đặt</span>';
                }elseif ($data->status == 2) {
                    return '<span class="badge label-primary"> Xác nhận</span>';
                }elseif ($data->status == 3) {
                    return '<span class="badge label-info"> Đang giao hàng</span>';
                }elseif ($data->status == 4) {
                    return '<span class="badge label-success"> Hoàn thành</span>';
                }elseif ($data->status == 5) {
                    return '<span class="badge label-danger">Hủy</span>';
                }
            })->addColumn('checkbox', function ($data) {
                return '<input type="checkbox" name="chkItem[]" value="'.$data->id.'">';
            })->addColumn('code', function ($data) {
                return '<a href="'.route('order.edit', $data->id).'">#ORDER_'.$data->id.'</a>';
            })->addColumn('action', function ($data) {
                return '<a href="javascript:;" class="btn-destroy" 
                  data-href="'.route( 'order.destroy',  $data->id ).'"
                      data-toggle="modal" data-target="#confim">
                    <i class="fa fa-trash-o fa-fw"></i> Xóa
                </a>';
            })->addColumn('view', function ($data) {
                return '<a href="'.route('order.edit', $data->id).'"><i class="fa fa-eye"></i> Xem</a></td>';
            })
            ->rawColumns(['checkbox','code','action','view','status', 'type_pay', 'date_receive'])
            ->addIndexColumn()
            ->make(true);
        }
    	$data['module'] = $this->module();
    	return view('backend.orders.list', $data);
    }

    public function getEdit($id)
    {
        $data = Orders::findOrFail($id);
        return view('backend.orders.edit', compact('data'));
    }

    public function postEdit($id, Request $request)
    {
    	$data = Orders::find($id);
        $data->status = $request->status;
        $data->save();
        flash('Cập nhật thành công.')->success();
        return redirect()->back();
        
    }

    public function postDelete($id)
    {
    	Orders::destroy($id);
    	flash('Xóa thành công.')->success();
        return back();
    }

    public function deleteMuti(Request $request)
    {
        if(!empty($request->chkItem)){
            foreach ($request->chkItem as $id) {
                Orders::destroy($id);
            }
            flash('Xóa thành công.')->success();
            return back();
        }
        flash('Bạn chưa chọn dữ liệu cần xóa.')->error();
        return back();
    }
}
