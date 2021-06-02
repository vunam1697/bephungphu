@extends('backend.layouts.app')
@section('controller','Cấu hình chung')
@section('action','Cập nhật')
@section('controller_route', route('backend.options.general'))
@section('content')
	<div class="content">
        <div class="clearfix"></div>
		@include('flash::message')
		<form action="{{ route('backend.options.general.post') }}" method="POST">
			@csrf
				<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin chung</a>
					</li>
					
					<li class="">
						<a href="#activity2" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>
					</li>
					<li class="">
						<a href="#activity3" data-toggle="tab" aria-expanded="true">Footer - Mạng xã hội</a>
					</li>
					
					<li class="">
						<a href="#activity4" data-toggle="tab" aria-expanded="true">Liên kết</a>
					</li>
				</ul>
				<div class="tab-content">

					<div class="tab-pane active" id="activity">
						<div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label>Favicon</label>
									<div class="image">
										<div class="image__thumbnail">
											<img src="{{ !empty($content->favicon) ? $content->favicon :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
											<a href="javascript:void(0)" class="image__delete" 
											onclick="urlFileDelete(this)">
											<i class="fa fa-times"></i></a>
											<input type="hidden" value="{{ @$content->favicon }}" name="content[favicon]"  />
											<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<label>Logo</label>
									<div class="image">
										<div class="image__thumbnail">
											<img src="{{ !empty($content->logo) ? $content->logo :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
											<a href="javascript:void(0)" class="image__delete" 
											onclick="urlFileDelete(this)">
											<i class="fa fa-times"></i></a>
											<input type="hidden" value="{{ @$content->logo }}" name="content[logo]"  />
											<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-2">
								<div class="form-group">
									<label>Hình ảnh đại diện khi chia sẻ</label>
									<div class="image">
										<div class="image__thumbnail">
											<img src="{{ !empty($content->logo_share) ? $content->logo_share :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
											<a href="javascript:void(0)" class="image__delete" 
											onclick="urlFileDelete(this)">
											<i class="fa fa-times"></i></a>
											<input type="hidden" value="{{ @$content->logo_share }}" name="content[logo_share]"  />
											<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							
							<div class="col-sm-3">
								<div class="form-group">
									<label for="">Code Fanpages Facebook</label>
									<textarea name="content[code_facebook]" class="form-control" rows="10">{!! @$content->code_facebook !!}</textarea>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label for="">Code Google Analytics</label>
									<textarea name="content[google_analytics]" class="form-control" rows="10">{!! @$content->google_analytics !!}</textarea>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label for="">Script</label>
									<textarea name="content[script]" class="form-control" rows="10">{!! @$content->script !!}</textarea>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="">Hotline</label>
									<input type="text" class="form-control" name="content[hotline]" value="{{ @$content->hotline }}">
								</div>
								<div class="form-group">
									<label for="">Email nhận yêu cầu đặt hàng</label>
									<input type="email" class="form-control" name="content[email_admin]" value="{{ @$content->email_admin }}">
								</div>

								<div class="form-group">
									<label class="custom-checkbox">
										<input type="checkbox" name="content[index_google]" value="1" {{ @$content->index_google == 1 ? 'checked' : null }}> 
										Cho phép google tìm kiếm
									</label>
								</div>

							</div>
							
						</div>
					</div>

					<div class="tab-pane" id="activity2">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="">Tên website</label>
									<input type="text" class="form-control" name="content[site_title]"
									value="{{ @$content->site_title }}">
								</div>

								<div class="form-group">
									<label for="">Mô tả ngắn</label>
									<textarea class="form-control" rows="5" 
									name="content[site_description]">{{ @$content->site_description }}</textarea>
								</div>

								<div class="form-group">
									<label for="">Meta keyword</label>
									<input type="text" class="form-control" name="content[site_keyword]"
									value="{{ @$content->site_keyword }}">
								</div>

							</div>
						</div>
					</div>
					
					<div class="tab-pane" id="activity3">
						<div class="row">
							<div class="col-sm-12">
								<div class="repeater" id="repeater">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th style="width: 30px;">STT</th>
												<th>Tên mạng xã hội</th>
												<th>Icon</th>
												<th>Liên kết</th>
												<th></th>
											</tr>
										</thead>
										<tbody id="sortable">
											@if (!empty($content->social))
												@foreach ($content->social as $id => $val)
													<tr>
														<td class="index">{{ $loop->index + 1  }}</td>
														<td><input type="text" class="form-control" name="content[social][{{$id}}][name]" value="{{ $val->name }}" ></td>
														<td><input type="text" class="form-control" name="content[social][{{$id}}][icon]" required="" value="{{ $val->icon }}"></td>
														<td>
															<input type="text" class="form-control" required="" name="content[social][{{$id}}][link]" value="{{ $val->link }}">
														</td>
														<td style="text-align: center;">
															<a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
																<i class="fa fa-minus"></i>
															</a>
														</td>
													</tr>
												@endforeach
											@endif
										</tbody>
									</table>
									<div class="text-right">
										<button class="btn btn-primary" 
											onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'social')">Thêm
										</button>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-6">
										<label for="" style="text-align: center;display: block;">Cột 1 Footer</label>
										<div class="form-group">
											<label for="">Tiêu đề cột</label>
											<input type="text" class="form-control" value="{{ @$content->col_footer_1->title }}" name="content[col_footer_1][title]">
										</div>
										<div class="form-group">
											<label for="">Nội dung</label>
											<textarea class="content" name="content[col_footer_1][value]">{!! @$content->col_footer_1->value !!}</textarea>
										</div>
									</div>
									<div class="col-sm-6">
										<label for="" style="text-align: center;display: block;">Cột 2 Footer</label>
										<div class="form-group">
											<label for="">Tiêu đề cột</label>
											<input type="text" class="form-control" value="{{ @$content->col_footer_2->title }}" name="content[col_footer_2][title]">
										</div>
										<div class="form-group">
											<label for="">Nội dung</label>
											<textarea class="content" name="content[col_footer_2][value]">{!! @$content->col_footer_2->value !!}</textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane" id="activity4">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="">Link message</label>
									<input type="text" name="content[link][message]" class="form-control" value="{{ @$content->link->message }}">
								</div>
								<div class="form-group">
									<label for="">Link zalo</label>
									<input type="text" name="content[link][zalo]" class="form-control" value="{{ @$content->link->zalo }}">
								</div>
								<div class="form-group">
									<label for="">Link tin nhắn</label>
									<input type="text" name="content[link][orther]" class="form-control" value="{{ @$content->link->orther }}">
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<button class="btn btn-primary" type="submit">Lưu lại</button>
				</div>
			</div>
		</form>
    </div>
@stop