@if (count($data))
	@foreach ($data as $item)
		<div class="{{ !empty($class) ? $class : 'col-lg-3 col-sm-3 col-6' }}">
			@component('frontend.components.product-style-2', ['item'=> $item])
			@endcomponent
		</div>
	@endforeach
@else
	<div class="col-sm-12">
		<div class="alert alert-primary" role="alert">
		  	Không tìm thấy sản phẩm phù hợp.
		</div>
	</div>
@endif