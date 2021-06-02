@extends('backend.layouts.app')
@section('controller', 'Trang combo sản phẩm' )
@section('controller_route', route('products-combo.index'))
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
                        <a href="#activity" data-toggle="tab" aria-expanded="true">Nội dung</a>
                    </li>
                    <li class="">
                        <a href="#seo" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="activity">
                        <div class="row">
                           <div class="col-sm-12">
                                <div class="form-group">
                                   <label for="">Tiêu đề</label>
                                   <input type="text" class="form-control" name="name" value="{{ old('name',@$data->name) }}" id="name">
                                </div>
                                <div class="form-group">
                                   <label for="">Đường dẫn</label>
                                   <input type="text" class="form-control" name="slug" value="{{ old('slug', @$data->slug) }}" id="slug">
                                </div>
                                <div class="form-group">
                                   <label for="">Nội dung</label>
                                   <textarea class="content" name="content">{!! old('content', @$data->content) !!}</textarea>
                                </div>
                           </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="seo">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="">Hình ảnh</label>
                                    <div class="image">
                                        <div class="image__thumbnail">
                                            <img src="{{ old('image', @$data->image) ?  old('image',@$data->image) : __IMAGE_DEFAULT__ }}"
                                                 data-init="{{ __IMAGE_DEFAULT__ }}">
                                            <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
                                                <i class="fa fa-times"></i></a>
                                            <input type="hidden" value="{{ old('image',@$data->image) }}" name="image"/>
                                            <div class="image__button" onclick="fileSelect(this)">
                                                <i class="fa fa-upload"></i>
                                                Upload
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label>Title SEO</label>
                                    <input type="text" class="form-control" name="meta_title" value="{!! old('meta_title', @$data->meta_title) !!}">
                                </div>
                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <textarea name="meta_description" id="" class="form-control" rows="5">{!! old('meta_description', @$data->meta_description) !!}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Meta Keyword</label>
                                    <input type="text" class="form-control" name="meta_keyword" value="{!! old('meta_keyword', @$data->meta_keyword) !!}">
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