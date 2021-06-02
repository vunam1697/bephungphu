@if (count($data))
	@foreach ($data as $item)
		<div class="{{ !empty($class) ? $class : 'col-lg-3 col-sm-3 col-6' }}">
			@component('frontend.components.product-style-2', ['item'=> $item])
			@endcomponent
		</div>
	@endforeach
@endif