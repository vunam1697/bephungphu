@extends('frontend.master')
@section('main')
	<section id="bread">
		<div class="container">
			<div class="content">
				<ul class="list-inline">
					<li class="list-inline-item"><a title="Trang chủ" href="{{ url('/') }}">Trang chủ</a></li>
					<li class="list-inline-item"><a title="" href="javascript:0">Thanh toán</a></li>
				</ul>
			</div>
		</div>
	</section>

	<section id="payment" class="pt-20 pb-80">
		<div class="container">
			<div class="content">
				<div class="row">
					<div class="col-md-6">
						<form action="{{ route('home.check-out.post') }}" method="POST" id="formsreviews">
							@csrf
							<div class="left">
								<div class="form-pay">
									<div class="title-pay">Thông tin khách hàng</div>
									<div class="row">
										<div class="col-md-12">
											<div class="item">
												<div class="form-group">
													<input type="text" placeholder="Họ tên" name="name">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="item">
												<div class="form-group">
													<input type="text" placeholder="Email" name="email" class="email-cus">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="item">
												<div class="form-group">
													<input type="text" placeholder="Số điện thoại" name="phone">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="item">
												<div class="form-group">
													<select name="id_province" id="id_province">
														<option value="">Tỉnh / Thành phố</option>
														@foreach ($province as $item)
															<option value="{{ $item->id }}">{{ $item->_name }}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="item">
												<div class="form-group">
													<select name="id_district" id="id_district">
														<option value="">Quận / Huyện </option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="item">
												<div class="form-group">
													<select name="id_ward" id="id_ward">
														<option value="">Phường / Xã </option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="item">
												<div class="form-group">
													<input type="text" placeholder="Địa chỉ cụ thể (ghi rõ số nhà, ngõ, ngách)" name="address">
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="item">
												<div class="form-group">
													<textarea id="" cols="30" rows="10" placeholder="Nội dung" name="note"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="method-pay">
									<div class="title-pay">Hình thức thanh toán</div>
									<div class="list-method">
										<div class="item">
											<input type="radio" id="method-1" name="radio-group" checked>
											<label for="method-1" class="hide-bank active">Thanh toán khi nhận hàng</label>
										</div>
										<div class="item">
											<input type="radio" id="method-2" name="radio-group">
											<label for="method-2" class="show-bank">Thanh toán online</label>
											<div class="info-pay">
												<div class="list-bank">
													<div class="row">
														<div class="col-md-3 col-4 col-sm-3">
															<div class="item-bank">
																<a title="" href="javascript:0" class="active"><img src="{{ __BASE_URL__ }}/images/b1.png" class="img-fluid" alt=""></a>
															</div>
														</div>
														<div class="col-md-3 col-4 col-sm-3">
															<div class="item-bank">
																<a title="" href="javascript:0"><img src="{{ __BASE_URL__ }}/images/b2.png" class="img-fluid" alt=""></a>
															</div>
														</div>
														<div class="col-md-3 col-4 col-sm-3">
															<div class="item-bank">
																<a title="" href="javascript:0"><img src="{{ __BASE_URL__ }}/images/b3.png" class="img-fluid" alt=""></a>
															</div>
														</div>
														<div class="col-md-3 col-4 col-sm-3">
															<div class="item-bank">
																<a title="" href="javascript:0"><img src="{{ __BASE_URL__ }}/images/b4.png" class="img-fluid" alt=""></a>
															</div>
														</div>
														<div class="col-md-3 col-4 col-sm-3">
															<div class="item-bank">
																<a title="" href="javascript:0"><img src="{{ __BASE_URL__ }}/images/b5.png" class="img-fluid" alt=""></a>
															</div>
														</div>
														<div class="col-md-3 col-4 col-sm-3">
															<div class="item-bank">
																<a title="" href="javascript:0"><img src="{{ __BASE_URL__ }}/images/b6.png" class="img-fluid" alt=""></a>
															</div>
														</div>
														<div class="col-md-3 col-4 col-sm-3">
															<div class="item-bank">
																<a title="" href="javascript:0"><img src="{{ __BASE_URL__ }}/images/b7.png" class="img-fluid" alt=""></a>
															</div>
														</div>
														<div class="col-md-3 col-4 col-sm-3">
															<div class="item-bank">
																<a title="" href="javascript:0"><img src="{{ __BASE_URL__ }}/images/b8.png" class="img-fluid" alt=""></a>
															</div>
														</div>
														<div class="col-md-3 col-4 col-sm-3">
															<div class="item-bank">
																<a title="" href="javascript:0"><img src="{{ __BASE_URL__ }}/images/b9.png" class="img-fluid" alt=""></a>
															</div>
														</div>
														<div class="col-md-3 col-4 col-sm-3">
															<div class="item-bank">
																<a title="" href="javascript:0"><img src="{{ __BASE_URL__ }}/images/b10.png" class="img-fluid" alt=""></a>
															</div>
														</div>
														<div class="col-md-3 col-4 col-sm-3">
															<div class="item-bank">
																<a title="" href="javascript:0"><img src="{{ __BASE_URL__ }}/images/b11.png" class="img-fluid" alt=""></a>
															</div>
														</div>
													</div>
												</div>
												<div class="notice">
													Chi phí 500.000 đ/ 1 phương thức thanh toán: chi phí sẽ tính khi ký hợp đồng với bên cung cấp cổng thanh toán online
												</div>
												<p style="color: red">Hình thức này chưa được tích hợp</p>
											</div>
										</div>
									</div>
									<div class="btn-pay text-center pt-20">
										<input type="button" class="sent" value="Gửi đơn hàng">
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-6">
						<div class="right">
							<div class="info-dh">
								<div class="title-pay">Chi tiết đơn hàng</div>
								<div class="list-dh">
									@foreach (Cart::content() as $item)
										<div class="item">
											<div class="prd-pay">
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
																<span class="badge badge-success" style="color: #fff">{{ $item->options['attributes'] }}</span>
															@endif
														</a>
													</h3>
													<span>Số lượng: {{ $item->qty }}</span>
												</div>
											</div>
											<div class="price">{{ number_format($item->qty * $item->price, 0, '.','.') }}đ</div>
										</div>
									@endforeach
									<style>
										.discount_amount {
											display: inline-flex;
											width: 100%;
											justify-content: space-between;
											align-items: center;
										}
										.discount_amount .amount{
											color: #d90000;
										}
										.discount_amount p{
											margin-bottom: 5px;
										}
									</style>
									<div class="discount_amount">
										
									</div>
									<div class="item">
										<div class="total">
											<p>Tổng thanh toán</p>
											<div class="price" id="price">{{ number_format(Cart::total(),0,'.', '.') }}đ</div>
											<input type="hidden" id="base_price" value="{{ number_format(Cart::total(),0,'.', '.') }}">
										</div>
									</div>
								</div>
							</div>
							<div class="bx-code-sale">
								<div class="code-sale">
									<h6>Mã giảm giá / Quà tặng</h6>
									<input type="text" placeholder="Nhập ở đây" id="coupon-input" value="{{ request('coupons-code') }}">
									<button type="button" id="coupon-check" style="">Đồng ý</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


@stop
@section('script')
	<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
	{!! $jsValidator->selector('#formsreviews') !!}
	<script>
		jQuery(document).ready(function($) {
			$('#id_province').change(function(event) {
				$('.loadingcover').show();
				id = $(this).val();
				$.get('{{ route('home.load.province') }}', { type : 'district', id : id  } , function(data) {
					$('#id_district').html(data);
					$('.loadingcover').hide();
				});
			});
			$('body').on('change', '#id_district', function(event) {
				id = $(this).val();
				$('.loadingcover').show();
				$.get('{{ route('home.load.province') }}', { type : 'ward', id : id  } , function(data) {
					$('#id_ward').html(data);
					$('.loadingcover').hide();
				});
			});
		});
	</script>
	<script>
		function validateEmail($email) {
		  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		  return emailReg.test( $email );
		}
		jQuery(document).ready(function($) {
			$('.sent').click(function(event) {
				if($('#formsreviews').valid()){
					var email  = $('.email-cus');
					if(!validateEmail(email.val())){
						email.parent().removeClass('has-success').addClass('has-error');
						$('#email-error').text('Email phải là một địa chỉ email hợp lệ.');
					}else{
						$('#formsreviews').submit();
					}
				}
				event.preventDefault();
			});
		});
	</script>
	<script>
		$(document).ready(function () {
			$('#coupon-check').click(function(){
				var coupon = $('#coupon-input').val();
				$('.loadingcover').show();
				if(coupon.length === 0){
					$('.loadingcover').hide();
					showToast('Bạn chưa nhập mã giảm giá.', 'Thông báo');
				}else{
					$.ajax({
						type: "GET",
						url: "{{ route('home.check.coupon') }}",
						data: {
							q : coupon,
						},
						success: function (data) {
							$('.loadingcover').hide();
							if(data.message == 'success'){
								console.log(data.data);
								showToast('Mã giảm giá '+coupon+' được áp dụng thành công.' , 'Thông báo');
								$html = '<p>Giảm giá</p><div class="amount">-'+data.data.discount_amount+'đ</div>';
								$('.discount_amount').html($html);
								$('#price').html(data.data.grand_total+'đ');
							}else{
								$('#coupon-input').val('');
								$('#price').html($('#base_price').val());
								$('.discount_amount').html('');
								showToast('Mã giảm giá không hợp lệ.' , 'Thông báo');
							}
						}
					});
				}
			});


			@if (!empty(request('coupons-code')))
				jQuery(document).ready(function($) {
					$('#coupon-check').click();
				});
			@endif
		});
	</script>
@endsection