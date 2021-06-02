<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<?php $product_attribute_types = \App\Models\ProductAttributeTypes::all(); ?>
	<td>
		<select name="product_version[{{ $id }}][id_product_attribute_types]" class="form-control">
			@foreach ($product_attribute_types as $item)
				<option value="{{ $item->id }}">{{ $item->name }}</option>
			@endforeach
		</select>
	</td>
	<td><input type="text" class="form-control" name="product_version[{{ $id }}][key]" required=""></td>
	<td><input type="number" class="form-control" name="product_version[{{ $id }}][value]" required=""></td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>
