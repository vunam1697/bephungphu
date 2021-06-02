@extends('backend.layouts.app')
@section('controller','Đơn hàng')
@section('action','Cập nhật')
@section('controller_route', route('order.index'))
@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{ route('order.edit.post', $data->id) }}" method="POST">
                	@csrf
                	<div class="row">
                		<div class="col-sm-2"></div>
                		<div class="col-sm-8">
                			<div class="row">
				                <div class="col-md-3"><label>Mã đơn hàng:</label></div>
				                <div class="col-md-9">
				                  	<a href="#">{!!'#ORDER_'.$data['id'] !!}</a>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col-md-3"><label>Tên người nhận:</label></div>
				                <div class="col-md-9">
				                  	<b>{!! $data->Customers->name !!}</b>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col-md-3"><label>Email:</label></div>
				                <div class="col-md-9">
				                  	<b>{!! $data->Customers->email !!}</b>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col-md-3"><label>Số điện thoại người nhận:</label></div>
				                <div class="col-md-9">
				                  	<b>{!! $data->Customers->phone !!}</b>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col-md-3"><label>Địa chỉ:</label></div>
				                <div class="col-md-9">
				                  	<b>{!! $data->Customers->address !!} - {{ getFullAddress($data->Customers->id_province, $data->Customers->id_district, $data->Customers->id_ward) }}</b>
				                </div>
				            </div>
				            <div class="row">
				            	<div class="col-md-3"><label>Nội dung :</label></div>
				            	<div class="col-md-9">
				                  	<b>{{ $data->note }}</b>
				                </div>
				            </div>
				            <div class="row">
				            	<div class="col-md-3"><label>Ngày đặt</label></div>
				            	<div class="col-md-9">
				                  	<b>{{ $data->created_at->format('d/m/Y H:i:s') }}</b>
				                </div>
				            </div>
				            <div class="row">
				            	<div class="col-md-3"><label>Ngày nhận</label></div>
				            	<div class="col-md-9">
				                  	<b>{{ $data->status == 4 ? $data->updated_at->format('d/m/Y H:i:s') : "-----------" }}</b>
				                </div>
				            </div>
				            <div class="row">
				            	<div class="col-md-3"><label>Tổng tiền :</label></div>
				            	<div class="col-md-9">
				                  	<b>{{ number_format($data->subtotal_total) }}đ</b>
				                </div>
							</div>
							<div class="row">
				            	<div class="col-md-3"><label>Khuyến mại :</label></div>
				            	<div class="col-md-9">
				                  	<b>{{ number_format($data->discount_amount) }}đ</b>
				                </div>
							</div>
							@if (!empty($data->id_coupon))
								<div class="row" style="margin-top: 20px; margin-bottom: 20px">
									<div class="col-md-3"><label>Mã khuyến mại: </label></div>
									<div class="col-md-9">
										<?php $coupon = \App\Models\Coupons::find($data->id_coupon); ?>
										@if (!empty($coupon))
											<ul>
												<li>{{ $coupon->code }}</li>
												<li>{{ $coupon->name }}</li>
												<li>{{ $coupon->value }} - {{ $coupon->type == 1 ? 'Giảm theo phần trăm' : 'Giảm theo tiền' }}</li>
												<li><a href="{{ route('coupons.edit', ['id'=>$coupon->id ]) }}">Chi tiết</a></li>
											</ul>
										@endif
									</div>
								</div>

							@endif
							<div class="row">
				            	<div class="col-md-3"><label style="color: red">Tổng tiền khách phải trả :</label></div>
				            	<div class="col-md-9" style="color: red">
				                  	<b>{{ number_format($data->grand_total) }}đ</b>
				                </div>
							</div>
				            <div class="row">
				            	<div class="col-md-3"><label>Hình thức thanh toán:</label></div>
				            	<div class="col-md-9">
				            		@if ($data->type_pay == "COD")
				            			<label class="label label-success">Thanh toán khi nhận hàng</label>
				            		@else
										<label class="label label-success">Thanh toán</label>
				            		@endif
				                </div>
				            </div>
				            <div class="row">
				            	<div class="col-md-3"><label>Trạng thái:</label></div>
				            	<div class="col-md-9">
				                  	@if ($data->status == 1)
				                  		<span class="label label-warning"> Mới đặt</span>
				                  	@elseif($data->status == 2)
										<span class="label label-primary"> Xác nhận</span>
									@elseif($data->status == 3)
										<span class="label label-info"> Đang giao hàng</span>
									@elseif($data->status == 4)
										<span class="label label-success"> Hoàn thành</span>
									@else
										<span class="label label-danger">Hủy</span>
				                  	@endif
				                  	<a href="javascript;;"  data-toggle="modal" data-target="#exampleModal" style="text-decoration: underline;">
				                  		Thay đổi trạng thái đơn hàng
				                  	</a>
				                  	<!-- Modal -->
									<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									    <div class="modal-dialog" role="document">
									        <div class="modal-content">
									        	<form action="{{ route('order.edit.post', $data->id) }}" method="POST">
									        		@csrf
										            <div class="modal-header">
										                <h5 class="modal-title" id="exampleModalLabel">Trạng thái</h5>
										                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										                    <span aria-hidden="true">&times;</span>
										                </button>
										            </div>
										            <div class="modal-body">
										                <div class="row">
										                	<div class="col-sm-3">
										                		<b>Chọn trạng thái:</b>
										                	</div>
										                	<div class="col-sm-9">
										                		<select class="form-control" name="status">
											                        <option value="1" @if($data['status'] == 1) selected @endif>Mới đặt</option>
											                        <option value="2" @if($data['status'] == 2) selected @endif>Xác nhận</option>
											                        <option value="3" @if($data['status'] == 3) selected @endif>Đang giao hàng</option>
											                        <option value="4" @if($data['status'] == 4) selected @endif>Hoàn thành</option>
											                        <option value="5" @if($data['status'] == 5) selected @endif>Hủy</option>
											                    </select>
										                	</div>
										                </div>
										            </div>
										            <div class="modal-footer">
										                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										                <button type="submit" class="btn btn-primary">Lưu lại</button>
										            </div>
									            </form>
									        </div>
									    </div>
									</div>
				                </div>
				            </div>
				            <hr>
				            <h3 class="text-center">CHI TIẾT ĐƠN HÀNG</h3>
				            <table class="table table-bordered table-striped">
				            	<?php $total_product = 0; ?>
				                <thead>
				                    <tr>
				                        <th>STT</th>
				                        <th>Sản phẩm</th>
				                        <th>Hình ảnh</th>
				                        <th>Số lượng</th>
				                        <th>Đơn giá</th>
				                        <th>Thành tiền</th>
				                        <th>Quà tặng</th>
				                        {{-- <th>Khách lấy</th> --}}
				                    </tr>
				                </thead>
				                <tbody>
				                    @if (!empty($data->OrderDetail))
				                        @foreach ($data->OrderDetail as $item)

				                            <tr>
				                                <td>{{ $loop->index + 1 }}</td>
				                                <td>
				                                    {{ @$item->products->name }} 
													@if (!empty($item->options))
														<label for="" class="label label-success">{{ $item->options }}</label>
													@endif
				                                    <br>
				                                    @if (!empty($item->product->deleted_at))
				                                        <label for="" class="label label-danger">Sản phẩm đã xóa</label>
				                                    @endif
				                                </td>
				                                <td>
				                                    <img src="{{ $item->products->image }}" class="img-thumbnail" width="50px" alt="">
				                                </td>
				                                <td>
				                                    {{ @$item->product_quantity }}
				                                    <?php $total_product = $total_product + $item->product_quantity; ?>
				                                </td>
				                                <td>
				                                    {{ number_format($item->price) }}
				                                </td>
				                                <td>
				                                    {{ number_format($item->price_total) }}
				                                </td>
				                                
				                                <td>
				                                	@if (!empty($item->choice))
				                                		<?php $choice = json_decode( $item->choice ); ?>
				                                		@foreach ($choice as $value)
				                                			<li>{{ $value }}</li>
				                                		@endforeach
				                                	@else
				                                	---
				                                	@endif
				                                </td>
				                            </tr>
				                        @endforeach
				                    @endif
				                </tbody>
			              	</table>
			              	<div class="row" style="font-size: 15px">
			              		<div class="col-sm-4"></div>
			              		<div class="col-sm-8">
			              			<div class="row">
			              				<div class="col-sm-6">Tổng tiền ( {{ $total_product }} sản phẩm )</div>
										<div class="col-sm-6">{{ number_format($data->subtotal_total) }}đ</div>
										<div class="col-sm-6">Giảm giá</div>
										<div class="col-sm-6">{{ number_format($data->discount_amount) }}đ</div>
									  </div>
									  <hr>
									  <div class="row" style="margin-top: 10px">
										<div class="col-sm-6"><b>Tổng tiền khách phải trả </b> </div>
										<div class="col-sm-6"> <b>{{ number_format($data->grand_total) }}đ</b></div>
									  </div>
			              		</div>
			              	</div>
			              	<hr>
                		</div>
                	</div>
                </form>
            </div>
        </div>
    </div>
@stop