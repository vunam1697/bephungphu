@extends('backend.layouts.app')
@section('controller', $module['name'] )
@section('controller_route', route($module['module'].'.index'))
@section('action', 'Danh sách')
@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('flash::message')
                <div class="btnAdd">
		          	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
					  	Thêm mới loại thuộc tính
					</button>
		      	</div>
		      	<table id="example1" class="table table-bordered table-striped table-hover">
			        <thead>
			          	<tr>
			              	<th><input type="checkbox" name="chkAll" id="chkAll"></th>
			              	<th>STT</th>
			              	<th>Loại thuộc tính</th>
			              	<th>Loại input</th>
			              	
			              	<th width="150px">Thao tác</th>
			          	</tr>
			        </thead>
		          	<tbody>
		              	@foreach ($data as $item)
		              		<tr>
		              			<td><input type="checkbox" name="chkItem[]" value="{{ $item->id }}"></td>
		              			<td>{{ $loop->index + 1 }}</td>
		              			<td>{{ $item->name }}</td>
		              			<td>
		              				@if ($item->type == 'color')
		              					Color
		              				@else
										Tùy chọn
		              				@endif
		              			</td>
		              			
		              			<td>
		              				<div>
				                        <a href="{{ route('product-attributes.edit', ['id'=> $item->id ]) }}" title="Sửa">
				                            <i class="fa fa-pencil fa-fw"></i> Sửa
				                        </a> &nbsp; &nbsp; &nbsp;
				                          <a href="javascript:void(0);" class="btn-destroy" 
				                          data-href="{{ route( 'product-attributes.destroy',  $item->id ) }}"
				                          data-toggle="modal" data-target="#confim">
				                          <i class="fa fa-trash-o fa-fw"></i> Xóa
				                          </a>
				                    </div>
		              			</td>
		              		</tr>
		              	@endforeach
		          	</tbody>
		      	</table>
            </div>
        </div>
    </div>

    <!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	        	<form action="{{ route('product-attributes.store') }}" method="POST">
	        		@csrf
	        		
		            <div class="modal-header">
		                <h5 class="modal-title" id="exampleModalLabel">Thêm mới loại thuộc tính</h5>
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                    <span aria-hidden="true">&times;</span>
		                </button>
		            </div>
		            <div class="modal-body">
		               	<div class="form-group">
		               		<label for="">Tên loại thuộc tính</label>
		               		<input type="text" name="name" class="form-control" required>
		               	</div>
		               	<div class="form-group">
		               		<label for="">Loại thuộc tính</label>
							<select name="type" class="form-control">
								<option value="input">Options</option>
							</select>
		               	</div>
		               	<div class="form-group" style="display: none;">
		               		<label for="">Template</label>
		               		<select name="template" class="form-control">
								<option value="color">input.color</option>
							</select>
		               	</div>


		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		                <button type="submit" class="btn btn-primary">Thêm mới</button>
		            </div>
		        </form>
	        </div>
	    </div>
	</div>
@stop