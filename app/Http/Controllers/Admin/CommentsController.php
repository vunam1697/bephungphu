<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\Models\Products;
use DataTables;
use Carbon\Carbon;


class CommentsController extends Controller
{

	protected function module(){
        return [
            'name' => 'Bình luận sản phẩm',
            'module' => 'comments',
            'table' =>[
                'name_product' => [
                    'title' => 'Tên sản phẩm', 
                    'with' => '',
                ],
                'name_customers' => [
                    'title' => 'Tên khách hàng', 
                    'with' => '',
                ],
                'phone_customers' => [
                    'title' => 'Số điện thoại', 
                    'with' => '',
                ],
                'email_customers' => [
                    'title' => 'Email', 
                    'with' => '',
                ],
                'content' => [
                    'title' => 'Nội dung', 
                    'with' => '',
                ],
                'status' => [
                    'title' => 'Trạng thái', 
                    'with' => '100px',
                ],
                'created_at' => [
                    'title' => 'Ngày đăng', 
                    'with' => '',
                ],
                'view' => [
                    'title' => 'Chi tiết', 
                    'with' => '',
                ],
            ]
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
            $comments = Comments::orderBy('created_at', 'DESC')->where('id_customers', '!=', 77)->get();
            return Datatables::of($comments)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('name_product', function ($data) {
                    if(!empty($data->Product->slug)){
                        return '<a href="'.route('home.single.product', $data->Product->slug).'" target="_blank">'.$data->Product->name.'</a>';
                    }
                   return '--Sảm phẩm đã xóa--';
                })->addColumn('name_customers', function ($data) {
                    if($data->type == 1){
                        return 'Administrator';
                    }
                    return $data->Customers->name;
                })->addColumn('phone_customers', function ($data) {
                    if($data->type == 1){
                        return 'Administrator';
                    }
                    return $data->Customers->phone;
                })->addColumn('email_customers', function ($data) {
                    if($data->type == 1){
                        return 'Administrator';
                    }
                    return $data->Customers->email;
                })->addColumn('created_at', function ($data) {
                        return $data->created_at->format('d/m/yy H:i:s');
                })->addColumn('content', function ($data) {
                        return html_entity_decode(text_limit(strip_tags($data->content), 10).'...');
                })->addColumn('view', function ($data) {
                        return '<a href="'.route('comments.show', $data->id_product).'" class="btn btn-success btn-sm">Chi tiết</a>';
                })->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        $status = ' <a href="javascript:;" class="activeq" data-id="'.$data->id.'"><span class="label label-success">Đã duyệt</span></a>';
                    }else {
                        $status = ' <a href="javascript:;" class="activeq" data-id="'.$data->id.'"><span class="label label-danger">Chưa duyệt</span></a>';
                    }
                    return $status;
                })->addColumn('action', function ($data) {
                    return '<a href="' . route('comments.edit', ['id' => $data->id ]) . '" title="Sửa">
                            <i class="fa fa-pencil fa-fw"></i> Sửa
                        </a> &nbsp; &nbsp; &nbsp;';
                })->rawColumns(['checkbox', 'name_product', 'status', 'action', 'name', 'view'])
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
        ],[
            'content.required' => 'Bạn chưa nhập nội dung bình luận.'
        ]);
        $comment = new Comments;
        $comment->content = $request->content;
        $comment->parent_id = $request->parent_id;
        $comment->id_customers = auth()->user()->id;
        $comment->type = 1;
        $comment->status = 1;
        $comment->id_product = $request->id_product;
        $comment->save();
        flash('Bình luận thành công.')->success();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['data'] = Products::findOrFail($id);
        $data['module'] = $this->module();
        return view("backend.{$this->module()['module']}.view", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['data'] = Comments::findOrFail($id);
        $data['module'] = array_merge($this->module(),[
            'action' => 'update'
        ]);
        return view("backend.{$this->module()['module']}.edit", $data);
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
       	$data = Comments::findOrFail($id);
       	$data->content = $request->content;
       	$data->status  = $request->status ?? 0;
       	if( $data->is_voted == 0 && $data->status == 1 ){
       		if(!empty($data->vote_questions)){
	       		$vote_questions = json_decode( $data->vote_questions );
	       		foreach ($vote_questions as $key => $item) {
	       			$questions = \App\Models\ProductQuestions::find($item->id_question);
		       		if($item->vote == 'yes'){
		       			$questions->increment('vote_yes');
		       		}else{
		       			$questions->increment('vote_no');
		       		}
	       		}
	            \App\Models\Products::find($data->id_product)->increment('vote_question');
	       	}
	       	$data->is_voted = 1;
	       	\App\Models\Products::find($data->id_product)->increment('vote_star');
       	}
       	$data->save();
       	flash('Cập nhật thành công.')->success();
       	return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Comments::findOrFail($id);
        $dataChild = get_list_ids_comments($data);
        if(!empty($dataChild)){
            foreach ($dataChild as $value) {
                Comments::destroy($value);
            }
        }
        Comments::destroy($id);
        flash('Xóa thành công.')->success();
        return back();
    }


    public function deleteMuti(Request $request)
    {
        if(!empty($request->chkItem)){
            foreach ($request->chkItem as $id) {
                Comments::destroy($id);
            }
            flash('Xóa thành công.')->success();
            return back();
        }
        flash('Bạn chưa chọn dữ liệu cần xóa.')->error();
        return back();
    }


    public function getQuickActive(Request $request)
    {
        $data = Comments::findOrFail($request->id);
        if($data->status == 1){
            $data->status = 0;
            $data->save();
            return '<span class="label label-danger">Chưa duyệt</span>';
        }else{
            $data->status = 1;
            if($data->is_voted == 0){
            	if(!empty($data->vote_questions)){
		       		$vote_questions = json_decode( $data->vote_questions );
		       		foreach ($vote_questions as $key => $item) {
		       			$questions = \App\Models\ProductQuestions::find($item->id_question);
			       		if($item->vote == 'yes'){
			       			$questions->increment('vote_yes');
			       		}else{
			       			$questions->increment('vote_no');
			       		}
		       		}
	                \App\Models\Products::find($data->id_product)->increment('vote_question');
		       	}
		       	\App\Models\Products::find($data->id_product)->increment('vote_star');
		       	$data->is_voted == 1;
            }
            
            $data->save();
            return '<span class="label label-success">Đã duyệt</span>';
        }
    }
}
