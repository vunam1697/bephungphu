@extends('frontend.master')
@section('main')
	<section id="box-new-cate" class="pt-50 pb-50">
		<div class="container">
			<div class="box-cate">
				<div class="titl-nws">
					<h2>{{ $category->name }}</h2>
				</div>
				<div class="row slide-news">
					@if (count($data))
						@foreach ($data as $item)
							<div class="col-sm-3" style="margin-top: 20px">
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
							</div>
						@endforeach
				
						<div class="col-sm-12 item text-center" style="margin-top: 20px">
							<style>
								.pagination li{
									text-align: center;
								}
							</style>
							<ul class="pagination" style="display: inline-block;">
								{!! $data->links() !!}
							</ul>
							
						</div>
					@else
						<div class="col-sm-12">
							<div class="alert alert-success">
								Nội dung đang được cập nhật.
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</section>

@stop