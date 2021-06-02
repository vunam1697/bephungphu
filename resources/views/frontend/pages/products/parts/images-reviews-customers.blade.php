<?php $data_image_reviews = $data->ProductImage()->where('type', 'image_reviews_customer')->take(4)->get(); ?>
@if (count($data_image_reviews))
	<div class="box-gall">
		<div class="title-gall">{{ count($data->ProductImage()->where('type', 'image_reviews_customer')->get()) }} ảnh từ khách hàng</div>
		<div class="list-gall">
			<div class="row">
				
				@foreach ($data_image_reviews as $item)
					<div class="col-md-2">
						<div class="item">
							<a title="{{ $data->name }}" href="{{ $item->image }}" data-fancybox="group-gall" class="lightbox"> 
								<img src="{{ $item->image }}" class="img-fluid" alt="{{ $data->name }}" width="100%" height="186">
							</a>
						</div>
					</div>
				@endforeach
				<?php $data_image_reviews_more = $data->ProductImage()->where('type', 'image_reviews_customer')->skip(4)->take(50)->get();?>
				@if (count($data_image_reviews_more))
					<div class="col-md-2">
						<div class="item">
							@foreach ($data_image_reviews_more as $item)
								@if ($loop->index == 0)
									<a title="" href="{{ $item->image }}" data-fancybox="group-gall" class ="view-gall lightbox text-center">Xem thêm {{ count($data_image_reviews_more) }} ảnh</a>
									<a title="" href="{{ $item->image }}" data-fancybox="group-gall" class =" text-center">
										<img src="{{ $item->image }}" class="img-fluid" alt="{{ $data->name }}">
									</a>
								@else
									<a title="" href="{{ $item->image }}" data-fancybox="group-gall" class ="lightbox text-center d-none">
									<img src="{{ $item->image }}" class="img-fluid" alt="{{ $data->name }}"></a>
								@endif
							@endforeach
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>

@endif