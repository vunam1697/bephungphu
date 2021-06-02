@extends('frontend.master')
@section('main')
	<?php if(!empty($dataContent->content)){
		$content = json_decode( $dataContent->content );
	} ?>
	<section id="banner" class="pb-50">
		<h1 class="d-none">{{ @$dataContent->title_h1 }}</h1>
		<div class="container">
			<div class="content-banner">
				<div class="col-padd empty"></div>
				<div class="col-padd slide-banner">
					<div class="slide">
						@if (!empty($content->banner))
							@foreach ($content->banner as $key => $value)
								<div class="item">
									<a title="{{ $value->desc }}" href="{{ $value->link }}">
										<img data-src="{{ $value->image }}" class="img-fluid lazyload" width="100%" alt="{{ $value->desc }}">
									</a>
								</div>
							@endforeach
						@endif
					</div>
				</div>
				<div class="col-padd right">
					<ul class="slide-vert">
						@if (!empty($content->banner))
							@foreach ($content->banner as $key => $value)
								<li>
									<a title="{{ $value->desc }}" href="javascript:0">
										<img src="{{ $value->image }}" class="img-fluid" width="100%" alt="{{ $value->image }}">
									</a>
								</li>
							@endforeach
						@endif
					</ul>
				</div>
			</div>
		</div>
	</section>
	<section id="category-mobile" class="pb-50">
		<div class="container">
			<ul>
				<?php $categoryMobile = \App\Models\Categories::where('type', 'product_category')->where('parent_id', 0)->get(); ?>
				@if (count($categoryMobile))
					@foreach ($categoryMobile as $item)

						<li>
							<a title="{{ $item->name }}" href="{{ route('home.archive.product', $item->slug) }}">
								{{ $item->name }}
							</a>
						</li>

					@endforeach
				@endif
			</ul>
			<div class="load-more-cate text-center"><a href="javascript:void(0)">Xem thêm</a></div>
		</div>
	</section>
	<section id="hot-sales">
		<div class="container">
			<div class="content">
				<div class="title text-center"><h2 class="text-uppercase">Sản phẩm giá sốc</h2></div>
				<div class="list-product slide-sale">
					@if (!empty($products_price_shock))
						@foreach ($products_price_shock as $item)
							@component('frontend.components.product', ['item'=> $item])
						    
							@endcomponent
						@endforeach
					@endif
					
				</div>
			</div>
		</div>
	</section>



	<section id="sale-today" class="pt-80">
		<div class="container">
			<div class="content">
				<div class="title text-center"><h2 class="text-uppercase">khuyến mãi hot mỗi ngày</h2></div>
				<div class="tab-hot-sale slide-hot">
					<ul class="tabs">
						<li class="">
							<a class="tab-sle active" href="javascript:0" data-tab="tab-1" >Nổi bật</a>
						</li>
						@if (!empty($content->category_hot))
							@foreach ($content->category_hot as $key => $value)
								<?php $cate = \App\Models\Categories::find($value->category_id); ?>
								@if (!empty($cate))
									<li class="">
										<a class="tab-sle category-hot" href="javascript:0" data-tab="tab-cate-{{ $cate->id }}" data-id="{{ $cate->id }}">{{ $cate->name }}</a>
									</li>
								@endif
							@endforeach
						@endif
					</ul>
					<div class="tab-content">
						<div class="tab-pane pane-sale active" id="tab-1">
							<div class="list-product">
								<div class="row">
									@if (count($products_sale_hot))
										@foreach ($products_sale_hot as $item)
											<div class="col-lg-2 col-6 col-sm-3">
												@component('frontend.components.product', ['item'=> $item])
												@endcomponent
											</div>
										@endforeach
									@endif
								</div>
							</div>
						</div>
						@if (!empty($content->category_hot))
							@foreach ($content->category_hot as $key => $value)
								<?php $cate = \App\Models\Categories::find($value->category_id); ?>
								@if (!empty($cate))
									<div class="tab-pane pane-sale" id="tab-cate-{{ $cate->id }}">
										<div class="list-product">
											<div class="row list-append-products-category-{{ $cate->id }}">
												
											</div>
										</div>
									</div>
								@endif

							@endforeach

						@endif
					</div>

				</div>
				<div class="col-md-12">
					<div class="load-more text-center" style="background: #f9f9f9; padding-top: 45px">
						<a title="Xem thêm" href="{{ route('home.flash-sale') }}">Xem thêm</a>
					</div>
				</div>
			</div>
		</div>
	</section>


	<section id="product" class="pt-80">
		<div class="container">
			<div class="content">
				<div class="title"><h2 class="text-uppercase">Danh sách sản phẩm</h2></div>
				<div class="tab-hot-sale slide-hot">
					<ul class="tabs">
						<li class="">
							<a class="tab-prd active" href="javascript:0" data-tab="tab-11-1" >Nổi bật</a>
						</li>
						@if (!empty($content->category))
							@foreach ($content->category as $key => $value)
								<?php $cate = \App\Models\Categories::find($value->category_id); ?>
								@if (!empty($cate))
									<li class="">
										<a class="tab-prd category-link" href="javascript:0" data-tab="tab-list-cate-{{ $cate->id }}" data-id="{{ $cate->id }}">{{ $cate->name }}</a>
									</li>
								@endif
							@endforeach
						@endif
					</ul>
					<div class="tab-content">
						<div class="tab-pane pane-prd active" id="tab-11-1">
							<div class="list-product">
								<div class="row">
									@if (count($products_hot))
										@foreach ($products_hot as $item)
											<div class="col-lg-2 col-6 col-sm-3">
												@component('frontend.components.product', ['item'=> $item])
												@endcomponent
											</div>
										@endforeach
									@endif
									<div class="col-md-12">
										<div class="load-more text-center" style="background: #f9f9f9;">
											<a title="Xem thêm" href="{{ route('home.list.product') }}">Xem thêm</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@if (!empty($content->category))
							@foreach ($content->category as $key => $value)
								<?php $cate = \App\Models\Categories::find($value->category_id); ?>
								@if (!empty($cate))
									<div class="tab-pane pane-prd" id="tab-list-cate-{{ $cate->id }}">
										<div class="list-product">
											<div class="row list-append-products-list-category-{{ $cate->id }}">
												
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


	<section id="banner-sale" class="pt-80">
		<div class="container">
			<div class="content">
				<div class="slide-bn-sale">
					@if (!empty($content->banner_mid))
						@foreach ($content->banner_mid as $key => $value)
							<div class="item">
								<div class="avarta">
									<a title="{{ $value->desc }}" href="{{ $value->link }}">
										<img data-src="{{ $value->image }}" class="img-fluid lazyload" width="100%" alt="{{ $value->image }}">
									</a>
								</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>
		</div>
	</section>

	@if (session('product_viewed'))
		<?php $products_viewed = \App\Models\Products::whereIn('id', session('product_viewed'))->get(); ?>
		@if (count($products_viewed))
			<section id="prd-seen" class="pt-80 pb-80">
				<div class="container">
					<div class="content">
						<div class="title text-center"><h2 class="text-uppercase">Sản phẩm đã xem</h2></div>
						<div class="list-product slide-seen">
							@foreach ($products_viewed as $item)
								<div class="item">
									<div class="avarta">
										<a title="{{ $item->name }}" href="{{ route('home.single.product', $item->slug) }}">
											<img data-src="{{ $item->image }}" class="img-fluid lazyload" width="100%" alt="{{ $item->name }}">
										</a>
									</div>
									<div class="info">
										<h3><a title="{{ $item->name }}" href="{{ route('home.single.product', $item->slug) }}">{{ $item->name }}</a></h3>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</section>
		@endif
	@endif


	<section id="partner" class="pb-80" style="{{ session('product_viewed') ? '' : 'padding-top:80px' }}">
		<div class="container">
			<div class="content">
				<div class="slide-part">
					@if (!empty($content->partner))
						@foreach ($content->partner as $key => $value)
							<div class="item">
								<a title="{{ $value->desc }}" href="{{ $value->link }}" target="_blank">
									<img data-src="{{ $value->image }}" class="img-fluid lazyload" width="100%" alt="{{ $value->desc }}">
								</a>
							</div>
						@endforeach
					@endif
				</div>
			</div>
		</div>
	</section>


	<section id="box-news" class="pt-80 pb-80" style="background: #fafafa">
		<div class="container">
			<div class="content">
				<div class="title text-center"><h2 class="text-uppercase">Kinh nghiệm hay</h2></div>
				<div class="list-box-news">
					<div class="row">
						<div class="col-md-6">
							<div class="video-news">
								<div class="avarta"><img data-src="{{ @$content->video->image }}" class="img-fluid lazyload" alt="Video"></div>
								<div class="play text-center">
									<a title="" href="javascript:0" data-toggle="modal" data-target="#myModal">
										<img data-src="{{ __BASE_URL__ }}/images/play.png" class="img-fluid lazyload" alt="play">
									</a>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="right">
								<div class="news-item">
									@if (count($posts_hot))
										@foreach ($posts_hot as $item)
											<div class="item">
												<div class="avarta">
													<a title="{{ $item->name }}" href="{{ route('home.post.single', $item->slug) }}">
														<img data-src="{{ $item->image }}" class="img-fluid lazyload" width="100%" alt="{{ $item->name }}">
													</a>
												</div>
												<div class="info">
													<h4><a title="{{ $item->name }}" href="{{ route('home.post.single', $item->slug) }}">{{ $item->name }}</a></h4>
													<div class="desc">
														{{ $item->desc }}
													</div>
												</div>
											</div>
										@endforeach
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="load-more text-center">
								<a title="Xem thêm" href="{{ route('home.archive-news') }}">Xem thêm</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="myModal">
			<div class="modal-dialog">
			    <div class="modal-content">
			    	<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal">&times;</button>
			    	</div>
			    	<div class="modal-body">
			        	<div class="content-popup">
			        		{!! @$content->video->iframe !!}
			        	</div>
			    	</div>
			    </div>
			</div>
		</div>
	</section>

	@include('frontend.teamplate.parts.tags')
	
@endsection

@section('script')
	<script>
		jQuery(document).ready(function($) {
			$('.category-hot').click(function(event) {
				var id_tab = $(this).data('id');
				if(isEmpty($('.list-append-products-category-'+id_tab))){
					$('.loadingcover').show();
					$.get('{{ route('home.load.products.ajax') }}', { id_category : id_tab, type : 'home-hot'  } , function(data) {
						$('.loadingcover').hide();
						if(data.trim() != ''){
							$('.list-append-products-category-'+id_tab).html(data);
						}else{
							$('.list-append-products-category-'+id_tab).html('<div class="col-sm-12"><div class="alert alert-success" role="alert">Không có sản phẩm nào phù hợp.</div></div>');
						}
					});
				}
			});

			$('.category-link').click(function(event) {
				var id_tab = $(this).data('id');
				if(isEmpty($('.list-append-products-list-category-'+id_tab))){
					$('.loadingcover').show();
					$.get('{{ route('home.load.products.ajax') }}', { id_category : id_tab, type : 'home-category'  } , function(data) {
						$('.loadingcover').hide();
						if(data.trim() != ''){
							$('.list-append-products-list-category-'+id_tab).html(data);
						}else{
							$('.list-append-products-list-category-'+id_tab).html('<div class="col-sm-12"><div class="alert alert-success" role="alert">Không có sản phẩm nào phù hợp.</div></div>');
						}
					});
				}
			});

		});

		function isEmpty( el ){
		    return !$.trim(el.html())
		}
	</script>
@endsection