@extends('backend.layouts.app')
@section('controller', 'Quà tặng sản phẩm' )
@section('controller_route', route('products.edit', request('id')))
@section('action', renderAction(@$module['action']))
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        
       	@include('flash::message')
       	<form action="{!! updateOrStoreRouteRender( @$module['action'], $module['module'], @$data) !!}" method="POST">
       		<input type="hidden" name="id_product" value="{{ request('id') }}">
			@csrf
			@if(isUpdate(@$module['action']))
		        {{ method_field('put') }}
		    @endif
		    <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#activity" data-toggle="tab" aria-expanded="true">Nội dung</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="activity">
                    	<div class="row">
                    		<div class="col-sm-12">
                    			<div class="form-group">
                    				<label for="">Mô tả</label>
                    				<textarea class="content" name="desc">{!! old('desc', @$data->desc) !!}</textarea>
                    			</div>
                    		</div>
                    	</div>
                    	<div class="form-group">
                    		<label for="">Loại</label>
                    		<select name="type" class="form-control" id="type">
                    			<option value="default" {{ @$data->type == 'default' ? 'selected' : null }}>Mặc định</option>
                    			<option value="options" {{ @$data->type == 'options' ? 'selected' : null }}>Lựa chọn</option>
                    		</select>
                    	</div>
                    	<div class="form-group" id="options-layout">
                    		<label for="">Lựa chọn</label>
                    		<div class="repeater" id="repeater">
				                <table class="table table-bordered table-hover product-gift">
				                    <thead>
					                    <tr>
					                    	<th style="width: 30px;">STT</th>
					                    	<th>Tiêu đề</th>
					                    	<th>Giá giảm ( Nếu có )</th>
					                    	<th style="width: 30px;"></th>
					                    </tr>
				                	</thead>
				                	<?php if(!empty($data->value)){
				                		$list_value = json_decode($data->value);
				                	} ?>
				                    <tbody id="sortable">
				                    	@if (!empty($list_value->list))
				                    		@foreach ($list_value->list as $id => $value)
				                    			@include('backend.repeater.row-product-gift', ['index' => $loop->index + 1])
				                    		@endforeach
				                    	@endif
									</tbody>
				                </table>
				               	<div class="text-right">
				                    <button class="btn btn-primary" onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'product-gift', '.product-gift')">Thêm</button>
			                	</div>
				            </div>
                    	</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                </div>
            </div>
		</form>
	</div>
@stop