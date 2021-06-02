<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td>
		<div class="form-group">
			<label for="">Liên kết</label>
	       	<div class="image">
	           	<div class="image__thumbnail">
	               	<img src="{{ !empty($value->image) ?  $value->image : __IMAGE_DEFAULT__ }}"  
	               		data-init="{{ __IMAGE_DEFAULT__ }}">
	               	<a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
	                <i class="fa fa-times"></i></a>
	               	<input type="hidden" value="{{ @$value->image }}" name="content[partner][{{ $id }}][image]"  />
	               	<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
	           	</div>
	       	</div>
	   </div>
	</td>
	<td>
		<div class="form-group">
			<label for="">Liên kết</label>
			<input type="text" name="content[partner][{{ $id }}][link]" value="{{ @$value->link }}" class="form-control" required="">
		</div>
		<div class="form-group">
			<label for="">Mô tả</label>
			<textarea class="form-control" rows="5" name="content[partner][{{ $id }}][desc]" required="">{{ @$value->desc }}</textarea>
		</div>
	</td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>