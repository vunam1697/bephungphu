@extends('backend.layouts.app') 
@section('controller','Bộ lọc theo danh mục')
@section('controller_route', route('list-category-filter'))
@section('action','Danh sách')
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
           		@include('flash::message')
           		{{-- <div class="form-group">
           			<a class="btn btn-success" href="{{ route('pages.build', ['page' => 'products']) }}" style="ma">Cài đặt bộ lọc sản phẩm cho trang sản phẩm</a>
           		</div> --}}
           		<table id="example1" class="table table-bordered table-striped table-hover">
			        <thead>
			          	<tr>
			              	<th width="30px">STT</th>
			              	<th>Tên danh mục</th>
			              	<th width="150px">Thao tác</th>
			          	</tr>
			        </thead>
		          	<tbody>
		          		<tr>
	              			<td>1</td>
	              			<td>Trang sản phẩm</td>
	              			<td><a href="{{ route('filter.index', [ 'category'=> 0 ]) }}" class="btn btn-success btn-sm">Bộ lọc</a></td>
	              		</tr>
		              	@foreach ($data as $item)
		              		<tr>
		              			<td>{{ $loop->index + 2 }}</td>
		              			<td>{{ $item->name }}</td>
		              			<td><a href="{{ route('filter.index', [ 'category'=>$item->id ]) }}" class="btn btn-success btn-sm">Bộ lọc</a></td>
		              		</tr>
		              	@endforeach
		          	</tbody>
		      	</table>
           	</div>   
        </div>
    </div>
@stop