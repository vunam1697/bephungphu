@extends('backend.layouts.app') 
@section('controller','Menu danh mục')
@section('controller_route', route('setting.menu-category'))
@section('action','Chỉnh sửa')
@section('content')
	<div class="content">
		<div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
				<div class="row">
					<div class="col-sm-6">
						<form action="{{ route('setting.menu-category.move.post') }}" method="POST">
							@csrf
							<div class="form-group">
								<label for="">Parent ID Menu cũ</label>
								<input type="text" name="parent_id_old" class="form-control">
							</div>
							<div class="form-group">
								<label for="">Loại</label>
								<select name="type" id="" class="form-control">
									<option value="category">Category</option>
									<option value="brand">Brand</option>
								</select>
							</div>
							<div class="form-group">
								<label for="">Parent ID Menu Mới</label>
								<input type="text" name="parent_id_new" class="form-control">
							</div>
							<button class="btn btn-primary">Lưu lại</button>
						</form>
					</div>
				</div>
            </div>
        </div>
    </div>
@stop
