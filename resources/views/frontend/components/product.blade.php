<div class="item">
	<div class="avarta">
		@if (!empty($item->sale))
			<div class="sale-per"><span>-{{ $item->sale }}%</span></div>
		@endif
		
		<a title="{{ $item->name }}" href="{{ route('home.single.product', $item->slug) }}">
			<img data-src="{{ $item->image }}" class="img-fluid lazyload" width="100%" alt="{{ $item->name }}">
		</a>
		@if ($item->CheckApplyGift())
			<div class="icon-sale">
				<img data-src="{{ __BASE_URL__ }}/images/gift.png" class="img-fluid lazyload" alt="Quà tặng"><span>Quà tặng</span>
			</div>
		@endif
	</div>
	<div class="info">
		<h3><a title="{{ $item->name }}" href="{{ route('home.single.product', $item->slug) }}">{{ $item->name }}</a></h3>
		<div class="price">
			@if ($item->CheckPricePriority())
				<span class="uutien">{{ number_format($item->price_priority,0, '.', '.') }}đ</span>
				<del>{{ number_format($item->regular_price,0, '.', '.') }}đ</del>
			@else
				@if (!is_null($item->sale_price))
					<span>{{ number_format($item->sale_price,0, '.', '.') }}đ</span>
					<del>{{ number_format($item->regular_price,0, '.', '.') }}đ</del>
				@else
					@if ($item->regular_price != 0)
						<span>{{ number_format($item->regular_price,0, '.', '.') }}đ</span>
					@else
						<span>Liên hệ</span>
					@endif
				@endif
			@endif

			
		</div>
	</div>
</div>