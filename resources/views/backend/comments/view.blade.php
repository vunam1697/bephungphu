@extends('backend.layouts.app')
@section('controller', $module['name'] )
@section('controller_route', route($module['module'].'.index'))
@section('action', 'Tất cả bình luận')
@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('flash::message')
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-widget">
						    <div class="box-header with-border">
						        <div class="user-block" >
						            <span class="username" style="margin-left: 0px"><a href="{{ route('home.single.product', $data->slug) }}" target="_blank">Sản phẩm: {{ $data->name }}</a></span>
						        </div>
						    </div>
						    <div class="box-footer box-comments">
						    	<?php $list_comments = \App\Models\Comments::where('id_product', $data->id)->where('id_customers', '!=', 77)->where('parent_id', 0)->order()->get(); ?>
						    	@if (count($list_comments))
									@foreach ($list_comments as $item)
									    <div class="box-comment">
									        <div class="comment-text">
									            <span class="username"> {{ $item->type != 1 ? @$item->Customers->name.' - '.@$item->Customers->email.' - '.@$item->Customers->phone : 'Administrator' }} 
									            	<span class="text-muted pull-right">{{ $item->created_at->format('d/m/yy') }}</span>
									            	@if ($item->status != 1)
									            		<a href="javascript:;" class="activeq" data-id="{{  $item->id }}'"><label class="label label-danger">Chưa duyệt</label></a>
									            	@endif
									            </span>
									            @if (!empty($item->image))
				                					<?php $list_images = json_decode( $item->image ); ?>
				                					<div class="row-upload">
				                						@foreach ($list_images as $value)
				                							<div class="col-upload">
				                								<img src="{{ url('uploads/comments/'.$value ) }}" class="image_comment">
				                							</div>
					                					@endforeach
				                					</div>
				                				@endif
									           	<p>{!! $item->content !!}</p>
									           	<div style="margin-top: 10px">
									           		<button type="button" class="btn btn-default btn-xs btn-reply" data-id="{{ $item->id }}">
									           			<i class="fa fa-share"></i> Trả lời</button>
									           		<button type="button" class="btn btn-default btn-xs btn-destroy" data-href="{{ route('comments.destroy', $item->id) }}" data-toggle="modal" data-target="#confim"><i class="fa fa-trash"></i> Xóa bỏ</button>
									           	</div>
									        </div>
									    </div>

										<?php renderComments($list_comments, $item) ?>

									@endforeach
								@endif
							</div>
						    <div class="box-footer">
						    	<p style="font-weight: bolder; font-style: italic; color: red">TIP: Xóa bình luận sẽ xóa hết tất cả các câu trả lời của bình luận đó. Bạn nên cân nhắc khi xóa bình luận.</p>
						        <form action="{{ route($module['module'].'.store') }}" method="POST">
						        	@csrf
						        	<input type="hidden" name="parent_id" value="0">
						        	<input type="hidden" name="id_product" value="{{ $data->id }}">
						            <div class="form-group">
						            	<label for="">Trả lời</label>
						            	<textarea class="content" name="content">{!! old('content') !!}</textarea>
						            </div>
						            <button class="btn btn-primary" type="submit">Trả lời</button>
						        </form>
						    </div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="ModalReply" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	    <div class="modal-dialog  modal-lg" role="document">
	    	<form action="{{ route($module['module'].'.store') }}" method="POST">
	    		@csrf
	        	<input type="hidden" name="parent_id" id="parent_id_reply" value="">
	        	<input type="hidden" name="id_product" value="{{ $data->id }}">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title" id="exampleModalLongTitle">Trả lời bình luận</h5>
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                    <span aria-hidden="true">&times;</span>
		                </button>
		            </div>
		            <div class="modal-body">
		                <div class="form-group">
			            	<label for="">Trả lời</label>
			            	<textarea id="content-1" name="content">{!! old('content') !!}</textarea>
			            </div>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		                <button type="submit" class="btn btn-primary">Trả lời</button>
		            </div>
		        </div>
	        </form>
	    </div>
	</div>
@stop
@section('css')
	<style>
		.row-upload .col-upload {
		    padding: 0 7px;
		}
		.row-upload {
		    display: inline-flex;
		    width: 100%;
		    flex-wrap: wrap;
		    margin-top:10px;
		    margin-left:0px;
		}
		.row-upload .col-upload img {
		    width: 70px;
		    height: 70px;
		    object-fit: cover;
		    border-radius: 3px;
		}
		p:empty{
			display: none;
		}

		.box-comments .comment-text{
			margin-left: 0px;
		}
		.box-comment-custom{
			padding-top: 10px;
    		border-bottom: 1px solid #eee;
		}
		.box-comment-custom	.btn-reply{
			display: inline-block;
    		margin-right: 3px;
		}
		.activeq label{
			cursor: pointer;
		}
	</style>
@endsection

@section('scripts')
	<script>
		jQuery(document).ready(function($) {
			$('.btn-reply').click(function(event) {
				var parent_id = $(this).data('id');
				$('#parent_id_reply').val(parent_id);
				$('#ModalReply').modal('toggle');
			});

			$('.activeq').click(function(event) {
				id = $(this).data('id');
                var btn = $(this);
                $.get('{{ route('comments.active') }}?id='+id, function(data) {
                    btn.html('');
                });
			});
		});
		var editor = CKEDITOR.replace($(this).attr('content-1'));
        CKFinder.setupCKEditor(editor);
	</script>
@endsection