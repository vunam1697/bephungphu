@extends('frontend.master')
@section('main')
	<section id="bread">
		<div class="container">
			<div class="content">
				<ul class="list-inline">
					<li class="list-inline-item"><a title="Trang chủ" href="{{ url('/') }}">Trang chủ</a></li>
					<li class="list-inline-item"><a title="" href="javascript:0">{{ $data->name }}</a></li>
				</ul>
			</div>
		</div>
	</section>
	<section id="about">
		<div class="container">
			<div class="content">
				<div class="detail">
					<div class="title-about text-center text-uppercase"><h1>{{ $data->name }}</h1></div>
					<div class="info-detail">
						{!! $data->content !!}
					</div>
				</div>
			</div>
		</div>
	</section>
@stop