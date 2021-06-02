@if ($item->status == 1)
<div class="anser">
	<div class="avarta"><img src="{{ __BASE_URL__ }}/images/user.png" class="img-fluid" alt="images"></div>
	<div class="info">
		@if ($item->type == 1)
			<h5>
				<?php $userAdmin = \App\User::find($item->id_customers); ?>
				@if (!empty($userAdmin))
					{{ $userAdmin->name }}
				@else
					Administrator
				@endif
				<span class="badge badge-success">Quản trị viên</span>
			</h5>
		@else
			<h5>{{ @$item->Customers->name }}</h5>
		@endif
		<div class="desc">
			{!! $item->content !!}
			@if (!empty($item->image))
				<?php $list_images = json_decode( $item->image ); ?>
				<div class="row-upload">
					@foreach ($list_images as $value)
						<div class="col-upload">
							<img src="{{ url('uploads/comments/'.$value ) }}" class="image_comment" alt="comments">
						</div>
					@endforeach
				</div>
			@endif
			
		</div>
		<div class="date-btn">
			<ul class="list-inline">
				<li class="list-inline-item">
					<a title="" href="javascript:0" data-idform="{{ $item->id }}">Trả lời</a>
				</li>
				<li class="list-inline-item">{{ $item->created_at->diffForHumans() }}</li>
			</ul>
		</div>
	</div>
</div>
<div class="action-cmt {{ $item->id }}">
	<form action="{{ route('home.post.reply.comment', $idProduct) }}" method="POST" enctype="multipart/form-data" class="form_reply">
		@csrf
		<input type="hidden" name="parent_id" value="{{ $item->id }}">
		<div class="box-cmt">
			<div class="item-box">
				<div class="form-group">
					<textarea name="content" required="" maxlength="300" cols="30" rows="10" placeholder="">{{ $item->type == 0 ? '@'.$item->Customers->name : '@Quản trị viên' }}:</textarea>
				</div>
			</div>
			<div class="item-box">
				<div class="fileUpload btn btn--browse">
				    <span><img src="{{ __BASE_URL__ }}/images/camera.png" class="img-fluid" alt="camera">Gửi hình</span>
				    <input id="uploadBtn" type="file" class="upload" name="image_rv[]" multiple="" />
				</div>
				<p id="file-list-x"></p>
				<input id="uploadFile" class="f-input" readonly />
				<button type="button">Gửi</button>
			</div>
			<div class="item-box item-box-per">
				<div class="info-percen">
					<p>Nhập thông tin của bạn</p>
					<ul class="list-inline">
						<li class="list-inline-item">
							<div class="gt">
								<div class="gt-rd">
									<input type="radio" id="gt-{{ $item->id }}-1" name="gioitinh" value="1" checked>
									<label for="gt-{{ $item->id }}-1">Anh</label>
								</div>
								<div class="gt-rd">
									<input type="radio" id="gt-{{ $item->id }}-2" name="gioitinh" value="2">
									<label for="gt-{{ $item->id }}-2">Chị</label>
								</div>
							</div>
						</li>
						<li class="list-inline-item">
							<div class="form-group">
								<input type="text" placeholder="Họ tên" class="inp-text" name="name" min="5" max="50" required="">
							</div>
							
						</li>
						<li class="list-inline-item">
							<div class="form-group">
								<input type="email" placeholder="Email" class="inp-text email_rp" name="email" required="">
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="item-box item-box-per text-center">
				<input type="submit" value="Hoàn tất & gửi" class="btn-sent">
			</div>
		</div>
	</form>
</div>
@endif