@extends('frontend.master')
@section('main')
	<section id="bread">
		<div class="container">
			<div class="content">
				<ul class="list-inline">
					<li class="list-inline-item"><a title="Trang chủ" href="{{ url('/') }}">Trang chủ</a></li>
					<li class="list-inline-item"><a title="Sản phẩm" href="{{ route('home.list.product') }}">Sản phẩm</a></li>
					<li class="list-inline-item"><a title="Sản phẩm" href="{{ route('home.archive.product', $data->category[0]->slug) }}">{{ $data->category[0]->name }}</a></li>
					<li class="list-inline-item"><a title="" href="javascript:0">{{ $data->name }}</a></li>
				</ul>
			</div>
		</div>
	</section>
	<style>
		.nb{
			cursor: pointer;
		}
	</style>

	<section id="preview" class="pt-20">
		<div class="container">
			<div class="content">
				<div class="row">
					<div class="col-md-6">
						<div class="left">
							<div class="slide-thumbs">
								<div class="slider-for">
									@if (!empty(request('view')))
										<?php 
											$image_by_color = $data->ProductImage()->where('image', '!=', null)->where('type', 'more_image_product')
												->where('key_color_filter', request('view'))->first();
											if(!empty($image_by_color->image)){
												$image_by_color_url = $image_by_color->image;
											}else{
												$image_by_color_url = $data->image;
											}
										?>
										<div class="carousel-item">
	                                    	<a title="{{ $data->name }}" href="{{ $data->image }}" data-fancybox="group" class ="lightbox" data-fancybox="lib-1">
	                                    		<img src="{{ $image_by_color_url }}" class="img-fluid" width="100%" alt="{{ $data->name }}">
	                                    	</a>
	                                    </div>
									@else
										<div class="carousel-item">
	                                    	<a title="{{ $data->name }}" href="{{ $data->image }}" data-fancybox="group" class ="lightbox" data-fancybox="lib-1">
	                                    		<img src="{{ $data->image }}" class="img-fluid" width="100%" alt="{{ $data->name }}">
	                                    	</a>
	                                    </div>
									@endif
                                    
                                    @if (count($data->ProductImage()->where('type', 'more_image_product')->where('image', '!=', null)->get()))
                                    	@foreach ($data->ProductImage()->where('type', 'more_image_product')->where('image', '!=', null)->get() as $item)
                                    		<div class="carousel-item">
		                                    	<a title="{{ $data->name }}" href="{{ $item->image }}" data-fancybox="group" class ="lightbox" data-fancybox="lib-1">
		                                    		<img src="{{ $item->image }}" class="img-fluid" width="100%" alt="{{ $data->name }}">
		                                    	</a>
		                                    </div>
                                    	@endforeach
                                    @endif
                                </div>
                              
                                <!--/.Slides-->
                                <div class="box-slide-nv">
                                	<div class="slider-nav">
	                                    <div class="clc">
	                                     	<img class="" src="{{ $data->image }}" width="100%" alt="{{ $data->name }}">
	                                     </div>
	                                     @if (count($data->ProductImage()->where('image', '!=', null)->where('type', 'more_image_product')->get()))
	                                    	@foreach ($data->ProductImage()->where('image', '!=', null)->where('type', 'more_image_product')->get() as $item)
												<div class="clc">
			                                     	<img class="" src="{{ $item->image }}" width="100%" alt="{{ $data->name }}">
			                                     </div>
	                                    	@endforeach
	                                    @endif
	                                </div>
	                                @if ($data->ProductImage()->where('type', 'more_image_product')->count() > 3)
	                                	<div class="numb-nav"><span>+{{ $data->ProductImage()->where('type', 'more_image_product')->count() - 3 }}</span></div>
	                                @endif
	                                
                                </div>

							</div>
						</div>
					</div>
					<div class="col-md-6">
						<form action="{{ route('home.post-add-cart') }}" method="POST">
							@csrf
							<div class="info-preview">
								<h1>{{ $data->name }}</h1>
								<div class="price">
									<?php $price = 0; ?>
									@if ($data->CheckPricePriority())
										<?php $price = $data->price_priority; ?>
										<span id="text-price">{{ number_format($data->price_priority,0, '.', '.') }}VNĐ</span> 
										<del id="regular_price" data-regularprice="{{ $data->regular_price }}" >
											{{ number_format($data->regular_price,0, '.', '.') }}VNĐ
										</del>
									@else
										@if (!is_null($data->sale_price))
											<?php $price = $data->sale_price; ?>
											<span id="text-price">{{ number_format($data->sale_price,0, '.', '.') }}VNĐ</span> 
											<del id="regular_price" data-regularprice="{{ $data->regular_price }}" >
												{{ number_format($data->regular_price,0, '.', '.') }}VNĐ
											</del>
										@else
											<?php $price = $data->regular_price; ?>
											{{-- <span id="text-price">{{ number_format($data->regular_price,0, '.', '.') }}VNĐ</span> --}}
											@if ($data->regular_price != 0)
												<span id="text-price">{{ number_format($data->regular_price,0, '.', '.') }}đ</span>
											@else
												<span>Liên hệ</span>
											@endif
											
										@endif
									@endif

									
								</div>
								@if (!empty(@$data->warranty_parameter))
									<div class="support">Bảo hành: <span>{{ @$data->warranty_parameter }}</span></div>
								@endif
								<div class="code">Mã sản phẩm: <span>{{ $data->sku }}</span></div>
								
								
								@foreach ($productAttributeTypes as $item)
									<?php $attributes =  $data->ProductVersion()->where('id_product_attribute_types', $item->id)->orderBy('id', 'ASC')->get(); ?>
									@if (count($attributes))
										@if ($item->type == 'color')
											<div class="style">
												<p>{{ $item->name }}</p>
												<ul>
													@foreach ($attributes as $value)
														@if (!empty(request('view')))
															<li>
																<input type="radio" id="style{{ $item->id }}-{{ $loop->index + 1 }}" 
																name="color_option" {{ request('view') == $value->key ? 'checked' : null }} class="options-radio" 
																data-link="{{ route('home.single.product', ['slug'=> $data->slug, 'view'=> @$value->key]) }}">
																<label for="style{{ $item->id }}-{{ $loop->index + 1 }}"><span>{{ @$value->key }}</span>
																	+{{ number_format(@$value->value, 0, '.', '.') }} vnđ
																</label>
															</li>
														@else
															<li>
																<input type="radio" id="style{{ $item->id }}-{{ $loop->index + 1 }}" 
																name="color_option" {{ $loop->index == 0 ? 'checked' : null }} class="options-radio" 
																data-link="{{ route('home.single.product', ['slug'=> $data->slug, 'view'=> @$value->key]) }}">
																<label for="style{{ $item->id }}-{{ $loop->index + 1 }}"><span>{{ @$value->key }}</span>
																	+{{ number_format(@$value->value, 0, '.', '.') }} vnđ
																</label>
															</li>
														@endif
														
													@endforeach
												</ul>
											</div>
										@endif
									@endif

								@endforeach

								<div class="row">
									
									@foreach ($productAttributeTypes as $item)
										<?php $attributes =  $data->ProductVersion()->where('id_product_attribute_types', $item->id)->orderBy('id', 'ASC')->get(); ?>
										@if (count($attributes))
											<div class="col-md-4 col-sm-6 col-6">
												<div class="style">
													@if ($item->type != 'color')
														<p>{{ $item->name }}</p>
														<div class="src-style">
															<select name="attribute_types[{{ $item->id }}]" class="attribute_types">
																@foreach ($attributes as $value)
																	<option value="{{ $value->value }}">{{ $value->key }}</option>
																@endforeach
															</select>
														</div>
													@endif
												</div>
											</div>
										@endif
									@endforeach
										
								</div>

								@if ($data->CheckApplyGift())
									<div class="box-sale">
										<div class="titl-sale">
											<div class="title-s"><strong>{{ $data->title_desc_gift }}</strong> <span>(Áp dụng dự kiến đến {{ \Carbon\Carbon::parse($data->end_date_apply_gift)->format('d/m/Y') }})</span></div>
										</div>
										<div class="info-box">
											@if (count($data->ProductGift))
												@foreach ($data->ProductGift as $gift)
													<?php $indexParent = $loop->index; ?>
													@if ($gift->type == 'options')
														<div class="ok-1"><span>{{ $loop->index + 1 }}</span>{!! $gift->desc !!}</div>
														<ul>
															<?php $options_gift = json_decode( $gift->value );?>
															@if (!empty($options_gift->list))
																@foreach ($options_gift->list as $key => $value)
																	<li>
																		<input type="radio" id="sale-{{ $loop->index + 1 }}-{{ $indexParent }}" name="radiosale[{{ $indexParent }}]" class="apply-gift" value="{{ $value->value }} " data-value="{{ $value->value }}">
																		<label for="sale-{{ $loop->index + 1 }}-{{ $indexParent }}">{{ $value->title }}</label>
																	</li>
																@endforeach
															@endif
														</ul>
													@else
														<div class="ok-1"><span>{{ $loop->index + 1 }}</span>{!! $gift->desc !!}</div>
													@endif
												@endforeach
											@endif
										</div>
									</div>
								@endif
								<div class="quantity-cart">
									<ul class="list-inline">
										<li class="list-inline-item">
											<div class="quatity">
												<span>Số lượng</span>
												<div class="number-spinner">
													<span class="ns-btn">
			                                            <a data-dir="dwn"><span class="icon-minus">-</span></a>
			                                        </span>
			                                        <input type="text" class="pl-ns-value" value="1" maxlength="5" readonly name="qty">
			                                        <span class="ns-btn">
			                                            <a data-dir="up"><span class="icon-plus">+</span></a>
			                                        </span>
			                                    </div>
											</div>
										</li>
										<li class="list-inline-item">
											<div class="add-cart">
												<button type="submit">Thêm vào giỏ hàng <i class="fa fa-shopping-cart"></i></button>
											</div>
										</li>
									</ul>
								</div>
								<div class="btn-amor">
                                	<a href="{{ route('home.installment') }}">
                                		<img src="{{ __BASE_URL__ }}/images/pig.png" class="img-fluid" alt="Trả góp"><span>mua trả góp</span>
                                	</a>
                                </div>
                                @if (!empty($data->content_services_warranty))
                                	<div class="srv-bh">
										<p>Dịch vụ bảo hành (Tùy chọn)</p>
										<ul>
											<?php $services = json_decode( $data->content_services_warranty ); ?>
											@if (!empty($services->services))
							                    @foreach ($services->services as $id => $value)
													<li>
														<input type="radio" id="bh-{{ $loop->index + 1 }}" name="radio-bh" class="services_warranty" data-value="{{ $value->value }}" data-title="{{ $value->title }} (+ {{ number_format($value->value, 0, '.', '.') }}đ)">
														<label for="bh-{{ $loop->index + 1 }}">{{ $value->title }} (+ {{ number_format($value->value, 0, '.', '.') }}đ)</label>
													</li>
												@endforeach
							              @endif
										</ul>
									</div>
                                @endif
							</div>
							<input type="hidden" id="id_price_services" value="0">
							<input type="hidden" id="id_title_services" name="title_services" value="">
							<input type="hidden" id="id_price_base" value="{{ @$price }}">
							<input type="hidden" id="id_price" name="price" value="{{ @$price }}">
							<input type="hidden" id="" name="attributes" value="">
							<input type="hidden" name="id_product" value="{{ $data->id }}">
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="product-detail" class="pt-50">
		<div class="container">
			<div class="content">
				<div class="detail">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#tabs-2" role="tab">Thông số sản phẩm</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#tabs-1" role="tab">Chi tiết sản phẩm</a>
						</li>
					</ul>
					<div class="tab-content" style="background: #fafafa;">
						<div class="tab-pane" id="tabs-1" role="tabpanel">
							<div class="info-detail info-detail-prd">
								{!! $data->content !!}
							</div>
						</div>
						<div class="tab-pane active" id="tabs-2" role="tabpanel">
							<div class="info-detail info-detail-prd">
								{!! $data->specifications !!}
							</div>
						</div>
						<div class="load-detail text-center pt-50">
							<a title="" href="javascript:0">Đọc thêm</a>
						</div>
						<div class="tags" style="padding-top: 40px;">
							<ul class="list-inline">
								<li class="list-inline-item"><span>Tags: </span></li>
								@if ($data->tags)
									@foreach ($data->tags as $tag)
										<li class="list-inline-item"><a href="{{ route('home.products.tags', $tag->slug) }}">{{ $tag->name }}</a></li>
									@endforeach
								@endif
							</ul>
						</div>
					</div>
				</div>
				<div class="rait pt-80">
					<div class="title-rait">
						<div class="row">
							<div class="col-md-8 col-sm-8">
								{{-- <h2>Đánh giá {{ $data->name }}</h2> --}}
							</div>
							<div class="col-md-4 col-sm-4">
								<div class="btn-rait text-right"><a title="" href="javascript:0" class="text-uppercase" data-toggle="modal" data-target="#myModal-dg">Đánh giá ngay</a></div>
							</div>
						</div>
					</div>

					@include('frontend.pages.products.parts.reviews-customers')

					@include('frontend.pages.products.parts.images-reviews-customers')
		
					@include('frontend.pages.products.parts.list-comments')
					
				</div>
			</div>
		</div>
		@include('frontend.pages.products.parts.modal-reviews')
	</section>
	
	@if (count($product_same_category))
		<section class="favorite pt-50 pb-80">
			<div class="container">
				<div class="content">
					<h4>Sản phẩm cùng loại</h4>
					<div class="list-product slide-frv" style="background: #fff;">
					
						@foreach ($product_same_category as $item)
							@component('frontend.components.product', ['item'=> $item])
						    
							@endcomponent
						@endforeach
					
					</div>
				</div>
			</div>
		</section>
	@endif
@stop

@section('script')
	<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
	<script>
		function currencyFormat(num) {
		  return num.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
		}
	</script>

	<script>
		function calculate() {
			price = 0;
			color_option = 0;
			base_price = $('#id_price_base').val();
			base_services = $('#id_price_services').val();
			$('.attribute_types').each(function() {
				price = price + parseInt($(this).val());
			});
			return price + parseInt(base_price) + parseInt(base_services);
		}
	</script>

	<script>
		jQuery(document).ready(function($) {
			$('.attribute_types').change(function(event) {
				$('#text-price').text(currencyFormat(calculate())+'đ');
				$('#id_price').val(calculate());
			});

			$('.options-radio').click(function(event) {
				window.location.href = $(this).data('link');
			});

			$('.services_warranty').click(function(event) {
				$('#id_price_services').val($(this).data('value'));
				$('#id_title_services').val($(this).data('title'));
				$('#id_price').val(calculate());
				$('#text-price').text(currencyFormat(calculate())+'đ');
			});
		});

		var numberSpinner = (function() {
		  $('.number-spinner>.ns-btn>a').click(function() {
		    var btn = $(this),
		      oldValue = btn.closest('.number-spinner').find('input').val().trim(),
		      newVal = 0;

		    if (btn.attr('data-dir') === 'up') {
		      newVal = parseInt(oldValue) + 1;
		    } else {
		      if (oldValue > 1) {
		        newVal = parseInt(oldValue) - 1;
		      } else {
		        newVal = 1;
		      }
		    }
		    btn.closest('.number-spinner').find('input').val(newVal);
		  });
		  $('.number-spinner>input').keypress(function(evt) {
		    evt = (evt) ? evt : window.event;
		    var charCode = (evt.which) ? evt.which : evt.keyCode;
		    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		      return false;
		    }
		    return true;
		  });
		})();
		
	</script>
	<script>
		$(document).ready(function () {
			$('.nb').click(function(){
				$('.loadingcover').show();
				$.ajax({
					type: "GET",
					url: "{{ route("home.get.votestar") }}",
					data: {
						id_product : '{{ $data->id }}',
						star: $(this).data('star'),
					},
					success: function (response) {
						$('.loadingcover').hide();
						$.toast({
							text: 'Gửi đánh giá thành công.',
							heading: 'Thông báo',
							icon: 'success',
							showHideTransition: 'fade',
							allowToastClose: false,
							hideAfter: 3000,
							stack: 5,
							position: 'top-right',
							textAlign: 'left', 
							loader: true, 
							loaderBg: '#9ec600',
							beforeHide: function () {
								location.reload();
							}, 
						});
					}
				});
			});
		});
	</script>
	<script>
		jQuery(document).ready(function($) {
			$('.apply-gift').click(function(event) {
				val = $(this).val();
				if(val != " "){
					base_price = $('#id_price_base').val();
					console.log(val);
					if(base_price !=0){
						if (base_price - parseInt(val) > 0) {
							$('#id_price').val(base_price - parseInt(val));
							$('#text-price').text(currencyFormat(base_price - parseInt(val))+'đ');
						}
						
					}
					
				}
			});
		});
	</script>
@endsection

@section('meta_tags')
	<meta property="product:brand" content="{{ @$data->Brand->name }}">
	<meta property="product:availability" content="in stock">
	<meta property="product:condition" content="new">
	<meta property="product:price:amount" content="{{ @$price }}">
	<meta property="product:price:currency" content="VND">
  	<meta property="product:retailer_item_id" content="{{ $data->id }}">
@endsection