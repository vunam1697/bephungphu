@extends('frontend.master')
@section('main')
	<section id="bread">
		<div class="container">
			<div class="content">
				<ul class="list-inline">
					<li class="list-inline-item"><a title="Trang chủ" href="{{ url('/') }}">Trang chủ</a></li>
					<li class="list-inline-item"><a title="Tin tức" href="{{ route('home.archive-news') }}">Tin tức</a></li>
					<li class="list-inline-item"><a title="{{ $data->name }}" href="javascript:0">{{ $data->name }}</a></li>
				</ul>
			</div>
		</div>
	</section>

	<section id="news" class="pb-80">
		<div class="container">
			<div class="content">
				<div class="row">
					<div class="col-md-9">
						<div class="content-detail">
							<div class="detail">
								<div class="title-detail">
									<h1>{{ $data->name }}</h1>
									<div class="date">{{ $data->created_at->format('d/m/yy') }}</div>
									<div class="desc">
										{{ @$data->desc }}
									</div>
								</div>
								<div class="info-detail">
									{!! @$data->content !!}
								</div>
								<div class="tags">
									<ul class="list-inline">
										<li class="list-inline-item"><span>Tags: </span></li>
										@if (!empty($data->tags))
											@foreach ($data->tags as $tag)
												<li class="list-inline-item"><a href="{{ route('home.news.tags', $tag->slug) }}">{{ $tag->name }}</a></li>
											@endforeach
										@endif
									</ul>
								</div>
								<div class="like-share">
									<ul class="list-inline">
										<div class="fb-like" data-href="{{ url()->current() }}" data-width="" data-layout="button" data-action="like" data-size="small" data-share="true"></div>
									</ul>
								</div>
								<div class="comment pt-50">
									<div class="fb-comments" data-href="{{ url()->current() }}" data-width="100%" data-numposts="5"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="side-news bar-detail">
							@include('frontend.teamplate.parts.sidebar')
						</div>
					</div>
					<div class="col-md-12">
						<div class="new-other pt-50">
							<div class="title-other text-uppercase">Bài viết liên quan</div>
							<div class="new-other">
								<div class="row">
									@if (!empty($post_related))
										@foreach ($post_related as $item)
											<div class="col-md-3 col-sm-3">
												<div class="item">
													<div class="avarta">
														<a title="{{ @$item->name }}" href="{{ route('home.post.single', @$item->slug) }}">
															<img data-src="{{ @$item->image }}" class="img-fluid lazyload" width="100%" alt="{{ @$item->name }}">
														</a>
													</div>
													<div class="info">
														<h3><a title="{{ @$item->name }}" href="{{ route('home.post.single', @$item->slug) }}">{{ @$item->name }}</a></h3>
													</div>
												</div>
											</div>
										@endforeach
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@stop
@section('script')
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0&appId=1620283888101801&autoLogAppEvents=1"></script>
@endsection