@extends('backend.layouts.app')
@section('controller', 'Mã khuyến mại' )
@section('controller_route', route('coupons.index'))
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
                        <a href="#activity" data-toggle="tab" aria-expanded="true">Mã giảm giá</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="activity">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Mã code</label>
                                    <?php 
                                        $code = old('code', @$data->code);
                                        if(empty($code)){
                                            $code = generateRandomCode();
                                        }
                                    ?>
                                    <input type="text" name="code" value="{{ $code }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Tiêu đề mã giảm giá</label>
                                    <input type="text" name="name" value="{{ old('name', @$data->name ) }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Loại</label>
                                    <select name="type" class="form-control">
                                        <option value="1" {{ old('type', @$data->type ==  1 ? 'selected' : null ) }}>Giảm theo %</option>
                                        <option value="2" {{ old('type', @$data->type ==  2 ? 'selected' : null ) }}>Giảm theo giá tiền</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Giá trị</label>
                                    <input type="number" name="value" class="form-control" value="{{ old('value', @$data->value ) }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Mô tả</label>
                                    <textarea name="desc" cols="30" rows="5" class="form-control">{{ old('desc', @$data->desc) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Điều kiện ( Tổng giá trị đơn hàng lớn hơn hoặc bằng - Bỏ trống nếu không có điều kiện nào. )</label>
                                    <input type="number" name="condition" class="form-control" value="{{ old('condition', @$data->condition ) }}">
                                </div>
                                <div class="form-group">
					                <label class="custom-checkbox">
					                	@if(isUpdate(@$module['action']))
			                            	<input type="checkbox" name="status" value="1" {{ @$data->status == 1 ? 'checked' : null }}> Cho phép áp dụng
			                            @else
			                            	<input type="checkbox" name="status" value="1" checked> Cho phép áp dụng
			                            @endif
			                        </label>
					            </div>
                                <div class="form-group">
                                    <label class="custom-checkbox">
                                        @if(isUpdate(@$module['action']))
                                            <input type="checkbox" name="is_display_pages_cart" value="1" {{ @$data->is_display_pages_cart == 1 ? 'checked' : null }}> Hiển thị trên trang giỏ hàng
                                        @else
                                            <input type="checkbox" name="is_display_pages_cart" value="1" checked> Hiển thị trên trang giỏ hàng
                                        @endif
                                    </label>
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