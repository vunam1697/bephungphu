@extends('frontend.master')
@section('main')
	@if (request()->route()->getName() == 'home.list.product')
		<section id="bread">
			<div class="container">
				<div class="content">
					<ul class="list-inline">
						<li class="list-inline-item"><a title="Trang chủ" href="{{ url('/') }}">Trang chủ</a></li>
						<li class="list-inline-item"><a title="" href="javascript:0">Sản phẩm</a></li>
					</ul>
				</div>
			</div>
		</section>

		<?php if(!empty($dataSeo->content)){
			$content_banner = json_decode( $dataSeo->content, true );
			$banners  = $content_banner['banner'];
		} ?>
		<section id="banner-sale" class="{{ !empty($banners[1]->title) ? 'pt-20 pb-50' : null }}">
			<div class="container">
				<div class="content">
					<div class="slide-bn-sale">
						@foreach ($banners as $banner)
							@if (!empty($banner['title']))
								<div class="item">
									<div class="avarta">
										<a title="{{ $banner['title'] }}" href="{{ $banner['link'] }}"><img src="{{ $banner['image'] }}" class="img-fluid" alt="{{ $banner['title'] }}"></a>
									</div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
			</div>
		</section>
	@else
		<section id="bread">
			<div class="container">
				<div class="content">
					<ul class="list-inline">
						<li class="list-inline-item"><a title="Trang chủ" href="{{ url('/') }}">Trang chủ</a></li>
						<li class="list-inline-item"><a title="Sản phẩm" href="{{ url('san-pham') }}">Sản phẩm</a></li>
						<?php $parent = getListParent(@$category); ?>
						@if (!empty($parent))
							@if ($parent->id != @$category->id)
								<li class="list-inline-item"><a title="{{ $parent->name }}" href="{{ route('home.archive.product', $parent->slug ) }}">{{ $parent->name }}</a></li>
							@endif
						@endif
						<li class="list-inline-item"><a title="" href="javascript:0">{{ @$category->name }}</a></li>
					</ul>
				</div>
			</div>
		</section>
		@if (!empty($category->meta_orthers))
			<?php $banners = json_decode( $category->meta_orthers, true); ?>
			<section id="banner-sale" class="{{ !empty($banners[1]->title) ? 'pt-20 pb-50' : null }}">
				<div class="container">
					<div class="content">
						<div class="slide-bn-sale">
							@foreach ($banners as $banner)
								@if (!empty($banner['title']))
									<div class="item">
										<div class="avarta">
											<a title="{{ $banner['title'] }}" href="{{ $banner['link'] }}"><img src="{{ $banner['image'] }}" class="img-fluid" alt="{{ $banner['title'] }}"></a>
										</div>
									</div>
								@endif
							@endforeach
						</div>
					</div>
				</div>
			</section>
		@endif
	@endif
	<section id="product">
		@if (!empty(@$category->name))
			<h1 class="d-none">{{ @$category->name }}</h1>
		@else
			<h1 class="d-none">{{ $dataSeo->title_h1 }}</h1>
		@endif
		
		<div class="container">
			<div class="content">
				<div class="row">
					<div class="col-md-3">
						<div class="search-bar" style="background: #fff;">
							@if (request()->route()->getName() != 'home.list.product')
								@include('frontend.pages.products.parts.filters')
							@else
								@include('frontend.pages.products.parts.filters-page-product')
							@endif
						</div>
					</div>
					<div class="col-md-9">
						<div class="select-filt d-none">
							@include('frontend.pages.products.parts.filters-mobile')
						</div>
						<div class="right-product">
							@if (request()->route()->getName() != 'home.list.product')
								@if (!empty($category->is_using_banner_big))
									@if (!empty($category->content_banner_big))
										<?php $content_banner_big = json_decode( $category->content_banner_big );?>
										<div class="bn-prtop">
											<a href="{{ @$content_banner_big->link }}">
												<img src="{{ @$content_banner_big->image }}" class="img-fluid w-100" alt="">
											</a>
										</div>

									@endif
								@else
									@if (!empty($category->meta_banner))
										<?php $meta_banner = json_decode( $category->meta_banner ); ?>
										@if (!empty($meta_banner->min))
											<div class="pr-top">
												<div class="row">
													@foreach ($meta_banner->min as $key => $banner)
														<div class="col-md-4 col-sm-4 col-6">
															<div class="item">
																<a title="{{ $banner->desc }}" href="{{ $banner->link }}"></a>
																<div class="icon"><img src="{{ $banner->image }}" class="img-fluid" alt="{{ $banner->desc }}"></div>
																<div class="info">
																	<h2>{{ $banner->desc }}</h2>
																</div>
															</div>
														</div>
													@endforeach	
												</div>
											</div>
										@endif
									@endif
								@endif
								
							@endif
							@if (request()->route()->getName() != 'home.list.product')
								<div class="sort">
									<ul class="list-inline">
										<li class="list-inline-item"><span>Sắp xếp theo: </span></li>
										<li class="list-inline-item sort-desk">
											<input type="radio" id="sort-1" name="radio-group" class="sort_fields" data-fields="price"  data-type="ASC">
											<label for="sort-1">Giá từ thấp đến cao</label>
										</li>
										<li class="list-inline-item sort-desk">
											<input type="radio" id="sort-2" name="radio-group" class="sort_fields" data-fields="price" data-type="DESC">
											<label for="sort-2">Giá từ cao đến thấp</label>
										</li>
										<li class="list-inline-item sort-desk">
											<input type="radio" id="sort-3" name="radio-group" class="sort_fields" data-fields="product-selling" data-type="DESC">
											<label for="sort-3">Sản phẩm bán chạy</label>
										</li>

										<li class="list-inline-item d-none">
											<select name="" id="sort_fields_mobile">
												<option >Sắp xếp</option>
												<option data-fields="price" value="ASC">Giá từ thấp đến cao</option>
												<option data-fields="price" value="DESC">Giá từ cao đến thấp</option>
												<option data-fields="product-selling" value="DESC">Sản phẩm bán chạy</option>
											</select>
										</li>
									</ul>
								</div>
							@else
								<div class="sort">
									<ul class="list-inline">
										<li class="list-inline-item"><span>Sắp xếp theo: </span></li>
										<li class="list-inline-item sort-desk">
											<input type="radio" id="sort-1" name="radio-group" class="sort_fields" data-fields="price"  data-type="ASC">
											<label for="sort-1">Giá từ thấp đến cao</label>
										</li>
										<li class="list-inline-item sort-desk">
											<input type="radio" id="sort-2" name="radio-group" class="sort_fields" data-fields="price" data-type="DESC">
											<label for="sort-2">Giá từ cao đến thấp</label>
										</li>
										<li class="list-inline-item sort-desk">
											<input type="radio" id="sort-3" name="radio-group" class="sort_fields" data-fields="product-selling" data-type="DESC">
											<label for="sort-3">Sản phẩm bán chạy</label>
										</li>

										<li class="list-inline-item d-none">
											<select name="" id="sort_fields_mobile">
												<option >Sắp xếp</option>
												<option data-fields="price" value="ASC">Giá từ thấp đến cao</option>
												<option data-fields="price" value="DESC">Giá từ cao đến thấp</option>
												<option data-fields="product-selling" value="DESC">Sản phẩm bán chạy</option>
											</select>
										</li>
									</ul>
								</div>
							@endif
							<div class="tab-pane pane-prd active" style="background: #fff;">
								<div class="list-product">
									<div class="row" id="list-products">
										@if (count($data))
											@foreach ($data as $item)
												<div class="col-lg-3 col-sm-3 col-6">
													@component('frontend.components.product', ['item'=>$item])
													    
													@endcomponent
												</div>
											@endforeach
										@else
											<div class="col-lg-12">
												<div class="col-sm-12">
													<div class="alert alert-success" role="alert">
													  	Không có sản phẩm nào phù hợp.
													</div>
												</div>
											</div>
										@endif
									</div>
									<style>
										.on-mb{
											display: none;
										}
										@media screen and (max-width: 767px) {
											.on-mb {
												display:block
											}
											.on-desktop {
												display: none
											}
										}
									</style>
									<div class="row">
										<div class="col-md-12 on-desktop">
											<div class="load-more text-center" style="background: #f9f9f9;">
												<a title="" href="javascript:;" id="loadMoreCategory">Xem thêm</a>
												<input type="hidden" id="offset" value="16">
											</div>
										</div>
										<div class="col-md-12 on-mb">
											<div class="load-more text-center" style="background: #f9f9f9;">
												<a title="" href="javascript:;" id="loadMoreCategoryMobile">Xem thêm</a>
												<input type="hidden" id="offset" value="16">
											</div>
										</div>
									</div>
								</div>
							</div>
							@if (request()->route()->getName() != 'home.list.product')
								@if (!empty($category->link_footer))
									<div class="other-cate pt-50 pb-50">
										<ul class="list-inline">
											<?php $content = json_decode( $category->link_footer ); ?>
											@if (!empty($content->tags))
												@foreach ($content->tags as $id => $value)
													<li class="list-inline-item"><a title="{{ $value->title }}" href="{{ $value->link }}">{{ $value->title }}</a></li>
												@endforeach
											@endif
										</ul>
									</div>
								@endif
							@else
								@if (!empty($dataSeo->content))
									<?php $content = json_decode( $dataSeo->content ); ?>
									<div class="other-cate pt-50 pb-50">
										<ul class="list-inline">
											@if (!empty($content->tags))
												@foreach ($content->tags as $id => $value)
													<li class="list-inline-item"><a title="{{ $value->title }}" href="{{ $value->link }}">{{ $value->title }}</a></li>
												@endforeach
											@endif
										</ul>
									</div>
								@endif
							@endif
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
			$('.order_product').click(function(event) {
				window.location.href = $(this).data('link');
			});
			$('.filter-pages-products').click(function(event) {
				window.location.href = $(this).data('link');
			});
			
			//

			$('#loadMore').click(function(event) {

				var btn = $(this);
				$('.loadingcover').show();
				var offset = parseInt($(this).next().val());

				param = {
					category : $('#category_id').val(),
					brand : $('#brand').val(),
					order: $('#order').val(),
					gia: $('#gia').val(),
					offset : offset,
				};


				$.get('{{ route('home.load.products.archive.ajax') }}',param, function(data) {
					$('.loadingcover').hide();
					btn.next().val(offset + 16);
					if( data != ""){
						$('#list-products').append(data);
					}else{
						btn.remove();
						$('#exampleModal').modal('show'); 
					}
				});
			});

		});
	</script>
@endsection