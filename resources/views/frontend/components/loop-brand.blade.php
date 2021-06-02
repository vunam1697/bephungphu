@if (count($list_brands))
	@foreach ($list_brands as $item)
		<div class="col-md-2">
			<div class="item text-center">
				<a title="{{ $item->name }}" href="{{ route('home.single.brand', $item->slug) }}">
					<img data-src="{{ $item->image }}" class="img-fluid lazyload" alt="{{ $item->name }}">
				</a>
			</div>
		</div>
	@endforeach
@endif