@extends('frontend.master')
@section('main')
	<section id="bread">
		<div class="container">
			<div class="content">
				<ul class="list-inline">
					<li class="list-inline-item"><a title="Trang chủ" href="{{ url('/') }}">Trang chủ</a></li>
					<li class="list-inline-item"><a title="" href="javascript:0">Giỏ hàng</a></li>
				</ul>
			</div>
		</div>
	</section>

	<section id="cart" class="pt-20 pb-80">
		<div class="container">
			<div class="content">
				<div class="title-cart text-center">GIỎ HÀNG</div>
				<div class="content-cart">
					@if (Cart::count())
						<div class="src-mobile">
							<div class="head-cart">
								<div class="row">
									<div class="col-md-4 col-sm-4 col-4"><div class="title-head">Sản phẩm</div></div>
									<div class="col-md-2 col-sm-2 col-2"><div class="title-head text-center">Đơn giá</div></div>
									<div class="col-md-2 col-sm-2 col-2"><div class="title-head text-center">Số lượng</div></div>
									<div class="col-md-2 col-sm-2 col-2"><div class="title-head text-center">Thành tiền</div></div>
									<div class="col-md-2 col-sm-2 col-2"><div class="title-head text-center">Xóa</div></div>
								</div>
							</div>
							<div class="list-cart">
								@foreach (Cart::content() as $item)
									<div class="item-cart">
										<div class="row">
											<div class="col-md-4 col-sm-4 col-4">
												<div class="item">
													<div class="item-pr">
														<div class="avarta">
															<a title="{{ $item->name }}" href="{{ route('home.single.product', $item->options->slug) }}">
																<img src="{{ $item->options->image }}" class="img-fluid" alt="{{ $item->name }}">
															</a>
														</div>
														<div class="info">
															<h3>
																<a title="{{ $item->name }}" href="{{ route('home.single.product', $item->options->slug) }}">
																	{{ $item->name }}
																	@if (!empty($item->options['attributes']))
																		<span class="badge badge-success">{{ $item->options['attributes'] }}</span>
																	@endif
																</a>
															</h3>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-2 col-sm-2 col-2">
												<div class="item text-center">
													<div class="price">{{ number_format($item->price, 0, '.', '.') }}đ</div>
												</div>
											</div>
											<div class="col-md-2 col-sm-2 col-2">
												<div class="item text-center">
													<div class="number-spinner">
														<span class="ns-btn">
				                                            <a data-dir="dwn"><span class="icon-minus">-</span></a>
				                                        </span>
				                                        <input type="text" class="pl-ns-value qtyinput" value="{{ $item->qty }}" readonly data-id="{{ $item->rowId }}">
				                                        <span class="ns-btn">
				                                            <a data-dir="up"><span class="icon-plus">+</span></a>
				                                        </span>
				                                    </div>
												</div>
											</div>
											<div class="col-md-2 col-sm-2 col-2">
												<div class="item text-center">
													<div class="price"><strong>{{ number_format($item->qty * $item->price, 0, '.','.') }}đ</strong></div>
												</div>
											</div>
											<div class="col-md-2 col-sm-2 col-2">
												<div class="item text-center">
													<div class="btn-remove">
														<a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩn này ra khỏi giỏ hàng?');" href="{{ route('home.remove.cart', $item->rowId) }}">
															<img src="{{ __BASE_URL__ }}/images/remove.png" class="img-fluid" alt="">
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
						<div class="contn">
							<div class="row">
								<div class="col-md-7 col-sm-7">
									<ul class="list-inline">
										<li class="list-inline-item">
											<div class="back-prd">
												<a title="Tiếp tục mua hàng" href="{{ url('/') }}"><i class="fa fa-angle-left"></i> Tiếp tục mua hàng</a>
											</div>
										</li>
										<li class="list-inline-item">
											<div class="btn-buy"><a title="Thanh toán" href="{{ route('home.check-out') }}">THANH TOÁN</a></div>
										</li>
									</ul>
								</div>
								<div class="col-md-5 col-sm-5">
									<div class="total text-center">Tổng: {{ number_format(Cart::total(),0,'.','.') }}VNĐ</div>
								</div>
							</div>
						</div>

						<?php $list_coupons = \App\Models\Coupons::where('status', 1)->where('is_display_pages_cart', 1)->where('condition', '<=', Cart::total())->get(); ?>
						@if (count($list_coupons))
							<div class="alert alert-success alert-22" role="alert">
							  	<h4>Mã giảm giá</h4>
							  	<ul style="padding-left: 10px" class="mgg">
							  		@foreach ($list_coupons as $item)
							  			<li>Bạn đã đặt mua đơn hàng {{ number_format(Cart::total(), 0, '.', '.') }} đ. Bạn được ưu đãi mã giảm giá: <span class="redd">{{ $item->code }} </span> ({{ $item->name }}) <a href="{{ route('home.check-out', ['coupons-code'=> $item->code ]) }}">  Áp dụng</a></li>
							  		@endforeach
							  	</ul>
							</div>
						@else
							<?php $list_coupons_near = \App\Models\Coupons::where('status', 1)->where('is_display_pages_cart', 1)->get(); ?>
							@if (count($list_coupons_near))
								<div class="alert alert-success alert-22" role="alert">
								  	<h4>Mã giảm giá</h4>
								  	<ul style="padding-left: 10px">
								  		@foreach ($list_coupons_near as $item)
								  			<li>Bạn cần mua thêm {{ number_format($item->condition - Cart::total(),0,'.','.') }}đ để có thể sử dụng mã giảm giá: {{ $item->name }}</li>
								  		@endforeach
								  	</ul>
								</div>
							@endif
						@endif
						
					@else
						<div class="contn">
							<div class="row">
								<div class="col-sm-12">
									<div class="alert alert-success" role="alert">
									  	Chưa có sản phẩm trong giỏ hàng.
									</div>
								</div>
								<div class="col-md-7 col-sm-7">
									<ul class="list-inline">
										<li class="list-inline-item">
											<div class="back-prd">
												<a title="Tiếp tục mua hàng" href="{{ url('/') }}"><i class="fa fa-angle-left"></i> Tiếp tục mua hàng</a>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					@endif
					<div class="favorite pt-50">
						<h4>Sản phẩm có thể yêu thích</h4>
						<div class="list-product slide-frv" style="background: #fff;">
							@foreach ($dataProducts as $item)
								@component('frontend.components.product', ['item'=> $item])
								@endcomponent
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@stop
@section('script')
	<script>
		var numberSpinner = (function() {
		  $('.number-spinner>.ns-btn>a').click(function() {
		    var btn = $(this),
		      oldValue = btn.closest('.number-spinner').find('input').val().trim(),
		      newVal = 0;

		    if (btn.attr('data-dir') === 'up') {
		      newVal = parseInt(oldValue) + 1;
		    } else {
		      if (oldValue > 1) {
		        newVal = parseInt(oldValue) - 1;
		      } else {
		        newVal = 1;
		      }
		    }
		    btn.closest('.number-spinner').find('input').val(newVal);
		    id = btn.closest('.number-spinner').find('input').data('id');
		    $('.loadingcover').show();
		    $.get('{{ route('home.update.cart') }}', { qty : newVal, id : id } ,function(data) {
		    	$('.loadingcover').hide();
		    	location.reload();
		    });
		  });
		  $('.number-spinner>input').keypress(function(evt) {
		    evt = (evt) ? evt : window.event;
		    var charCode = (evt.which) ? evt.which : evt.keyCode;
		    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		      return false;
		    }
		    return true;
		  });
		})();
	</script>
@endsection