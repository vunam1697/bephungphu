<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td>
		<select name="content[category][{{ $id }}][category_id]" class="form-control">
			<?php $categories = \App\Models\Categories::where('type','product_category')->where('parent_id', 0)->get(); ?>
			@foreach ($categories as $item)
				<option value="{{ $item->id }}" {{ $item->id == @$value->category_id ? 'selected' : null }}>{{ $item->name }}</option>
			@endforeach
		</select>
	</td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>