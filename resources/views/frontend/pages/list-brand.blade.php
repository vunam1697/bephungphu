@extends('frontend.master')
@section('main')
	
	<h1 style="display: none;">{{ $dataContent->title_h1 }}</h1>
	<section id="bread">
		<div class="container">
			<div class="content">
				<ul class="list-inline">
					<li class="list-inline-item"><a title="Trang chủ" href="{{ url('/') }}">Trang chủ</a></li>
					<li class="list-inline-item"><a title="" href="javascript:0">Thương hiệu</a></li>
				</ul>
			</div>
		</div>
	</section>

	<section id="trademark" class="pt-20 pb-80">
		<div class="container">
			<div class="content">
				<div class="list-trad">
					<div class="row list-brands">
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
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="load-more text-center pt-20" style="background: #f9f9f9;">
								<a title="Xem thêm" href="javascript:;" class="loadMoreBrand">Xem thêm</a>
								<input type="hidden" value="15"> 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">
	                Dữ liệu đang được cập nhật.   
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	            </div>
	        </div>
	    </div>
	</div>



@stop
@section('script')
	<script>
		jQuery(document).ready(function($) {
			$('.loadMoreBrand').click(function(event) {
				$('.loadingcover').show();
				var btn = $(this);
				var offset = parseInt($(this).next().val());
				$.get('{{ route('home.load.brand.ajax') }}', { offset : offset } , function(data) {
					$('.loadingcover').hide();
					btn.next().val(offset + 15);
					if(data.trim() != ''){
						$('.list-brands').append(data);
					}else{
						btn.remove();
						$('#exampleModal').modal('show'); 
					}
				});
			});
		});
	</script>
@endsection