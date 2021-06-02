@extends('backend.layouts.app')
@section('controller', 'Thương hiệu' )
@section('controller_route', route('brand.index'))
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
                        <a href="#activity" data-toggle="tab" aria-expanded="true">Thương hiệu sản phẩm</a>
                    </li>
                    <li class="">
                    	<a href="#category" data-toggle="tab" aria-expanded="true">Danh mục</a>
                    </li>
                    <li class="">
                    	<a href="#setting" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="activity">
                    	<div class="row">
                    		<div class="col-sm-2">
                    			<div class="form-group">
	                				<label for="">Hình ảnh</label>
	                				 <div class="image">
			                            <div class="image__thumbnail">
			                                <img src="{{ !empty(@$data->image) ? @$data->image : __IMAGE_DEFAULT__ }}"
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
                    		<div class="col-sm-2">
                    			<div class="form-group">
	                				<label for="">Banner</label>
	                				 <div class="image">
			                            <div class="image__thumbnail">
			                                <img src="{{ !empty(@$data->banner) ? @$data->banner : __IMAGE_DEFAULT__ }}"
			                                     data-init="{{ __IMAGE_DEFAULT__ }}">
			                                <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
			                                    <i class="fa fa-times"></i></a>
			                                <input type="hidden" value="{{ old('banner', @$data->banner) }}" name="banner"/>
			                                <div class="image__button" onclick="fileSelect(this)">
			                                	<i class="fa fa-upload"></i>
			                                    Upload
			                                </div>
			                            </div>
			                        </div>
	                			</div>
                    		</div>

                    		

                    		<div class="col-sm-8">
                    			<div class="form-group">
									<label for="">Tên thương hiệu</label>
									<input type="text" class="form-control" name="name" id="name" value="{{ old('name', @$data->name) }}">
								</div>
								<div class="form-group">
									<label for="">Đường dẫn tĩnh</label>
									<input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug', @$data->slug) }}">
								</div>

								<div class="form-group">
									<?php if(isUpdate(@$module['action'])){
										$order = old('order', @$data->order);
									}else{
										$order = old('order', \App\Models\Categories::where('type', 'brand_category')->count());
									} ?>
									<label for="">Số thứ tự</label>
									<input type="number" class="form-control" name="order" value="{{ @$order }}">
								</div>
                    		</div>
                    	</div>
						
                    </div>

					<div class="tab-pane" id="category">
						<div class="row">
		            		<div class="col-sm-12">
		            			<label for="">Chọn danh mục hiển thị trang chi tiết thương hiệu</label>
		            			<?php 
			                        $category_list = [];
			                        if(!empty($data->meta_orthers)){
			                        	$content = json_decode( $data->meta_orthers );
			                        	$category_list = $content->list_category;
			                        }
			                        $categories = \App\Models\Categories::where('type','product_category')->get();
				                ?>
			                    @if (!empty($categories))
			                        @foreach ($categories as $item)
			                            @if ($item->parent_id == 0)
			                                <label class="custom-checkbox">
			                                    <input type="checkbox" class="category" name="meta_orthers[list_category][]" value="{{ $item->id }}" {{ in_array( $item->id, $category_list ) ? 'checked' : null }}> {{ $item->name }}
			                                 </label>
			                                 <?php checkBoxCategoryName( $categories, $item->id, $item, $category_list, 'meta_orthers[list_category][]' ) ?>
			                            @endif
			                        @endforeach
			                    @endif
		            		</div>
		            	</div>
					</div>

                    <div class="tab-pane" id="setting">
                    	<div class="row">
                    		<div class="col-sm-12">
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