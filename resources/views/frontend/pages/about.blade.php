@extends('frontend.master')
@section('main')
	<section id="bread">
		<div class="container">
			<div class="content">
				<ul class="list-inline">
					<li class="list-inline-item"><a title="Trang chủ" href="{{ url('/') }}">Trang chủ</a></li>
					<li class="list-inline-item"><a title="" href="javascript:0">Về chúng tôi</a></li>
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
						
						<div class="video-about">
							<div class="avarta">
								<img data-src="{{ @$content->video->image }}" alt="{{ @$content->about->title }}" class="img-fluid lazyload" width="100%">
							</div>
							<div class="play-video text-center">
								<a href="javascript:0" data-toggle="modal" data-target="#myModal">
									<img src="{{ __BASE_URL__ }}/images/play-video.png" class="img-fluid" alt="play">
								</a>
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
@stop