@extends('backend.layouts.app')
@section('controller','Trang')
@section('controller_route',route('pages.list'))
@section('action','Danh sách')
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
               	<form action="{{ route('pages.build.post') }}" method="POST">
					{{ csrf_field() }}
					<input name="type" value="{{ $data->type }}" type="hidden">

	               	<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">Trang</label>
								<input type="text" class="form-control" value="{{ $data->name_page }}" disabled="">
				 				
								@if (\Route::has($data->route))
									<h5>
										<a href="{{ route($data->route) }}" target="_blank">
					                        <i class="fa fa-hand-o-right" aria-hidden="true"></i>
					                        Link: {{ route($data->route) }}
					                    </a>
									</h5>
				                @endif
							</div>
							
						</div>
					</div>
					<div class="nav-tabs-custom">
				        <ul class="nav nav-tabs">
				        	<li class="active">
				            	<a href="#about" data-toggle="tab" aria-expanded="true">Về chúng tôi</a>
				            </li>
				            <li class="">
				            	<a href="#seo" data-toggle="tab" aria-expanded="true">Cấu hình trang</a>
				            </li>
				        </ul>
				    </div>
				    <?php if(!empty($data->content)){
				    	$content = json_decode($data->content);

				    } ?>
				    <div class="tab-content">
						
						<div class="tab-pane active" id="about">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="">Tiêu đề</label>
										<input type="text" name="content[about][title]" value="{{ @$content->about->title }}" class="form-control">
									</div>
									<div class="form-group">
										<label for="">Nội dung</label>
										<textarea class="content" name="content[about][desc]">{!! @$content->about->desc !!}</textarea>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
			                           <label>Hình ảnh đại diện video</label>
			                           <div class="image">
			                               <div class="image__thumbnail">
			                                   <img src="{{ !empty($content->video->image) ?  $content->video->image : __IMAGE_DEFAULT__ }}"  
			                                   data-init="{{ __IMAGE_DEFAULT__ }}">
			                                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
			                                    <i class="fa fa-times"></i></a>
			                                   <input type="hidden" value="{{ @$content->video->image }}" name="content[video][image]"  />
			                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
			                               </div>
			                           </div>
			                       	</div>
								</div>
								<div class="col-sm-10">
									<div class="form-group">
										<label for="">Iframe</label>
										<textarea class="form-control" rows="4" name="content[video][iframe]">{{ @$content->video->iframe }}</textarea>
									</div>
								</div>
							</div>
						</div>

			            <div class="tab-pane" id="seo">
							<div class="row">
								<div class="col-sm-2">
									<div class="form-group">
			                           <label>Hình ảnh</label>
			                           <div class="image">
			                               <div class="image__thumbnail">
			                                   <img src="{{ $data->image ?  $data->image : __IMAGE_DEFAULT__ }}"  
			                                   data-init="{{ __IMAGE_DEFAULT__ }}">
			                                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
			                                    <i class="fa fa-times"></i></a>
			                                   <input type="hidden" value="{{ @$data->image }}" name="image"  />
			                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
			                               </div>
			                           </div>
			                       </div>
								</div>
								
								<div class="col-sm-10">
									<div class="form-group">
										<label for="">Tiêu đề trang</label>
										<input type="text" name="meta_title" class="form-control" value="{{ @$data->meta_title }}">
									</div>
									<div class="form-group">
										<label for="">Mô tả trang</label>
										<textarea name="meta_description" 
										class="form-control" rows="5">{!! @$data->meta_description !!}</textarea>
									</div>
									<div class="form-group">
										<label for="">Từ khóa</label>
										<input type="text" name="meta_keyword" class="form-control" value="{!! @$data->meta_keyword !!}">
									</div>
									
									

								</div>
							</div>
			            </div>
			           <button type="submit" class="btn btn-primary">Lưu lại</button>
			        </div>
				</form>
			</div>
		</div>
	</div>
@stop