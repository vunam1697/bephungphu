<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td>
		<input type="text" value="{{ @$value->title }}" class="form-control" name="value[list][{{ $id}}][title]">
	</td>
	<td>
       <input type="number" value="{{ @$value->value }}" class="form-control" name="value[list][{{ $id}}][value]">
	</td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>