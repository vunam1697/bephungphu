@extends('frontend.master')
@section('main')
	<section id="bread">
		<div class="container">
			<div class="content">
				<ul class="list-inline">
					<li class="list-inline-item"><a title="Trang chủ" href="{{ url('/') }}">Trang chủ</a></li>
					<li class="list-inline-item"><a title="" href="javascript:0">Tìm kiếm từ khóa: {{ request()->get('q') }}</a></li>
				</ul>
			</div>
		</div>
	</section>


	<section id="product">
		<div class="container">
			<div class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="right-product">
							<div class="tab-pane pane-prd active" style="background: #fff;">
								<div class="list-product">
									<div class="row">
										@if (count($data))
											@foreach ($data as $item)
												<div class="col-lg-2 col-sm-2 col-6">
													@component('frontend.components.product', ['item' => $item])
													    
													@endcomponent
												</div>
											@endforeach
										@else
											<div class="col-sm-12">
												<div class="alert alert-success" role="alert">
												  	Không có sản phẩm nào phù hợp.
												</div>
											</div>
										@endif
										
										
										<div class="col-sm-12">
											<div class="pagination" style="padding-top: 30px; padding-bottom: 30px">
												<ul class="list-inline text-center">
													{!! $data->appends(request()->except('page'))->links() !!}
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@stop