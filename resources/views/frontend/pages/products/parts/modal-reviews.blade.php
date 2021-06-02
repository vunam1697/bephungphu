<div class="popup-danhgia">
	<div class="modal fade" id="myModal-dg">
		<div class="modal-dialog">
		    <div class="modal-content">
			    <div class="modal-body modal-dg">
			    	<form action="{{ route('home.post.comment', $data->id) }}" method="POST" enctype="multipart/form-data" id="formsreviews">
			    		@csrf
				        <div class="content-dg">
				        	<div class="tit-pop">
				        		<h3>Đánh giá {{ $data->name }}</h3>
				        		<button type="button" class="close" data-dismiss="modal"><img src="{{ __BASE_URL__ }}/images/clc.png" class="img-fluid" alt="images"></button>
				        	</div>
				        	<div class="quess">
				        		@if (count($data->ProductQuestions()->order()->get()))
				        			@foreach ($data->ProductQuestions()->order()->get() as $item)
				        				<div class="item">
						        			<p>{{ $item->content }}</p>
						        			<ul class="list-inline text-right">
						        				<li class="list-inline-item">
						        					<input type="radio" name="quess[{{ $item->id }}]" id="q-{{ $loop->index + 1 }}" value="yes">
						        					<label for="q-{{ $loop->index + 1 }}" class="yes">Có</label>
						        				</li>
						        				<li class="list-inline-item">
						        					<input type="radio" name="quess[{{ $item->id }}]" id="no-{{ $loop->index + 1 }}" value="no">
						        					<label for="no-{{ $loop->index + 1 }}" class="no">Không</label>
						        				</li>
						        			</ul>
						        		</div>
				        			@endforeach
				        		@endif
				        		<div class="item">
				        			<div class="form-group" style="width: 100%">
				        				<textarea cols="30" rows="10" placeholder="Mời bạn chia sẽ thêm một số cảm nhận..." name="content"></textarea>
				        			</div>
				        		</div>
				        		<div class="upload-file">
				        			<div class="tit-up"><img src="{{ __BASE_URL__ }}/images/anh.png" class="img-fluid" alt="anh">Gửi hình chụp thực tế</div>
				        			<div id="selectedFiles" class="row-upload">
										<div class="col-upload">
											<div class="item">
												<input type="file" id="files" name="files[]" multiple>
												<label for="files"><img src="{{ __BASE_URL__ }}/images/plus.png" class="plus img-fluid" alt="plus"></label>
											</div>
										</div>
									</div>
				        		</div>
				        		<div class="raiting">
				        			<ul class="list-inline">
				        				<li class="list-inline-item"><span>Bạn cảm thấy sản phẩm như thế nào?</span></li>
				        				<li class="list-inline-item">
				        					<div class="it-rait">
				        						<input type="radio" id="r-1" name="raiting" value="1">
				        						<label for="r-1">Rất tệ</label>
				        					</div>
				        				</li>
				        				<li class="list-inline-item">
				        					<div class="it-rait">
				        						<input type="radio" id="r-2" name="raiting" value="2">
				        						<label for="r-2">Tệ</label>
				        					</div>
				        				</li>
				        				<li class="list-inline-item">
				        					<div class="it-rait">
				        						<input type="radio" id="r-3" name="raiting" value="3">
				        						<label for="r-3">Bình thường</label>
				        					</div>
				        				</li>
				        				<li class="list-inline-item">
				        					<div class="it-rait">
				        						<input type="radio" id="r-4" name="raiting" checked="" value="4">
				        						<label for="r-4">Tốt</label>
				        					</div>
				        				</li>
				        				<li class="list-inline-item">
				        					<div class="it-rait">
				        						<input type="radio" id="r-5" name="raiting" value="5">
				        						<label for="r-5">Rất tốt</label>
				        					</div>
				        				</li>
				        			</ul>
				        		</div>
				        		<div class="info">
				        			<div class="row">
				        				<div class="col-md-4">
				        					<div class="form-group">
				        						<input type="text" placeholder="Họ tên (Bắt buộc)" name="name">
				        					</div>
				        				</div>
				        				<div class="col-md-4">
				        					<div class="form-group">
					        					<input type="text" placeholder="Email (Không bắt buộc)" name="email" class="email-customers">
					        				</div>
				        				</div>
				        				<div class="col-md-4">
				        					<div class="form-group">
					        					<input type="text" placeholder="Số điện thoại (Bắt buộc)" name="phone">
					        				</div>
				        				</div>
				        			</div>
				        		</div>
				        		<div class="btb-pop text-center"><input type="submit" id="comment-button" value="Gửi đánh giá"></div>
				        	</div>
				        </div>
			        </form>
			    </div>
		    </div>
		</div>
	</div>
</div>
