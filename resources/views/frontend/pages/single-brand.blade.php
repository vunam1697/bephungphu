@extends('frontend.master')
@section('main')
	<section id="bread">
		<div class="container">
			<div class="content">
				<ul class="list-inline">
					<li class="list-inline-item"><a title="Trang chủ" href="{{ url('/') }}">Trang chủ</a></li>
					<li class="list-inline-item"><a title="Thương hiệu" href="{{ route('home.brand') }}">Thương hiệu</a></li>
					<li class="list-inline-item"><a title="{{ $data->name }}" href="javascript:0">{{ $data->name }}</a></li>
				</ul>
				<div class="avar-bread">
					<div class="avarta">
						<img data-src="{{ !empty($data->banner) ? $data->banner : __BASE_URL__.'/images/thuonghieu.jpg' }}" class="img-fluid lazyload" alt="{{ $data->name }}">
					</div>
					<div class="caption text-center">
						<h1>{{ $data->name }}</h1>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section id="product" class="pb-80">
		<div class="container">
			<div class="content">
				<div class="tab-hot-sale slide-th">
					<div class="grid-tabs">
						<div class="row">
							<div class="col-md-2">
								<div class="grid text-center">
									<div class="item-grid"><a title="" href="javascript:0" class="clc-gird active"><i class="fa fa-th"></i></a></div>
									<div class="item-grid"><a title="" href="javascript:0" class="clc-list"><i class="fa fa-bars"></i></a></div>
								</div>
							</div>
							<div class="col-md-10" style="padding-left: 0;">
								<ul class="tabs" style="border: 0;">
									<li class="">
										<a class="tab-prd active" href="javascript:0" data-tab="tab-1-1" >Nổi bật</a>
									</li>
									@if (!empty($category_display))
										@foreach ($category_display as $item)
											<li class="">
												<a class="tab-prd" href="{{ route('home.products.category.brand', ['category' => $item->slug, 'brand' => $data->slug]) }}" data-tab="tab-c-{{ $item->id }}-{{ $loop->index + 1 }}" >{{ $item->name }}</a>
											</li>
										@endforeach
									@endif
								</ul>
							</div>
						</div>
					</div>
					<div class="tab-content">
						<div class="tab-pane pane-prd active" id="tab-1-1">
							<div class="list-product prd-list">
								<div class="row list-product-hot-style-1">
									@if (count($products_hot_by_brand))
										@foreach ($products_hot_by_brand as $item)
											<div class="col-lg-3 col-6 col-sm-3">
												@component('frontend.components.product-style-2', ['item'=> $item])
							    
												@endcomponent
											</div>
										@endforeach
									@else
										<div class="col-sm-12">
											<div class="alert alert-success" role="alert">
											  	Không có sản phẩm nào phù hợp.
											</div>
										</div>
									@endif
								</div>
							</div>
							<div class="grid-prd list-product-hot-style-2">
								@if (count($products_hot_by_brand))
									@foreach ($products_hot_by_brand as $item)
										@component('frontend.components.product-style-3', ['item'=> $item])
							    
										@endcomponent
									@endforeach
								@else
									<div class="item">
										<div class="alert alert-success" style="width: 100%;" role="alert">
										  	Không có sản phẩm nào phù hợp.
										</div>
									</div>
								@endif
							</div>
							<div class="load-more text-center pt-50" style="background: #f9f9f9;">
								<a title="Xem thêm" href="javascript:;" class="loadMoreHot">Xem thêm</a>
								<input type="hidden" value="12">
							</div>
						</div>
						@if (!empty($category_display))
							@foreach ($category_display as $item)
								<?php 
									$list_id_children = get_list_ids($item);
						            $list_id_children[] = $item->id;
						            $list_id_product = \App\Models\ProductCategory::whereIn('id_category', $list_id_children)->get()->pluck('id_product')->toArray();
						            $dataProductsByCategory = \App\Models\Products::whereIn('id', $list_id_product )->active()->where('brand_id', $data->id)->order()->take(12)->get();
								?>

								<div class="tab-pane pane-prd" id="tab-c-{{ $item->id }}-{{ $loop->index + 1 }}">
									<div class="list-product prd-list">
										<div class="row list-product-category-style-1-{{ $item->id }}">
											@if (count($dataProductsByCategory))
												@foreach ($dataProductsByCategory as $value)
													<div class="col-lg-3 col-6 col-sm-3">
														@component('frontend.components.product-style-2', ['item'=> $value])
														@endcomponent
													</div>
												@endforeach
											@else
												<div class="col-sm-12">
													<div class="alert alert-success" role="alert">
													  	Không có sản phẩm nào phù hợp.
													</div>
												</div>
											@endif
										</div>
									</div>
									<div class="grid-prd list-product-category-style-2-{{ $item->id }}">
										@if (count($dataProductsByCategory))
											@foreach ($dataProductsByCategory as $value)
												@component('frontend.components.product-style-3', ['item'=> $value])
												@endcomponent
											@endforeach
										@else
											<div class="item">
												<div class="alert alert-success" style="width: 100%;" role="alert">
												  	Không có sản phẩm nào phù hợp.
												</div>
											</div>
										@endif
									</div>
									<div class="load-more text-center pt-50" style="background: #f9f9f9;">
										<a title="Xem thêm" href="javascript:;" class="loadMoreCategory" data-id="{{ $item->id }}">Xem thêm</a>
										<input type="hidden" value="12">
									</div>
								</div>
							@endforeach
						@endif
					</div>
				</div>
				<div class="other-partner pt-80">
					<div class="title-prt text-center"><h2 class="text-uppercase">Các thương hiệu khác</h2></div>
					<div class="slide-prt text-center">
						@foreach ($list_brands as $item)
							<div class="item">
								<a title="{{ $item->name }}" href="{{ route('home.single.brand', $item->slug) }}">
									<img data-src="{{ $item->image }}" class="img-fluid lazyload" alt="{{ $item->name }}">
								</a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section> 


	@include('frontend.teamplate.parts.modal-emty-product')
@stop

@section('script')
	<script>
		jQuery(document).ready(function($) {
			$('.loadMoreHot').click(function(event) {
				brand_id = '{{ $data->id }}';
				var offset = parseInt($(this).next().val());
				btn = $(this);
				$('.loadingcover').show();
				$.get('{{ route('home.load.products.brand.ajax') }}', { offset : offset, brand_id : brand_id } , function(data) {
					$('.loadingcover').hide();
					btn.next().val(offset + 12);
					if(data.style_1 != '' && data.style_2 != ''){
						$('.list-product-hot-style-1').append(data.style_1);
						$('.list-product-hot-style-2').append(data.style_2);
					}else{
						$('#exampleModal').modal('show');
						btn.remove();
					}
				});
			});

			$('.loadMoreCategory').click(function(event) {
				brand_id = '{{ $data->id }}';
				var offset = parseInt($(this).next().val());
				btn = $(this);
				category = $(this).data('id');
				$('.loadingcover').show();
				$.get('{{ route('home.load.products.brand.ajax') }}', { offset : offset, brand_id : brand_id, category : category } ,function(data) {
					$('.loadingcover').hide();
					btn.next().val(offset + 12);
					if(data.style_1 != '' && data.style_2 != ''){
						$('.list-product-category-style-1-'+category).append(data.style_1);
						$('.list-product-category-style-2-'+category).append(data.style_2);
					}else{
						$('#exampleModal').modal('show');
						btn.remove();
					}
				});
			});

		});
	</script>
@endsection