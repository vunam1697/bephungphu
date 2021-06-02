<ul>
	@foreach ($filters as $filter)
		<?php $indexLoop = $loop->index + 2; ?>
		<?php if(!empty($filter->content)){
			$content = json_decode( $filter->content );
		} ?>
		<li>
			@if ($filter->type == 'price')
				<select name="" class="select-filter-mobile" data-type="{{ $filter->type }}">
					<option value="">{{ $filter->name }}</option>
					@if (!empty($content->filter))
						@foreach ($content->filter as $key => $value)
							<option value="{{ @$value->min_value.'-'.$value->max_value }}">{{ $value->name }}</option>
						@endforeach
					@endif
				</select>
			@elseif($filter->type == 'brand')
				<select name="" class="select-filter-mobile" data-type="{{ $filter->type }}">
					<option value="">{{ $filter->name }}</option>
					@if (!empty($content->filter))
						@foreach ($content->filter as $key => $value)
							<option value="{{ @$value->brand_id }}">{{ $value->name }}</option>
						@endforeach
					@endif
				</select>
			@else
				<select name="" class="select-filter-mobile" data-type="{{ $filter->type }}">
					<option value="">{{ $filter->name }}</option>
					@if (!empty($content->filter))
						@foreach ($content->filter as $key => $value)
							<option value="{{ @$value->value }}">{{ $value->name }}</option>
						@endforeach
					@endif
				</select>
			@endif
		</li>
	@endforeach
</ul>