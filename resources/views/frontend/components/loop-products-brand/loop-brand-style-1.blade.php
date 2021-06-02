@if (count($data))
	@foreach ($data as $item)
		<div class="col-lg-3 col-6 col-sm-3">
			@component('frontend.components.product-style-2', ['item'=> $item])

			@endcomponent
		</div>
	@endforeach
@endif
