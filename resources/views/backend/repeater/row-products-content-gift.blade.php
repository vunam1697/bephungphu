<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td>
		<textarea id="content{{ $id }}" name="content_gift[{{ $id }}][title]">{!! @$value->title !!}</textarea>
	</td>
	<td>
        <textarea class="form-control" name="content_gift[{{ $id }}][value]" rows="5" placeholder="Mỗi lựa chọn phân tách với nhau bằng dấu | VD: Lựa chọn 1 | Lựa chọn 2">{{ @$value->value }}</textarea>
	</td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>
<script>
	CKEDITOR.replace( 'content{{ $id }}' )
</script>