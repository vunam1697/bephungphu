@extends('backend.layouts.app')
@section('controller','Filter')
@section('controller_route', route('list-category-filter'))
@section('action', 'Cập nhật')
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
            	<form action="{{ route( 'filter.update', $data->id ) }}" method="POST">
            		@method('PUT')
            		@csrf
            		
			       	@include('flash::message')
			       	<div class="row">
			       		<div class="col-sm-12">
			       			<div class="form-group">
				       			<label for="">Tiêu đề bộ lọc</label>
				       			<input type="text" name="name" value="{{ $data->name }}" class="form-control">
				       		</div>

				       		<div class="form-group">
				       			<label for="">Loại bộ lọc: </label>
				       			<label for="">
					       			@if ($data->type == 'price')
		              					Giá
		              				@elseif ($data->type == 'brand')
		              					Thương hiệu
		              				@else
		              					<?php 
		              						$idType = explode('-', $data->type);
		              						$attributeTypesName = \App\Models\ProductAttributeTypes::find($idType[1]);
		              					?>
		              					@if (!empty($attributeTypesName))
		              						{{ $attributeTypesName->name }}
		              					@endif
		              				@endif
	              				</label>
				       		</div>
				       		<?php if(!empty($data->content)){
				       			$content = json_decode( $data->content );
				       		} ?>
							
							@if ($data->type == 'price')
								@include('backend.filter.layout-type.price')
							@elseif($data->type == 'brand')
								@include('backend.filter.layout-type.brand')
							@else
								@include('backend.filter.layout-type.attribute')
							@endif
				           

				           <button class="btn-primary btn">Lưu lại</button>
			       		</div>
			       	</div>
			    </form>
		    </div>
		</div>
	</div>
@stop