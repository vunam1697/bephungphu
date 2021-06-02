<div class="repeater" id="repeater">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
            	<th style="width: 30px;">STT</th>
            	<th>Tiêu đề</th>
            	<th>Giá trị nhỏ nhất</th>
            	<th>Giá trị lớn nhất</th>
            	<th style="width: 30px;"></th>
            </tr>
    	</thead>
        <tbody id="sortable">
			@if (!empty($content->filter))
                @foreach ($content->filter as $id => $value)
                    <?php $index = $loop->index +1  ?>
                    @include('backend.repeater.row-filter-price')
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="text-right">
        <button class="btn btn-primary" onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'filter-price')">Thêm</button>
    </div>
</div>