<div class="box-comment-custom box-comment" style="padding-left:25px;">
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