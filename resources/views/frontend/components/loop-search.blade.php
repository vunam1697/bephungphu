@if (count($data))
	@foreach ($data as $item)
		<div class="item">
            <div class="avarta">
            	<a title="{{ $item->name }}" href="{{ route('home.single.product', $item->slug) }}">
            		<img data-src="{{ $item->image }}" class="img-fluid lazyload" alt="{{ $item->name }}">
            	</a>
            </div>
            <div class="info">
                <h3><a title="{{ $item->name }}" href="{{ route('home.single.product', $item->slug) }}">{{ $item->name }}</a></h3>
                <div class="price">
                	{{-- @if (!is_null($item->sale_price))
			 			<span>{{ number_format($item->sale_price,0, '.', '.') }}đ</span>
						<del>{{ number_format($item->regular_price,0, '.', '.') }}đ</del><label>-({{ $item->sale }}%)</label>
					@else
						<span>{{ number_format($item->sale_price,0, '.', '.') }}đ</span>
					@endif --}}

                    
                    @if ($item->CheckPricePriority())
                        <span>{{ number_format($item->price_priority,0, '.', '.') }}đ</span>
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
	@endforeach
@endif