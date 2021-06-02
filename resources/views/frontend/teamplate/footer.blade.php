<footer>
	<div class="fix-social">
		<ul>
			<li><a href="{{ @$site_info->link->zalo }}" target="_blank"><img src="{{ __BASE_URL__ }}/images/fx-2.png" class="img-fluid" alt="Zalo"></a></li>
		</ul>
	</div>
	<div class="back-top"><a href="javascript:0"><i class="fa fa-chevron-up"></i></a></div>
	<div class="container">
		<div class="content">
			<div class="info-footer">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<div class="item">
							<div class="title-ft">{!! @$site_info->col_footer_1->title !!}</div>
							<div class="link-supp">
								{!! @$site_info->col_footer_1->value !!}
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="item">
							<div class="title-ft">{!! @$site_info->col_footer_2->title !!}</div>
							<div class="hotline">
								{!! @$site_info->col_footer_2->value !!}
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="item">
							<div class="title-ft">Kết nối</div>
							<div class="social">
								<ul>
									@if (!empty(@$site_info->social))
										@foreach (@$site_info->social as $id => $val)
											<li><a title="{{ @$val->name }}" href="{{ @$val->link }}" target="_blank"><i class="{{ @$val->icon }}"></i>{{ @$val->name }}</a></li>
										@endforeach
									@endif
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6"> 
						<div class="item">
							<div class="title-ft">Fanpage</div>
							<div class="fanpages">
								{!! @$site_info->code_facebook !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="callnow" class="hotline">
		<div class="hotline-phone-ring-wrap">
			<div class="hotline-phone-ring" id="call-now-1">
				<div class="hotline-phone-ring-circle"></div>
				<div class="hotline-phone-ring-circle-fill"></div>
				<div class="hotline-phone-ring-img-circle">
					<a href="tel:{{ @$site_info->hotline }}" class="pps-btn-img"> <img src="{{ __BASE_URL__ }}/images/quick.png" alt="Gọi điện thoại" width="50" data-lazy-src="" data-pin-no-hover="true" class="lazyloaded" data-was-processed="true">
					</a>
				</div>
			</div>
			<div class="hotline-bar">
				<a href="tel:{{ @$site_info->hotline }}"> <span class="text-hotline" id="call-now-1">{{ @$site_info->hotline }}</span> </a>
			</div>
		</div>
	</div>
</footer>