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
				            	<a href="#activity1" data-toggle="tab" aria-expanded="true">Banner</a>
				            </li>


							<li class="">
				            	<a href="#activity2" data-toggle="tab" aria-expanded="true">Danh mục sản phẩm</a>
				            </li>

				            <li class="">
				            	<a href="#activity3" data-toggle="tab" aria-expanded="true">Banner - Giữa trang</a>
				            </li>

				            <li class="">
				            	<a href="#activity4" data-toggle="tab" aria-expanded="true">Đối tác</a>
				            </li>

				            <li class="">
				            	<a href="#activity5" data-toggle="tab" aria-expanded="true">Video</a>
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

				    	<div class="tab-pane active" id="activity1">
				    		<div class="repeater" id="repeater">
				                <table class="table table-bordered table-hover banners">
				                    <thead>
					                    <tr>
					                    	<th style="width: 30px;">STT</th>
					                    	<th width="200px">Hình ảnh</th>
					                    	<th>Mô tả - Liên kết</th>
					                    	<th style="width: 20px"></th>
					                    </tr>
				                	</thead>
				                    <tbody id="sortable">
										@if (!empty($content->banner))
											@foreach ($content->banner as $id => $value)
												<?php $index = $loop->index + 1;?>
												@include('backend.repeater.row-banner-home')
											@endforeach
										@endif
				                    </tbody>
				                </table>
				                <div class="text-right">
				                    <button class="btn btn-primary" 
						            	onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'banner-home', '.banners')">Thêm
						            </button>
				                </div>
				            </div>
				    	</div>
				    	<div class="tab-pane" id="activity2">
				    		<div class="row">
				    			<div class="col-sm-6">
				    				<div class="repeater" id="repeater">
					    				<label for="">Chọn danh mục hiển thị khuyến mại hot</label>
					    				<table class="table table-bordered table-hover category-hot">
						                    <thead>
							                    <tr>
							                    	<th style="width: 30px;">STT</th>
							                    	<th>Danh mục</th>
							                    	<th style="width: 20px"></th>
							                    </tr>
						                	</thead>
						                    <tbody id="sortable">
												@if (!empty($content->category_hot))
													@foreach ($content->category_hot as $id => $value)
														<?php $index = $loop->index + 1;?>
														@include('backend.repeater.row-category-hot')
													@endforeach
												@endif
						                    </tbody>
						                </table>
						                <div class="text-right">
						                    <button class="btn btn-primary" 
								            	onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'category-hot', '.category-hot')">Thêm
								            </button>
						                </div>
						            </div>
				    			</div>
				    			<div class="col-sm-6">
				    				<div class="repeater" id="repeater">
					    				<label for="">Chọn danh mục</label>
					    				<table class="table table-bordered table-hover category">
						                    <thead>
							                    <tr>
							                    	<th style="width: 30px;">STT</th>
							                    	<th>Danh mục</th>
							                    	<th style="width: 20px"></th>
							                    </tr>
						                	</thead>
						                    <tbody id="sortable">
												@if (!empty($content->category))
													@foreach ($content->category as $id => $value)
														<?php $index = $loop->index + 1;?>
														@include('backend.repeater.row-category')
													@endforeach
												@endif
						                    </tbody>
						                </table>
						                <div class="text-right">
						                    <button class="btn btn-primary" 
								            	onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'category', '.category')">Thêm
								            </button>
						                </div>
						            </div>
				    			</div>
				    		</div>
				    	</div>
				    	<div class="tab-pane" id="activity3">
				    		<div class="repeater" id="repeater">
				                <table class="table table-bordered table-hover banners-mid">
				                    <thead>
					                    <tr>
					                    	<th style="width: 30px;">STT</th>
					                    	<th width="200px">Hình ảnh</th>
					                    	<th>Mô tả - Liên kết</th>
					                    	<th style="width: 20px"></th>
					                    </tr>
				                	</thead>
				                    <tbody id="sortable">
										@if (!empty($content->banner_mid))
											@foreach ($content->banner_mid as $id => $value)
												<?php $index = $loop->index + 1;?>
												@include('backend.repeater.row-banner-home-mid')
											@endforeach
										@endif
				                    </tbody>
				                </table>
				                <div class="text-right">
				                    <button class="btn btn-primary" 
						            	onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'banner-home-mid', '.banners-mid')">Thêm
						            </button>
				                </div>
				            </div>
				    	</div>
				    	<div class="tab-pane" id="activity4">
				    		<div class="repeater" id="repeater">
				                <table class="table table-bordered table-hover partner">
				                    <thead>
					                    <tr>
					                    	<th style="width: 30px;">STT</th>
					                    	<th width="200px">Logo</th>
					                    	<th>Mô tả - Liên kết</th>
					                    	<th style="width: 20px"></th>
					                    </tr>
				                	</thead>
				                    <tbody id="sortable">
										@if (!empty($content->partner))
											@foreach ($content->partner as $id => $value)
												<?php $index = $loop->index + 1;?>
												@include('backend.repeater.row-partner')
											@endforeach
										@endif
				                    </tbody>
				                </table>
				                <div class="text-right">
				                    <button class="btn btn-primary" 
						            	onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'partner', '.partner')">Thêm
						            </button>
				                </div>
				            </div>
				    	</div>
				    	<div class="tab-pane" id="activity5">
				    		<div class="row">
				    			<div class="col-sm-2">
				    				<div class="form-group">
										<label for="">Hình ảnh đại diện video</label>
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
				    					<textarea class="form-control" rows="5" name="content[video][iframe]">{{ @$content->video->iframe }}</textarea>
				    				</div>
				    			</div>
				    		</div>
				    	</div>

				    	<div class="tab-pane" id="seo">
							<div class="row">
								
								
								<div class="col-sm-10">
									
									
									<div class="form-group">
										<label for="">Tiêu đề thẻ H1 ẩn</label>
										<input type="text" name="title_h1" class="form-control" value="{!! @$data->title_h1 !!}">
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