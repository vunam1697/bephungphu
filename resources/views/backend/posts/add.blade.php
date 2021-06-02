@extends('backend.layouts.app')
@section('controller', renderLinkAddPostType()['title'])
@section('controller_route', renderLinkAddPostType()['linkList'] )
@section('action','Thêm mới')
@section('content')
	<div class="content">
		<div class="clearfix"></div>
		@include('flash::message')
		<form action="{{ route('posts.store') }}" method="POST">
			@csrf
			<input type="hidden" value="blog" name="type">
			<div class="row">
				<div class="col-sm-9">
		            <div class="nav-tabs-custom">
		                <ul class="nav nav-tabs">
		                    <li class="active">
		                        <a href="#activity" data-toggle="tab" aria-expanded="true">Bài viết</a>
		                    </li>
		                    <li class="">
		                    	<a href="#setting" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>
		                    </li>
		                    <li class="">
		                    	<a href="#tags" data-toggle="tab" aria-expanded="true">Tags</a>
		                    </li>
		                </ul>
		                <div class="tab-content">
		                    <div class="tab-pane active" id="activity">
		                        <div class="row">
		                            <div class="col-sm-12">
		                                <div class="form-group">
		                                    <label>Tiêu đề</label>
		                                    <input type="text" class="form-control" name="name" id="name" value="{!! old('name') !!}" required="">
		                                </div>
		                                <div class="form-group" style="display: none;">
		                                    <label>Đường dẫn tĩnh</label>
		                                    <input type="text" class="form-control" name="slug" id="slug" value="{!! old('slug') !!}">
		                                </div>
		                                
		                                <div class="form-group">
		                                    <label>Mô tả ngắn</label>
		                                    <textarea class="form-control" rows="5" name="desc">{!! old('desc') !!}</textarea>
		                                </div>
		                                
		                                <div class="form-group">
		                                    <label>Nội dung</label>
		                                    <textarea class="content" name="content">{!! old('content') !!}</textarea>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="tab-pane" id="setting">
		                        <div class="form-group">
		                            <label>Title SEO</label>
		                            <input type="text" class="form-control" name="meta_title" value="{!! old('meta_title') !!}">
		                        </div>
		                        <div class="form-group">
		                            <label>Meta Description</label>
		                            <textarea name="meta_description" id="" class="form-control" rows="5">{!! old('meta_description') !!}</textarea>
		                        </div>

		                        <div class="form-group">
		                            <label>Meta Keyword</label>
		                            <input type="text" class="form-control" name="meta_keyword" value="{!! old('meta_keyword') !!}">
		                        </div>
		                    </div>
		                    <div class="tab-pane" id="tags">
		                    	<div class="row">
		                    		<div class="col-sm-12">
		                    			<div class="form-group">
		                    				<label for="">Tags</label>
		                    				<input type="text" class="demo-default" id="tags-input" name="tags" data-role="tagsinput">
		                    			</div>
		                    		</div>
		                    	</div>
		                    </div>
		                </div>
		            </div>
				</div>
				<div class="col-sm-3">
					<div class="box box-success">
		                <div class="box-header with-border">
		                    <h3 class="box-title">Đăng</h3>
		                </div>
		                <div class="box-body">
		                    <div class="form-group">
		                        <label for="">Trạng thái</label>
		                        <select name="status" class="form-control">
		                        	<option value="1" selected="">Hiển thị</option>
		                        	<option value="2">Bản nháp</option>
		                        	<option value="3">Chờ duyệt</option>
		                        </select>
		                    </div>
		                    <div class="form-group">
		                        <label for="">Thời gian đăng bài</label>
		                        <label class="custom-checkbox" style="font-weight: initial;">
		                            <input type="radio" name="time_published" value="1" checked=""> Thời gian tạo bài
		                        </label>
		                        <label class="custom-checkbox" style="font-weight: initial;">
		                            <input type="radio" name="time_published" value="2"> Chọn thời gian
		                        </label>
		                    </div>
		                    <div class="row time_published_value" style="display: none;">
	                    		<div class="col-sm-4" style="padding-right: 0px;">
	                    			<div class="form-group">
										<label for="">Ngày</label>
										<select name="time[date]" class="form-control">
											@for ($i = 1; $i < 32; $i++)
												<option value="{{ $i }}">{{ $i }}</option>
											@endfor
										</select>
				                    </div>
	                    		</div>
	                    		<div class="col-sm-4" >
	                    			<div class="form-group">
										<label for="">Tháng</label>
										<select name="time[month]" class="form-control">
											@for ($i = 1; $i < 13; $i++)
												<option value="{{ $i }}">{{ $i }}</option>
											@endfor
										</select>
				                    </div>
	                    		</div>
	                    		<div class="col-sm-4" style="padding-left: 0px;">
	                    			<div class="form-group">
										<label for="">Năm</label>
										<input type="text" name="time[year]" min="1" value="2020" class="form-control">
				                    </div>
	                    		</div>
	                    	</div>

	                    	<label class="custom-checkbox">
                                <input type="checkbox" name="hot" value="1" {{ @$data->hot == 1 ? 'checked' : null }}> Nổi bật
                            </label>
                            
		                    <div class="form-group text-right">
		                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại</button>
		                    </div>
		                </div>
		            </div>
		            <div class="box box-success category-box">
		                <div class="box-header with-border">
		                    <h3 class="box-title">Danh mục bài viết </h3>
		                </div>
		                <div class="box-body checkboxlist">
		                    @if (!empty($categories))
		                        @foreach ($categories as $item)
		                            @if ($item->parent_id == 0)
		                                <label class="custom-checkbox">
		                                    <input type="checkbox" class="category" name="category[]" value="{{ $item->id }}"> {{ $item->name }}
		                                 </label>
		                            @endif
		                        @endforeach
		                    @endif
		                </div>
		            </div>
		            <div class="box box-success">
		                <div class="box-header with-border">
		                    <h3 class="box-title">Ảnh đại diện</h3>
		                </div>
		                <div class="box-body">
		                    <div class="form-group" style="text-align: center;">
		                        <div class="image">
		                            <div class="image__thumbnail">
		                                <img src="{{ old('image') ?  old('image') : __IMAGE_DEFAULT__ }}"
		                                     data-init="{{ __IMAGE_DEFAULT__ }}">
		                                <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
		                                    <i class="fa fa-times"></i></a>
		                                <input type="hidden" value="{{ old('image') }}" name="image"/>
		                                <div class="image__button" onclick="fileSelect(this)">
		                                	<i class="fa fa-upload"></i>
		                                    Upload
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
				</div>
			</div>
		</form>
	</div>
@stop
@section('css')
	<link rel="stylesheet" href="{{ url('public/backend/plugins/taginput/bootstrap-tagsinput.css') }}">
@endsection
@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
	<script src="{{ url('public/backend/plugins/taginput/bootstrap-tagsinput.min.js') }}"></script>
	<script>
		jQuery(document).ready(function($) {
			$('input[name="time_published"]').click(function(){
			   	if($(this).val() == 2){
			   		$('.time_published_value').show('slow/400/fast');
			   	}else{
			   		$('.time_published_value').hide('slow/400/fast');
			   	}
			});
			$('#tags-input').tagsinput({
			  	
			});
		});
	</script>
@endsection