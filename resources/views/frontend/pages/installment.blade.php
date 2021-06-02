@extends('frontend.master')
@section('main')
	<section id="bread">
		<div class="container">
			<div class="content">
				<ul class="list-inline">
					<li class="list-inline-item"><a title="Trang chủ" href="{{ url('/') }}">Trang chủ</a></li>
					<li class="list-inline-item"><a title="" href="javascript:0">Trả góp</a></li>
				</ul>
			</div>
		</div>
	</section>
	<?php if(!empty($dataSeo->content)){
		$content = json_decode( $dataSeo->content );
	} ?>
	<section id="about">
		<div class="container">
			<div class="content">
				<div class="detail">
					<div class="title-about text-center text-uppercase"><h1>{{ @$content->about->title }}</h1></div>
					<div class="info-detail">
						{!! @$content->about->desc !!}
					</div>
				</div>
			</div>
		</div>
	</section>
@stop