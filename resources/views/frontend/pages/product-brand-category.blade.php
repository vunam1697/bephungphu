@extends('frontend.master')
@section('main')
	<section id="bread">
		<div class="container">
			<div class="content">
				<ul class="list-inline">
					<li class="list-inline-item"><a title="Trang chủ" href="{{ url('/') }}">Trang chủ</a></li>
					<li class="list-inline-item"><a title="{{ $category->name }}" href="{{ route('home.archive.product', $category->slug) }}">{{ $category->name }}</a></li>
					<li class="list-inline-item"><a title="{{ $brand->name }}" href="javascript:0">{{ $brand->name }}</a></li>
				</ul>
				<div class="avar-bread">
					<div class="avarta">
						<img data-src="{{ !empty($brand->banner) ? $brand->banner : __BASE_URL__.'/images/thuonghieu.jpg' }}" class="img-fluid lazyload" alt="{{ $brand->name }}">
					</div>
					<div class="caption text-center">
						<h1>{{ $brand->name }}</h1>
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

									@if (count($list_id_children_id))
										<li class="">
											<a class="tab-prd active" href="javascript:0" data-tab="tab-1-1" >{{ $category->name }}</a>
										</li>
										@foreach ($list_id_children_id as $cate)
											<?php $category_child = \App\Models\Categories::find($cate); ?>
											<li class="">
												<a class="tab-prd" 
													href="{{ route('home.products.category.brand', ['category' => $category_child->slug, 'brand' => $brand->slug ]) }}">{{ $category_child->name }}
												</a>
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
									@if (count($products))
										@foreach ($products as $item)
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
								@if (count($products))
									@foreach ($products as $item)
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
								<a title="Xem thêm" href="javascript:;" class="loadMoreCategory" data-id="{{ $category->id }}">Xem thêm</a>
								<input type="hidden" value="12">
							</div>
						</div>
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

			$('.loadMoreCategory').click(function(event) {
				brand_id = '{{ $brand->id }}';
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