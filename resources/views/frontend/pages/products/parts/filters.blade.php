@if (count($filters))
	<div class="rmv-filter"> 
		<ul class="list-inline" id="filter-properties">
			<li class="list-inline-item"><span>Lọc:</span></li>
			<li class="list-inline-item"><label>{{ @$category->name }}</label><a href="javascript:0">x</a></li>
		</ul>
	</div>
	@foreach ($filters as $filter)
		<?php $indexLoop = $loop->index + 2; ?>
		<?php if(!empty($filter->content)){
			$content = json_decode( $filter->content );
		} ?>
		<div class="box-filt">
			<div class="title-filt">{{ $filter->name }}</div>
			<ul class="{{ $filter->type == 'brand' ? 'flex-logo' : null }}">
				@if (!empty($content->filter))
					@foreach ($content->filter as $key => $value)
						@if ($filter->type == 'price')
							<li>
								<input type="radio" id="filter-{{ $key }}" name="filter-{{ $indexLoop }}" value="{{ $value->min_value.'-'.$value->max_value }}" data-type="{{ $filter->type }}"
						 		class="filter-check-box check-box-filter {{ $filter->type }}" data-id="input-{{ $filter->type }}" data-name="{{ $value->name }}">
						 		<label for="filter-{{ $key }}">{{ $value->name }} </label>
						 	</li>
						@elseif($filter->type == 'brand')
							<?php $brand = \App\Models\Categories::find($value->brand_id); ?>
							<li class="filter-logo">
								<input type="checkbox" id="filter-{{ $key }}" name="filter-{{ $indexLoop }}" value="{{ $value->brand_id }}" data-type="{{ $filter->type }}"
							 	class="filter-check-box check-box-filter {{ $filter->type }}" data-id="input-{{ $filter->type }}" data-name="{{ $value->name }}">
							 	<label for="filter-{{ $key }}">
							 		@if (!empty($brand))
							 			<img src="{{ $brand->image }}" class="img-fluid" alt="{{ $value->name }} ">
							 		@else
							 			{{ $value->name }} 
							 		@endif
							 	</label>
							</li>
						@else
							<li>
								<input type="checkbox" id="filter-{{ $key }}" name="filter-{{ $indexLoop }}" value="{{ @$value->value }}" data-type="{{ $filter->type }}"
							 	class="filter-check-box check-box-filter {{ $filter->type }}" data-id="input-{{ $filter->type }}" data-name="{{ @$value->name }}">
							 	<label for="filter-{{ $key }}">{{ $value->name }} </label>
							</li>
						@endif
					@endforeach
				@endif
			</ul>
			<input type="hidden" id="input-{{ $filter->type }}" value="" class="input-param" data-type="{{ $filter->type }}">
		</div>
	@endforeach
@endif
<?php //$parent = getListParent(@$category); ?>
<input type="hidden" value="{{ $category->id }}" id="category_base">

