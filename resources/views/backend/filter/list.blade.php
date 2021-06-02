@extends('backend.layouts.app') 
@section('controller','Filter')
@section('controller_route', route('list-category-filter'))
@section('action','Danh sách')
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
           		@include('flash::message')
           		<div class="btnAdd">
           			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-plus"></i> Thêm mới bộ lọc
					</button>
					<a href="{{ route('sort-category-filter', ['category'=> request('category')]) }}" class="btn btn-primary">Sắp xếp thứ tự</a>
           		</div>
           		<table id="example1" class="table table-bordered table-striped table-hover">
			        <thead>
			          	<tr>
			              	<th width="30px">STT</th>
			              	<th>Tên bộ lọc</th>
			              	<th>Loại</th>
			              	<th width="150px">Thao tác</th>
			          	</tr>
			        </thead>
		          	<tbody>
		              	@foreach ($data as $item)
		              		<tr>
		              			<td>{{ $loop->index + 1 }}</td>
		              			<td>{{ $item->name }}</td>
		              			<td>
		              				@if ($item->type == 'price')
		              					<label class="label label-success">Giá</label>
		              				@elseif ($item->type == 'brand')
		              					<label class="label label-success">Thương hiệu</label>
		              				@else
		              					<?php 
		              						$idType = explode('-', $item->type);
		              						$attributeTypesName = \App\Models\ProductAttributeTypes::find($idType[1]);
		              					?>
		              					@if (!empty($attributeTypesName))
		              						<label class="label label-success">{{ $attributeTypesName->name }}</label>
		              					@endif
		              				@endif
		              			</td>
		              			<td>
		              				<a href="{{ route('filter.edit', [ 'id' => $item->id ]) }}" class="btn btn-success btn-sm">Xây dựng bộ lọc</a>
		              				 &nbsp; &nbsp; &nbsp;
                                      <a href="javascript:void(0);" class="btn-destroy" 
                                      data-href="{{ route( 'filter.destroy',  $item->id ) }}"
                                      data-toggle="modal" data-target="#confim">
                                      <i class="fa fa-trash-o fa-fw"></i> Xóa
                                    </a>
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
	        	<form action="{{ route('filter.store') }}" method="POST">
	        		@csrf
		            <div class="modal-header">
		                <h5 class="modal-title" id="exampleModalLabel">Thêm mới bộ lọc</h5>
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                    <span aria-hidden="true">&times;</span>
		                </button>
		            </div>
		            <div class="modal-body">
		                <div class="form-group">
		                	<label for="">Tên bộ lọc</label>
		                	<input type="text" class="form-control" name="name" required="">
		                </div>
		                <input type="hidden" name="category_id" value="{{ request()->get('category') }}">
						<?php $attributeTypes = \App\Models\ProductAttributeTypes::get(); ?>
		                <div class="form-group">
		                	<label for="">Loại bộ lọc</label>
		                	<select name="type" class="form-control">
		                		<option value="brand">Thương hiệu</option>
		                		<option value="price">Giá</option>
								@if (count($attributeTypes))
									@foreach ($attributeTypes as $item)
										<option value="attribute-{{ $item->id }}">{{ $item->name }}</option>
									@endforeach
								@endif
		                	</select>
		                </div>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		                <button type="submit" class="btn btn-primary">Lưu lại</button>
		            </div>
	            </form>
	        </div>
	    </div>
	</div>
@stop