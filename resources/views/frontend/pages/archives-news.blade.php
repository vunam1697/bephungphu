@extends('frontend.master')
@section('main')
	<section id="box-new-cate" class="pt-50 pb-50">
		<div class="container">
			@if (count($categories))
				@foreach ($categories as $value)
					<div class="box-cate">
						<div class="titl-nws">
							<h2>{{ $value->name }}</h2>
							<a href="{{ route('home.post.category', $value->slug) }}">Xem thêm <i class="fa fa-angle-right"></i></a>
						</div>
						<div class="slide-news">
							@if (count($value->Posts))
								<?php $posts = $value->Posts()->active()->published()->orderBy('hot', 'desc')->orderBy('created_at', 'DESC')->take(12)->get(); ?>
								@if (count($posts))
									@foreach ($posts as $item)
										<div class="item">
											<div class="avarta">
												<a href="{{ route('home.post.single', $item->slug) }}" title="{{ $item->name }}">
													<img data-src="{{ $item->image }}" class="img-fluid w-100 lazyload" alt="{{ $item->name }}">
												</a>
											</div>
											<div class="info">
												<div class="date-view">
													<ul class="list-inline">
														<li class="list-inline-item">
															<div class="date">{{ $item->created_at->format('d/m/Y') }}</div>
														</li>
														<li class="list-inline-item">
															<div class="view"><i class="fa fa-eye"></i>{{ $item->view_count }} lượt xem</div>
														</li>
													</ul>
												</div>
												<h3><a href="{{ route('home.post.single', $item->slug) }}" title="{{ $item->name }}">{{ $item->name }}</a></h3>
												<div class="desc">
													{{ $item->desc }}
												</div>
											</div>
										</div>
									@endforeach
								@endif
							@endif
						</div>
					</div>
				@endforeach
			@endif
		</div>
	</section>
@stop
@section('script')
	<script>
		$('.slide-news').slick({
		    autoplay: false,
		    arrow: true,
		    dots: false,
		    slidesToShow: 4,
		    slidesToScroll: 1, 
		    prevArrow: '<button class="prev" href="javascript:0"><i class="fa fa-chevron-left"></i></button>',
		    nextArrow: '<button class="next" href="javascript:0"><i class="fa fa-chevron-right"></i></button>',
		    responsive: [
		        {
		            breakpoint: 767,
		            settings: {
		                slidesToShow: 4,
		            }
		        },
		        {
		            breakpoint: 480,
		            settings: {
		                slidesToShow: 2,
		            }
		        }
		    ]
		});
	</script>
@endsection