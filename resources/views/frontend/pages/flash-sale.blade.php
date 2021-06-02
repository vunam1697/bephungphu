@extends('frontend.master')
@section('main')
	<h1 style="display: none;">{!! $dataContent->title_h1 !!}</h1>
	<section id="bread">
		<div class="container">
			<div class="content">
				<ul class="list-inline">
					<li class="list-inline-item"><a title="Trang chủ" href="{{ url('/') }}">Trang chủ</a></li>
					<li class="list-inline-item"><a title="" href="javascript:0">Khuyến mãi</a></li>
				</ul>
			</div>
		</div>
	</section>

	<?php
		if (!empty($dataContent->content)) {
            $list_category = json_decode($dataContent->content);
        }
	?>

	<section id="product" class="pt-20">
		<div class="container">
			<div class="content">
				<div class="tab-hot-sale slide-hot">
					<ul class="tabs">
						<li class="">
							<a class="tab-prd active" href="javascript:0" data-tab="tab-1-1" >Nổi bật</a>
						</li>
						@if (!empty($list_category->category))
							@foreach ($list_category->category as $key => $value)
								<?php $cate = \App\Models\Categories::find($value->category_id); ?>
								@if (!empty($cate))
									<li class="">
										<a class="tab-prd category-link" href="{{ route('home.flash-sale.category', $cate->slug) }}" data-tab="tab-2-{{ $loop->index + 1 }}" data-id="{{ $cate->id }}">{{ $cate->name }}</a>
									</li>
								@endif
							@endforeach
						@endif
					</ul>
					<div class="tab-content">
						<div class="tab-pane pane-prd active" id="tab-1-1">
							<div class="list-product prd-list">
								<div class="row list-products-hot">
									@if (count($products_flash_sale))
										@foreach ($products_flash_sale as $item)
											<div class="col-lg-3 col-sm-3 col-6">
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
								@if (count($products_flash_sale))
									<div class="row">
										<div class="col-md-12">
											<div class="load-more text-center pt-50 pb-50" style="background: #f9f9f9;">
												<a title="Xem Thêm" href="javascript:;" class="loadMoreHot">Xem thêm</a>
												<input type="hidden" value="20">
											</div>
										</div>
									</div>
								@endif
							</div>
						</div>
						@if (!empty($list_category->category))
							@foreach ($list_category->category as $key => $value)
								<?php $cate = \App\Models\Categories::find($value->category_id); ?>
								@if (!empty($cate))
									<div class="tab-pane pane-prd" id="tab-2-{{ $loop->index + 1 }}">
										<div class="list-product prd-list">
											<div class="row list-product-category-{{ $cate->id }}">
												
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="load-more text-center pt-50 pb-50" style="background: #f9f9f9;">
														<a title="Xem Thêm" href="javascript:;" class="loadMoreCategory" data-category="{{ $cate->id }}">Xem thêm</a>
														<input type="hidden" value="20">
													</div>
												</div>
											</div>
										</div>
									</div>
								@endif
								
							@endforeach
						@endif
						
					</div>
				</div>
			</div>
		</div>
	</section>
	@include('frontend.teamplate.parts.tags')


	@include('frontend.teamplate.parts.modal-emty-product')
	
@endsection
@section('script')
	<script>
		jQuery(document).ready(function($) {
			$('.category-link').click(function(event) {
				var id_tab = $(this).data('id');
				var classSelected = '.list-product-category-'+id_tab;
				if(isEmpty($(classSelected))){
					getProducts(id_tab, classSelected);
				}
			});

			$('body').on('click', '.loadMoreHot', function(event) {
				var offset = parseInt($(this).next().val());
				var btn = $(this);
				$('.loadingcover').show();
				$.get('{{ route('home.load.products.ajax') }}', { id_category: 'hot', offset : offset } , function(data) {
					$('.loadingcover').hide();
					btn.next().val(offset + 20);
					if(data.trim() != ''){
						$('.list-products-hot').append(data);
					}else{
						btn.remove();
						$('#exampleModal').modal('show'); 
					}
				});
			});
			$('body').on('click', '.loadMoreCategory', function(event) {
				var offset = parseInt($(this).next().val());
				var id = $(this).data('category');
				var classSelected = '.list-product-category-'+id;
				var btn = $(this);
				$('.loadingcover').show();
				$.get('{{ route('home.load.products.ajax') }}', { id_category: id, offset : offset } , function(data) {
					$('.loadingcover').hide();
					btn.next().val(offset + 20);
					if(data.trim() != ''){
						$(classSelected).append(data);
					}else{
						btn.remove();
						$('#exampleModal').modal('show'); 
					}
				});
			});
			


		});	
		function isEmpty( el ){
		    return !$.trim(el.html())
		}

		function getProducts($id, $classSelected) {
			$('.loadingcover').show();
			$.get('{{ route('home.load.products.ajax') }}', { id_category : $id } ,function(data) {
				$('.loadingcover').hide();
				if(data.trim() != ''){
					$($classSelected).html(data);
				}else{
					$($classSelected).html('<div class="col-sm-12"><div class="alert alert-success" role="alert">Không có sản phẩm nào phù hợp.</div></div>');
				}
			});
		}
	</script>
@endsection