@if (count($data))
	@foreach ($data as $item)
		@component('frontend.components.product-style-3', ['item'=> $item])

		@endcomponent
	@endforeach
@endif
