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

			<div class="row">

				<div class="col-sm-9">

					<div class="nav-tabs-custom">
						<input type="hidden" name="active_tab" id="active_tab" value="">
		                <ul class="nav nav-tabs">

		                    <li class="@if(!session('active_tab') || session('active_tab')=='' || session('thong-tin')) active @endif" data-tab="thong-tin">

		                        <a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin</a>

		                    </li>

		                    <li @if(session('active_tab')=='phien-ban') class="active" @endif data-tab="phien-ban">

		                    	<a href="#vesions" data-toggle="tab" aria-expanded="true">Phiên bản</a>

		                    </li>

		                    <li @if(session('active_tab')=='thuoc-tinh') class="active" @endif data-tab="thuoc-tinh">

		                    	<a href="#attributes" data-toggle="tab" aria-expanded="true">Thuộc tính</a>

		                    </li>

		                    {{-- <li class="">

		                    	<a href="#attributes" data-toggle="tab" aria-expanded="true">Thuộc tính</a>

		                    </li> --}}

		                    @if(isUpdate(@$module['action']))

		                    	<li @if(session('active_tab')=='qua-tang') class="active" @endif data-tab="qua-tang">

			                    	<a href="#gift" data-toggle="tab" aria-expanded="true">Quà tặng</a>

			                    </li>

			                    <li  @if(session('active_tab')=='tieu-chi') class="active" @endif  data-tab="tieu-chi">

			                    	<a href="#product_questions" data-toggle="tab" aria-expanded="true">Tiêu chí đánh giá</a>

			                    </li>

		                    @endif

		                    <li  @if(session('active_tab')=='thu-vien-anh') class="active" @endif data-tab="thu-vien-anh">

		                    	<a href="#gallery" data-toggle="tab" aria-expanded="true">Thư viện ảnh</a>

		                    </li>

		                   

		                    <li  @if(session('active_tab')=='cau-hinh-seo') class="active" @endif data-tab="cau-hinh-seo">

		                    	<a href="#setting" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>

		                    </li>

		                    <li  @if(session('active_tab')=='tags') class="active" @endif data-tab="tags">

		                    	<a href="#tags" data-toggle="tab" aria-expanded="true">Tags</a>

		                    </li>

		                     @if(isUpdate(@$module['action']))

			                    <li  @if(session('active_tab')=='anh-theo-mau') class="active" @endif data-tab="anh-theo-mau">

			                    	<a href="#gallery_by_color" data-toggle="tab" aria-expanded="true">Ảnh theo màu sắc</a>

			                    </li>

		                    @endif

		                </ul>

		                <div class="tab-content">



		                    <div class="tab-pane  @if(!session('active_tab') || session('active_tab')=='' || session('active_tab')=='thong-tin') active @endif" id="activity">

		                    	<div class="row">

		                    		<?php 

		                    			$sku = old('sku', @$data->sku);

		                    			if(empty($sku)){

		                    				$sku = generateRandomCode();

		                    			}

		                    		?>

		                    		<div class="col-sm-12">

		                    			<div class="form-group">

				                    		<label for="">SKU</label>

				                    		<input type="text" name="sku" class="form-control" value="{{ @$sku }}">

				                    	</div>

		                    		</div>

		                    		<div class="col-sm-12">



		                    			<div class="form-group">

				                    		<label for="">Tên sản phẩm</label>

				                    		<input type="text" name="name" id="name" class="form-control" value="{{ old('name', @$data->name) }}">

				                    	</div>

										

										@if(isUpdate(@$module['action']))

			                                <div class="form-group" id="edit-slug-box">

			                                    @include('backend.products.permalink')

			                                </div>

		                                @endif



		                    		</div>



		                    		<div class="col-sm-6">

		                    			<div class="form-group">

				                    		<label for="">Giá bán</label>

				                    		<input type="number" name="regular_price" class="form-control" 

				                    		value="{{ old('regular_price', @$data->regular_price) }}">

				                    	</div>

		                    		</div>

		                    		<div class="col-sm-6">

		                    			<div class="form-group">

				                    		<label for="">Giá khuyến mại ( Nếu có )</label>

				                    		<input type="number" name="sale_price" class="form-control" 

				                    		value="{{ old('sale_price', @$data->sale_price) }}">

				                    	</div>

		                    		</div>





		                    		<div class="col-sm-6">

		                    			<div class="form-group">

		                    				<label for="">Giá ưu tiên (Nếu có)</label>

		                    				<input type="number" class="form-control" name="price_priority" value="{{ old("price_priority", @$data->price_priority) }}">

		                    			</div>

		                    		</div>



		                    		<div class="col-sm-6">

		                    			<div class="form-group">

		                    				<label for="">Thời gian áp dụng giá ưu tiên (Nếu có)</label>

		                    				<div class="input-group">

							                  	<div class="input-group-addon">

							                    	<i class="fa fa-calendar"></i>

							                  	</div>

							                  	<input type="text" class="form-control pull-right" id="reservation" name="time_priority">

							                </div>

		                    			</div>

		                    		</div>





		                    		<div class="col-sm-12">

		                    			<div class="form-group">

				                    		<label for="">Thương hiệu ( Nếu có )</label>

				                    		<select name="brand_id" class="form-control multislt">

				                    			<option value="">---Chọn thương hiệu---</option>

				                    			@foreach ($brands as $item)

				                    				<option value="{{ $item->id }}" {{ $item->id == @$data->brand_id ? 'selected' : null }} >

				                    					{{ $item->name }}

				                    				</option>

				                    			@endforeach

				                    		</select>

				                    	</div>

		                    		</div>





		                    		<div class="col-sm-12">

										<div class="form-group">

											<label for="">Bảo hành</label>

											<input type="text" class="form-control" name="warranty_parameter" value="{{ @$data->warranty_parameter }}">

										</div>



		                    			<div class="form-group">

		                    				<label for="">Mô tả ngắn</label>

		                    				<textarea class="form-control" rows="5" name="sort_desc">{{ old('sort_desc', @$data->sort_desc) }}</textarea>

		                    			</div>

		                    			<div class="form-group">

		                    				<label for="">Mô tả</label>

		                    				<textarea class="content" name="content">{!! old('content', @$data->content) !!}</textarea>

		                    			</div>



		                    			<div class="form-group">

		                    				<label for="">Thông số kỹ thuật</label>

		                    				<textarea class="content" name="specifications">{!! old('specifications', @$data->specifications) !!}</textarea>

		                    			</div>





		                    		</div>



		                    		<div class="col-sm-12">

		                    			<label for="">Dịch vụ bảo hành thêm</label>	

										<div class="repeater" id="repeater">

							                 <table class="table table-bordered table-hover content_services_warranty">

							                    <thead>

								                    <tr>

								                    	<th style="width: 30px;">STT</th>

								                    	<th>Tiêu đề</th>

								                    	<th>Giá cộng thêm</th>

								                    	<th style="width: 30px;"></th>

								                    </tr>

							                	</thead>

							                    <tbody id="sortable">

							                    	@if (!empty($data->content_services_warranty))

							                    		<?php $services = json_decode( $data->content_services_warranty ); ?>

							                    		@if (!empty($services->services))

							                    			@foreach ($services->services as $id => $value)

							                    				<?php $index = $loop->index + 1; ?>

							                    				@include('backend.repeater.row-products-services-warranty');

							                    			@endforeach

							                    		@endif

							                    	@endif

												</tbody>

							                </table>

							               	<div class="text-right">

							                    <button class="btn btn-primary" onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'products-services-warranty',

							                     '.content_services_warranty')">Thêm</button>

						                	</div>

							            </div>

						            </div>

		                    	</div>

		                    </div>



		                    <div class="tab-pane @if(session('active_tab')=='thu-vien-anh') active @endif" id="gallery">

		                    	<div class="row">

			                        <div class="col-sm-12 image">

			                        	<label for="">Hình ảnh chi tiết sản phẩm</label><br>

			                            <button type="button" class="btn btn-success" onclick="fileMultiSelect(this)"><i class="fa fa-upload"></i>  

			                                Chọn hình ảnh

			                            </button>

			                            <br><br>

			                            <div class="image__gallery">

			                            	<?php 

			                            		if(isUpdate(@$module['action'])){

			                            			$gallery = @$data->ProductImage()->where('type', 'more_image_product')->where('key_color_filter', null)->get();

			                            		}

			                            	?>

			                                @if (!empty($gallery))

			                                    @foreach ($gallery as $item)

			                                        <div class="image__thumbnail image__thumbnail--style-1">

			                                            <img src="{{ $item->image }}">

			                                            <a href="javascript:void(0)" class="image__delete" onclick="urlFileMultiDelete(this)">

			                                                <i class="fa fa-times"></i>

			                                            </a>

			                                            <input type="hidden" name="gallery[]" value="{{ $item->image }}">

			                                        </div>

			                                    @endforeach

			                                @endif

			                            </div>

			                        </div>



									<div class="col-sm-12 image" style="margin-top: 10px">

			                        	<label for="">Hình ảnh từ khách hàng</label><br>

			                            <button type="button" class="btn btn-success" onclick="fileMultiSelectCustom(this, 'image_reviews')"><i class="fa fa-upload"></i>  

			                                Chọn hình ảnh

			                            </button>

			                            <br><br>

			                            <div class="image__gallery">

			                            	<?php 

			                            		if(isUpdate(@$module['action'])){

			                            			$image_reviews = @$data->ProductImage()->where('type', 'image_reviews_customer')->get();

			                            		}

			                            	?>

			                                @if (!empty($image_reviews))

			                                    @foreach ($image_reviews as $item)

			                                        <div class="image__thumbnail image__thumbnail--style-1">

			                                            <img src="{{ $item->image }}">

			                                            <a href="javascript:void(0)" class="image__delete" onclick="urlFileMultiDelete(this)">

			                                                <i class="fa fa-times"></i>

			                                            </a>

			                                            <input type="hidden" name="image_reviews[]" value="{{ $item->image }}">

			                                        </div>

			                                    @endforeach

			                                @endif

			                            </div>

			                        </div>



			                    </div>

		                    </div>

		                    <div class="tab-pane @if(session('active_tab')=='phien-ban') active @endif" id="vesions">

		                    	<div class="row">

					                <div class="col-sm-12">

										<div class="repeater" id="repeater">

							                 <table class="table table-bordered table-hover products-version">

							                    <thead>

								                    <tr>

								                    	<th style="width: 30px;">STT</th>

								                    	<th>Loại thuộc tính</th>

								                    	<th>Giá trị</th>

								                    	<th>Giá trên lệch</th>

								                    	<th style="width: 30px;"></th>

								                    </tr>

							                	</thead>

							                    <tbody id="sortable">

							                    	<?php $ProductVersion = @$data->ProductVersion; ?>

							                    	@if (!empty($ProductVersion))

							                    		@foreach (@$data->ProductVersion()->orderBy('id', 'ASC')->get() as $attribute)

							                    			<tr>

																<td class="index">{{ $loop->index + 1 }}</td>

																<?php $product_attribute_types = \App\Models\ProductAttributeTypes::all(); ?>

																<td>

																	<select name="product_version[{{ $loop->index + 1 }}][id_product_attribute_types]" class="form-control">

																		@foreach ($product_attribute_types as $item)

																			<option value="{{ $item->id }}" 

																				{{ $attribute->id_product_attribute_types == $item->id ? 'selected' : null  }}>

																				{{ $item->name }}

																			</option>

																		@endforeach

																	</select>

																</td>

																<td><input type="text" class="form-control" name="product_version[{{ $loop->index + 1 }}][key]" value="{{ $attribute->key }}" required=""></td>

																<td><input type="number" class="form-control" name="product_version[{{ $loop->index + 1 }}][value]" required="" value="{{ $attribute->value }}"></td>

															    <td style="text-align: center;">

															        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">

															            <i class="fa fa-minus"></i>

															        </a>

															    </td>

															</tr>

							                    		@endforeach

							                    	@endif

												</tbody>

							                </table>

							               	<div class="text-right">

							                    <button class="btn btn-primary" onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'products-version')">Thêm</button>

						                	</div>

							            </div>

						            </div>

		                    	</div>

		                    </div>



		                    <div class="tab-pane @if(session('active_tab')=='thuoc-tinh') active @endif" id="attributes">

		                    	<div class="row">

					                <div class="col-sm-12">

										<div class="repeater" id="repeater">

							                 <table class="table table-bordered table-hover">

							                    <thead>

								                    <tr>

								                    	<th style="width: 30px;">STT</th>

								                    	<th>Loại thuộc tính</th>

								                    	<th>Giá trị</th>

								                    	<th style="width: 30px;"></th>

								                    </tr>

							                	</thead>

							                    <tbody id="sortable">

							                    	<?php $productAttributes = @$data->ProductAttributes ?>

							                    	@if (!empty($productAttributes))

							                    		@foreach ($productAttributes as $attribute)

							                    			<tr>

																<td class="index">{{ $loop->index + 1 }}</td>

																<?php $product_attribute_types = \App\Models\ProductAttributeTypes::all(); ?>

																<td>

																	<select name="product_attributes[{{ $loop->index + 1 }}][id_product_attribute_types]" class="form-control">

																		@foreach ($product_attribute_types as $item)

																			<option value="{{ $item->id }}" 

																				{{ $attribute->id_product_attribute_types == $item->id ? 'selected' : null  }}>

																				{{ $item->name }}

																			</option>

																		@endforeach

																	</select>

																</td>

																<td><input type="text" class="form-control" name="product_attributes[{{ $loop->index + 1 }}][key]" value="{{ $attribute->key }}" required=""></td>

															    <td style="text-align: center;">

															        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">

															            <i class="fa fa-minus"></i>

															        </a>

															    </td>

															</tr>

							                    		@endforeach

							                    	@endif

												</tbody>

							                </table>

							               	<div class="text-right">

							                    <button class="btn btn-primary" onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'products-attributes')">Thêm</button>

						                	</div>

							            </div>

						            </div>

		                    	</div>

		                    </div>

							

							@if(isUpdate(@$module['action']))

			                    <div class="tab-pane @if(session('active_tab')=='qua-tang') active @endif" id="gift">

			                    	<div class="row">

			                    		<div class="col-sm-12">

			                    			<div class="form-group">

			                    				<label for="">Mô tả khuyến mại</label>

			                    				<input type="text" class="form-control" name="title_desc_gift" value="{{ old('title_desc_gift', @$data->title_desc_gift ) }}">

			                    			</div>

			                    			<div class="form-group row">

			                    				<div class="col-sm-12">

			                    					<label for="">Ngày kết thúc</label>

			                    					<div class="input-group date">

									                  	<div class="input-group-addon">

									                    	<i class="fa fa-calendar"></i>

									                  	</div>

									                  	<?php if(!empty($data->end_date_apply_gift)){

									                  		$end_date_apply_gift = \Carbon\Carbon::parse($data->end_date_apply_gift)->format('d/m/Y');

									                  	} ?>

														<input type="text" class="form-control pull-right datepicker" name="end_date_apply_gift" 

														value="{{ old('end_date_apply_gift', @$end_date_apply_gift ) }}" readonly="" 

														style="background-color: #fff; opacity: 1">

									                </div>

			                    				</div>

			                    			</div>

			                    		</div>

			                    		<div class="col-sm-12">

											<div class="form-group">

												<a href="{{ route('product-gift.create', ['id'=> $data->id]) }}" class="btn btn-primary">Thêm mới khuyến mại</a>

											</div>



											<table id="example1" class="table table-bordered table-striped table-hover">

							                    <thead>

							                        <tr>

							                            <th width="30px"><input type="checkbox" name="chkAll" id="chkAll"></th>

							                            <th width="30px">STT</th>

							                            <th>Mô tả</th>

							                            <th width="100px"> Thao tác</th>

							                        </tr>

							                    </thead>

							                    <tbody>

							                    	<?php $productsGift = \App\Models\ProductGift::where('id_product', $data->id)->orderBy('created_at', 'ASC')->get();  ?>

							                        @foreach ($productsGift as $item)

							                            <tr>

							                                <td><input type="checkbox" name="chkItem[]" value="{!! $item['id'] !!}"></td>

							                                <td>{{ $loop->index + 1 }}</td>

							                                <td>{!! strip_tags($item->desc) !!}</td>

							                                <td>

							                                    <div>

							                                        <a href="{{ route('product-gift.edit', ['id'=> $item->id]) }}?id={{ $data->id }}" title="Sửa">

							                                            <i class="fa fa-pencil fa-fw"></i> Sửa

							                                        </a> &nbsp; &nbsp; &nbsp;

							                                          <a href="javascript:void(0);" class="btn-destroy" 

							                                          data-href="{{ route( 'product-gift.destroy',  $item->id ) }}"

							                                          data-toggle="modal" data-target="#confim">

							                                          <i class="fa fa-trash-o fa-fw"></i> Xóa

							                                        </a>

							                                    </div>

							                                </td>

							                            </tr>

							                        @endforeach

							                    </tbody>

							                </table>

							            </div>

			                    	</div>

			                    </div>

		                    @endif



		                    <div class="tab-pane @if(session('active_tab')=='tieu-chi') active @endif" id="product_questions">

		                    	@if(isUpdate(@$module['action']))

		                    		<div class="btnAdd">

					                    <a href="javascript:;" data-toggle="modal" data-target="#product_questions_add">

					                        <fa class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới câu hỏi</fa>

					                    </a>

					                </div>

		                    		<table id="example1" class="table table-bordered table-striped table-hover">

					                    <thead>

					                        <tr>

					                            <th width="30px"><input type="checkbox" name="chkAll" id="chkAll"></th>

					                            <th width="30px">STT</th>

					                            <th>Câu hỏi</th>

					                            <th width="100px">Thao tác</th>

					                        </tr>

					                    </thead>

					                    <tbody>

					                    	<?php $questions = $data->ProductQuestions()->order()->get() ?>

					                        @if (count($questions))

					                        	@foreach ($questions as $item)

					                        		<tr>

					                        			<td><input type="checkbox" name="chkItem[]" value="{!! $item['id'] !!}"></td>

                                						<td>{{ $loop->index + 1 }}</td>

                                						<td>{{ $item->content }}</td>

                                						<td>

                                							<div>

						                                        <a href="javascript:;" class="btn-edit-questions" data-content="{{ $item->content }}" data-href="{{ route('products.questions.edit', $item->id) }}" data-toggle="modal" data-target="#product_questions_edit">

						                                            <i class="fa fa-pencil fa-fw"></i> Sửa

						                                        </a> &nbsp; &nbsp; &nbsp;

						                                          <a href="javascript:;" class="btn-destroy" 

						                                          data-href="{{ route( 'products.questions.delete',  $item->id ) }}"

						                                          data-toggle="modal" data-target="#confim">

						                                          <i class="fa fa-trash-o fa-fw"></i> Xóa

						                                        </a>

						                                    </div>

                                						</td>

					                        		</tr>

					                        	@endforeach

					                        @endif

					                    </tbody>

					                </table>

		                    	@endif

		                    </div>



		                    <div class="tab-pane @if(session('active_tab')=='cau-hinh-seo') active @endif" id="setting">

		                    	<div class="form-group">

			                        <label>Title SEO</label>

			                        <label style="float: right;">Số ký tự đã dùng: <span id="countTitle">{{ @$data->meta_title != null ? mb_strlen( $data->meta_title, 'UTF-8') : 0 }}/70</span></label>

			                        <input type="text" class="form-control" name="meta_title" value="{!! old('meta_title', isset($data->meta_title) ? $data->meta_title : null) !!}" id="meta_title">

			                    </div>



			                    <div class="form-group">

			                        <label>Meta Description</label>

			                        <label style="float: right;">Số ký tự đã dùng: <span id="countMeta">{{ @$data->meta_description != null ? mb_strlen( $data->meta_description, 'UTF-8') : 0 }}/360</span></label>

			                        <textarea name="meta_description" class="form-control" id="meta_description" rows="3">{!! old('meta_description', isset($data->meta_description) ? $data->meta_description : null) !!}</textarea>

			                    </div>



			                    <div class="form-group">

			                        <label>Meta Keyword</label>

			                        <input type="text" class="form-control" name="meta_keyword" value="{!! old('meta_keyword', isset($data->meta_keyword) ? $data->meta_keyword : null) !!}">

			                    </div>

			                    @if(isUpdate(@$module['action']))

				                    <h4 class="ui-heading">Xem trước kết quả tìm kiếm</h4>

				                    <div class="google-preview">

				                        <span class="google__title"><span>{!! !empty($data->meta_title) ? $data->meta_title : @$data->name !!}</span></span>

				                        <div class="google__url">

				                            {{ asset( 'san-pham/'.$data->slug.'-'.$data->id ) }}

				                        </div>

				                        <div class="google__description">{!! old('meta_description', isset($data->meta_description) ? @$data->meta_description : '') !!}</div>

				                    </div>

			                    @endif

		                    </div>



		                    <div class="tab-pane @if(session('active_tab')=='tags') active @endif" id="tags">

		                    	@if (isUpdate(@$module['action']))

		                    		<?php if(!empty(@$data->tagNames())){

		                    			$tags = implode(',', @$data->tagNames());

		                    		} ?>

		                    	@endif

		                    	

	                    		

                    			<div class="form-group">

                    				<label for="">Tags</label>

                    				<input type="text" class="demo-default" id="tags-input" name="tags" data-role="tagsinput" value="{{ @$tags }}">

                    			</div>

                    		

		                    </div>

							@if (isUpdate(@$module['action']))

			                    <div class="tab-pane @if(session('active_tab')=='anh-theo-mau') active @endif" id="gallery_by_color">

			                    	<div class="row">

				                    	<?php 

				                    		$productAttributeTypes = \App\Models\ProductAttributeTypes::where('type', 'color')->first();

				                    		$libary = $data->ProductVersion()->where('id_product_attribute_types', $productAttributeTypes->id)->get();

				                    	?>

				                    	@if (!empty($libary))

				                    		@foreach ($libary as $item)

				                    			<div class="col-sm-3">

				                    				<label for="">Ảnh màu: {{ $item->key }}</label>

				                    				<div class="form-group">

								                        <div class="image">

								                        	<?php $images_by_color = @$data->ProductImage()->where('type', 'more_image_product')->where('key_color_filter',  $item->key)->first(); ?>

								                            <div class="image__thumbnail">

								                                <img src="{{ !empty($images_by_color->image) ? $images_by_color->image : __IMAGE_DEFAULT__ }}"

								                                     data-init="{{ __IMAGE_DEFAULT__ }}">

								                                <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">

								                                    <i class="fa fa-times"></i></a>

								                                <input type="hidden" value="{{ !empty($images_by_color->image) ? $images_by_color->image : null }}" name="image_by_color[{{ $item->key }}][image]"/>

								                                <div class="image__button" onclick="fileSelect(this)">

								                                	<i class="fa fa-upload"></i>

								                                    Upload

								                                </div>

								                            </div>

								                        </div>

								                    </div>

				                    			</div>

				                    		@endforeach

				                    	@endif

									</div>

			                    </div>



		                    @endif

		                </div>

		            </div>

				</div>

				<div class="col-sm-3">

					<div class="box box-success">

		                <div class="box-header with-border">

		                    <h3 class="box-title">Đăng sản phẩm</h3>

		                </div>

		                <div class="box-body">

		                    <div class="form-group">

		                        <label class="custom-checkbox">

		                        	@if(isUpdate(@$module['action']))

		                            	<input type="checkbox" name="status" value="1" {{ @$data->status == 1 ? 'checked' : null }}> Hiển thị

		                            @else

		                            	<input type="checkbox" name="status" value="1" checked> Hiển thị

		                            @endif

		                        </label>

								<label class="custom-checkbox">

									@if(isUpdate(@$module['action']))

		                            	<input type="checkbox" name="hot" value="1" {{ @$data->is_hot == 1 ? 'checked' : null }}> Nổi bật

		                            @else

		                            	<input type="checkbox" name="hot" value="1" checked> Nổi bật

		                            @endif

		                        </label>

		                        

		                        <label class="custom-checkbox">

									@if(isUpdate(@$module['action']))

										<input type="checkbox" name="is_flash_sale" value="1" {{ @$data->is_flash_sale == 1 ? 'checked' : null }}> Flash sale

									@else

		                            	<input type="checkbox" name="is_flash_sale" value="1" checked> Flash sale

		                            @endif

		                        </label>



		                        <label class="custom-checkbox">

									@if(isUpdate(@$module['action']))

										<input type="checkbox" name="is_price_shock" value="1" {{ @$data->is_price_shock == 1 ? 'checked' : null }}> Sản phẩm giá sốc

									@else

		                            	<input type="checkbox" name="is_price_shock" value="1" checked> Sản phẩm giá sốc

		                            @endif

		                        </label>

								<label class="custom-checkbox">

									@if(isUpdate(@$module['action']))

										<input type="checkbox" name="is_selling" value="1" {{ @$data->is_selling == 1 ? 'checked' : null }}> Sản phẩm bán chạy

									@else

		                            	<input type="checkbox" name="is_selling" value="1" checked> Sản phẩm bán chạy

		                            @endif

		                        </label>

								

		                        

		                        <label class="custom-checkbox">

									@if(isUpdate(@$module['action']))

										<input type="checkbox" name="is_apply_gift" value="1" {{ @$data->is_apply_gift == 1 ? 'checked' : null }}> Kích hoạt quà tặng

									@else

		                            	<input type="checkbox" name="is_apply_gift" value="1"> Kích hoạt quà tặng

		                            @endif

		                        </label> 



		                        <div class="form-group" style="margin-top: 10px">

		                        	<label for="">Số thứ tự trang khuyến mại</label>

		                        	<?php if(isUpdate(@$module['action'])){

										$orders = old('orders', @$data->order_sale_page);

									}else{

										$orders = old('orders', \App\Models\Products::where('is_flash_sale', 1)->count());

									} ?>

		                        	<input type="number" value="{{ @$orders }}" class="form-control" name="order_sale_page">

		                        </div>



		                    </div>

		                    <div class="form-group text-right">

		                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại sản phẩm</button>

		                    </div>

		                </div>

		            </div>

		            <div class="box box-success category-box">

		                <div class="box-header with-border">

		                    <h3 class="box-title">Danh mục sản phẩm </h3>

		                </div>

		                <div class="box-body checkboxlist">

		                	<?php 

		                        $category_list = [];

		                        if(!empty(@$data->category)){

		                           $category_list = @$data->category->pluck('id')->toArray();

		                        }

		                    ?>

		                    @if (!empty($categories))

		                        @foreach ($categories as $item)

		                            @if ($item->parent_id == 0)

		                                <label class="custom-checkbox">

		                                    <input type="checkbox" class="category" name="category[]" value="{{ $item->id }}" {{ in_array( $item->id, $category_list ) ? 'checked' : null }}> {{ $item->name }}

		                                 </label>

		                                 <?php checkBoxCategory( $categories, $item->id, $item, $category_list ) ?>

		                            @endif

		                        @endforeach

		                    @endif

		                </div>

		            </div>

		            <div class="box box-success">

		                <div class="box-header with-border">

		                    <h3 class="box-title">Ảnh sản phẩm</h3>

		                </div>

		                <div class="box-body">

		                    <div class="form-group" style="text-align: center;">

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

		            </div>

				</div>

			</div>

		</form>

	</div>



	<!-- Modal Product Questions Add-->

	<div class="modal fade" id="product_questions_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

	    <div class="modal-dialog" role="document">

	        <div class="modal-content">

	        	<form action="{{ route('products.questions.add') }}" method="POST">

	        		@csrf

	        		<input type="hidden" value="{{ @$data->id }}" name="product_id">

		            <div class="modal-header">

		                <h5 class="modal-title" id="exampleModalLabel">Thêm mới câu hỏi</h5>

		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

		                    <span aria-hidden="true">&times;</span>

		                </button>

		            </div>

		            <div class="modal-body">

		                <div class="form-group">

		                	<label for="">Nội dung câu hỏi</label>

		                	<textarea name="content" class="form-control" rows="5" required=""></textarea>

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





	<!-- Modal Product Questions Edit-->

	<div class="modal fade" id="product_questions_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

	    <div class="modal-dialog" role="document">

	        <div class="modal-content">

	        	<form action="" method="POST" id="frm-edit-questions-edit">

	        		@csrf

	        		<input type="hidden" value="{{ @$data->id }}" name="product_id">

		            <div class="modal-header">

		                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa câu hỏi</h5>

		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

		                    <span aria-hidden="true">&times;</span>

		                </button>

		            </div>

		            <div class="modal-body">

		                <div class="form-group">

		                	<label for="">Nội dung câu hỏi</label>

		                	<textarea name="content" class="form-control" rows="5" id="content_questions_edit" required=""></textarea>

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



@section('scripts')

	<script src="{{ url('public/backend/plugins/datetimepicker/bootstrap-datepicker.min.js') }}"></script>

	

	<script>

		$(document).on('ready', function() {

		    $('.multislt').select2({

		        placeholder: "Chọn thương hiệu",

		    });

		});

	</script>

	<script>

		jQuery(document).ready(function($) {

			$('#btn-ok').click(function(event) {

		        var slug_new = $('#new-post-slug').val();

		        var name = $('#name').val();

		        $.ajax({

		        	url: '{{ route('products.get-slug') }}',

		        	type: 'GET',

		        	data: {

		        		id: $('#idPost').val(),

		        		slug : slug_new.length > 0 ? slug_new : name,

		        	},

		        })

		        .done(function(data) {

		        	$('#change_slug').show();

			        $('#btn-ok').hide();

			        $('.cancel.button-link').hide();

			        $('#current-slug').val(data);

		        	cancelInput(data);

		        })

		    });

		});	

	</script>



	<script>

		jQuery(document).ready(function($) {

			$('.datepicker').datepicker({

				format: 'dd/mm/yyyy',

		      	autoclose: true

		    });

		});	

	</script>

	<script>

		jQuery(document).ready(function($) {

			$('.btn-edit-questions').click(function(event) {

				$('#content_questions_edit').val($(this).data('content'));

				$('#frm-edit-questions-edit').attr('action', $(this).data('href'));

			});

		});

	</script>



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



			$('#reservation').daterangepicker({

		         autoUpdateInput: false,

		         "locale": {

		            "format": "DD-MM-YYYY",

		            "applyLabel": "Áp dụng",

		            "cancelLabel": "Hủy bỏ",

		            "daysOfWeek": [

		                "T2",

		                "T3",

		                "T4",

		                "T5",

		                "T6",

		                "T7",

		                "CN"

		            ],

		            "monthNames": [

		                "Tháng 1 - ",

		                "Tháng 2 - ",

		                "Tháng 3 - ",

		                "Tháng 4 - ",

		                "Tháng 5 - ",

		                "Tháng 6 - ",

		                "Tháng 7 - ",

		                "Tháng 8 - ",

		                "Tháng 9 - ",

		                "Tháng 10 - ",

		                "Tháng 11 - ",

		                "Tháng 12 - "

		            ]

		        }

		    });

		    $('#reservation').on('apply.daterangepicker', function(ev, picker) {

		        $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));

		    });



		    $('#reservation').on('cancel.daterangepicker', function(ev, picker) {

		        $(this).val('');

		    });

			

		    <?php 

		    	$time_priority = old("time_priority", @$data->time_priority)



		    ?>

		    @if (!empty($time_priority))

		    	<?php $time_priority = explode(' - ', $time_priority); ?>

		    	order = { order_sdate : "{{ $time_priority[0] }}", order_edate : "{{ $time_priority[1] }}" };

				jQuery( "#reservation" ).val( order.order_sdate + " - " + order.order_edate );

				jQuery( "#reservation" ).data('daterangepicker').startDate = moment( order.order_sdate, "DD-MM-YYYY" );

				jQuery( "#reservation" ).data('daterangepicker').endDate = moment( order.order_edate, "DD-MM-YYYY" );

				jQuery( "#reservation" ).data('daterangepicker').updateView();

				jQuery( "#reservation" ).data('daterangepicker').updateCalendars();

		    @endif

			$('.nav-tabs-custom li').on('click',function(){
				console.log(22);
				var tab_name = $(this).data('tab');
				$('#active_tab').val(tab_name);
			})



			

		});

	</script>

@endsection



@section('css')

	<link rel="stylesheet" href="{{ url('public/backend/plugins/datetimepicker/bootstrap-timepicker.css') }}">

	<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="{{ url('public/backend/plugins/taginput/bootstrap-tagsinput.css') }}">

@endsection