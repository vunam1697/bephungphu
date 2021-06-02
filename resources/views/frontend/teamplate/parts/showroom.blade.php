<section id="showroom" class="pt-80" style="background: #fff;">
	<div class="container">
		<div class="content">
			<div class="title text-center"><h2 class="text-uppercase">Các chi nhánh</h2></div>
			<div class="list-showroom">
				<div class="slide-showroom text-center">
					@if (count($branchs))
						@foreach ($branchs as $item)
							<div class="item item-room" data-tab="room-{{ $loop->index + 1 }}">	
								<div class="avarta">
									<a title="{{ $item->name }}" href="javascript:0">
										<img data-src="{{ $item->image }}" class="img-fluid lazyload" width="100%" alt="{{ $item->name }}">
									</a>
								</div>
								<div class="info">
									<h4><a title="{{ $item->name }}" href="javascript:0">{{ $item->name }}</a></h4>
								</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>
			<div class="maps">
				<div class="content-maps">
					@if (count($branchs))
						@foreach ($branchs as $item)
							<div class="item {{ $loop->index == 0 ? 'current' : null }}" id="room-{{ $loop->index + 1 }}">
								{!! $item->iframe !!}
								<div class="info-maps">
									<div class="avar"><img data-src="{{ $item->image }}" class="img-fluid lazyload" alt="{{ $item->name }}"></div>
									<div class="company">
										<h5>{{ $item->name }}</h5>
										<ul>
											<li>Địa chỉ: {{ $item->address }}</li>
											@if (!empty($item->phone))
												<li>Hotline: {{ $item->phone }}</li>
											@endif
											
											@if (!empty($item->email))
												<li>Email: {{ $item->email }}</li>
											@endif
											
										</ul>
									</div>
								</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>
		</div>
	</div>
</section>