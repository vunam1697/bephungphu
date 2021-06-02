<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td>
		<input type="text" name="content[filter][{{ $id }}][name]" class="form-control" value="{{ @$value->name }}">
	</td>
	<td>
		<input type="text" name="content[filter][{{ $id }}][value]" class="form-control" value="{{ @$value->value }}">
	</td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>
