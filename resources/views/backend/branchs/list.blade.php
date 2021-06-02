@extends('backend.layouts.app')
@section('controller', $module['name'] )
@section('controller_route', route($module['module'].'.index'))
@section('action', 'Danh sách')
@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('flash::message')
                <form action="{!! route($module['module'].'.postMultiDel') !!}" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="btnAdd">
                        <a href="{{ route($module['module'].'.create') }}">
                            <fa class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</fa>
                        </a>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn xóa không ?')">
                            <i class="fa fa-trash-o"></i> Xóa
                        </button>
                    </div>
                   	<table id="example1" class="table table-bordered table-striped table-hover">
						<thead>
						    <tr>
						        <th width="10px"><input type="checkbox" name="chkAll" id="chkAll"></th>
						        <th width="10px">STT</th>
						        @foreach ($module['table'] as $key => $item)
						           <th width="{{ @$item['with'] }}">{{ $item['title'] }}</th>
						        @endforeach
						        <th width="100px">Thao tác</th>
						    </tr>
					    </thead>
					    <tbody>
					        @foreach ($data as $item)
					        	<tr>
					        		<td>
					        			<input type="checkbox" name="chkItem[]" value="{{ $item->id }}">
					        		</td>
					        		<td>{{ $loop->index + 1 }}</td>
					        		<td>{{ $item->name }}</td>
					        		<td>{{ $item->phone }}</td>
					        		<td>{{ $item->email }}</td>
					        		<td>
					        			@if ($item->status == 1)
					        				<span class="label label-success">Hiển thị</span>
					        			@else
											<span class="label label-danger">Không hiển thị</span>
					        			@endif
					        		</td>
					        		<td>
					        			<a href="{{ route($module['module'].'.edit', $item->id) }}" title="Sửa"><i class="fa fa-pencil fa-fw"></i> Sửa </a> &nbsp; &nbsp; &nbsp;
				                        <a href="javascript:;" class="btn-destroy" data-href="{{ route($module['module'].'.destroy', $item->id) }}" data-toggle="modal" data-target="#confim">
				                            <i class="fa fa-trash-o fa-fw"></i> Xóa
				                        </a>
					        		</td>
					        	</tr>
					        @endforeach
					    </tbody>
					</table>
                </form>
            </div>
        </div>
    </div>
@stop