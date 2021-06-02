@extends('backend.layouts.app')
@section('controller', $module['name'] )
@section('controller_route', route($module['module'].'.index'))
@section('action', renderAction(@$module['action']))
@section('content')
	<div class="content">
		<div class="clearfix"></div>
       	@include('flash::message')
       	<form action="{!! updateOrStoreRouteRender( @$module['action'], $module['module'], @$data) !!}" method="POST">
       		@csrf
			@if(isUpdate(@$module['action']))
		        {{ method_field('put') }}
		    @endif
		   	<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#activity" data-toggle="tab" aria-expanded="true">Chi nhánh</a>
                    </li>
                </ul>
                <div class="tab-content">
	                <div class="tab-pane active" id="activity">
	                	<div class="row">
	                		<div class="col-sm-10">
	                			<div class="form-group">
	                				<label for="">Tên chi nhánh</label>
	                				<input type="text" name="name" class="form-control" value="{{ old('name', @$data->name) }}">
	                			</div>
	                			<div class="form-group">
	                				<label for="">Địa chỉ</label>
	                				<input type="text" name="address" class="form-control" value="{{ old('address', @$data->address) }}">
	                			</div>
	                			<div class="form-group">
	                				<label for="">Số điện thoại</label>
	                				<input type="text" name="phone" class="form-control" value="{{ old('phone', @$data->phone) }}">
	                			</div>
	                			<div class="form-group">
	                				<label for="">Email</label>
	                				<input type="text" name="email" class="form-control" value="{{ old('email', @$data->email) }}">
	                			</div>
	                			<div class="form-group">
	                				<label for="">Iframe Google maps</label>
	                				<textarea name="iframe" class="form-control" rows="5">{{ old('iframe', @$data->iframe) }}</textarea>
	                			</div>
	                			<div class="form-group">
					                <label class="custom-checkbox">
					                	@if(isUpdate(@$module['action']))
			                            	<input type="checkbox" name="status" value="1" {{ @$data->status == 1 ? 'checked' : null }}> Hiển thị
			                            @else
			                            	<input type="checkbox" name="status" value="1" checked> Hiển thị
			                            @endif
			                        </label>
					            </div>
	                		</div>
	                		<div class="col-sm-2">
	                			<div class="form-group">
	                				<label for="">Hình ảnh</label>
			                        <div class="image">
			                            <div class="image__thumbnail">
			                                <img src="{{ old('image', @$data->image) ? old('image', @$data->image) : __IMAGE_DEFAULT__ }}"
			                                     data-init="{{ __IMAGE_DEFAULT__ }}">
			                                <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
			                                    <i class="fa fa-times"></i></a>
			                                <input type="hidden" value="{{ old('image', @$data->image) }}" name="image"/>
			                                <div class="image__button" onclick="fileSelect(this)">
			                                	<i class="fa fa-upload"></i>
			                                    Upload
			                                </div>
			                            </div>
			                        </div>
			                    </div>
	                		</div>
	                		<div class="col-sm-12">
	                			<button class="btn btn-primary" type="submit">Lưu lại</button>
	                		</div>
	                	</div>
	                </div>
	            </div>
            </div>
       	</form>
	</div>
@stop