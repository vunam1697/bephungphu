<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductGift;

class ProductGiftController extends Controller
{
	protected function module(){
        return [
            'name' => 'Trang khuyến mại theo sản phẩm',
            'module' => 'product-gift',
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

	public function create(Request $request)
	{
		\App\Models\Products::findOrFail($request->id);
		$data['module'] = $this->module();
		return view('backend.product-gift.create-edit', $data);
	}

	public function store(Request $request)
    {
        $this->validate($request,[
            'desc' => 'required',
        ],[
            'desc.required' => 'Bạn chưa nhập mô tả',
        ]);

        $productGift = new ProductGift;
        $productGift->id_product = $request->id_product;
        $productGift->desc = $request->desc;
        $productGift->type = $request->type;
        $productGift->value = !empty($request->value) ? json_encode( $request->value ) : null;
        $productGift->save();
        flash('Thêm mới thành công quà tặng khuyến mại.')->success();
        return redirect()->route('products.edit', $productGift->id_product);
    }


    public function edit(Request $request, $id)
    {
        \App\Models\Products::findOrFail($request->id);
        $data['module'] = array_merge($this->module(),[
            'action' => 'update'
        ]);
        $data['data'] = ProductGift::findOrFail($id);

        return view('backend.product-gift.create-edit', $data);
    }

    public function update(Request $request, $id)
    {
        \App\Models\Products::findOrFail($request->id_product);
        $productGift = ProductGift::findOrFail($id);
        $productGift->id_product = $request->id_product;
        $productGift->desc = $request->desc;
        $productGift->type = $request->type;
        $productGift->value = !empty($request->value) ? json_encode( $request->value ) : null;
        $productGift->save();
        flash('Cập nhật thành công quà tặng khuyến mại.')->success();
        return redirect()->back();
    }

    public function destroy($id)
    {
        ProductGift::destroy($id);
        flash('Xóa thành công quà tặng khuyến mại.')->success();
        return redirect()->back();
    }
}