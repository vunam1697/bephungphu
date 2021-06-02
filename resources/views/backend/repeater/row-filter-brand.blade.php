<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td>
		<input type="text" name="content[filter][{{ $id }}][name]" class="form-control" value="{{ @$value->name }}">
	</td>
	<td>
		<select name="content[filter][{{ $id }}][brand_id]" class="form-control">
			<?php $data = \App\Models\Categories::where('type', 'brand_category')->get(); ?>
			@if (count($data))
				@foreach ($data as $item)
					<option value="{{ $item->id }}" {{ @$value->brand_id == $item->id ? 'selected' : null }}>{{ $item->name }}</option>
				@endforeach
			@endif
		</select>
	</td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>
