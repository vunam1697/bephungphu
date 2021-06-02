@extends('backend.layouts.app')
@section('controller', 'Thương hiệu' )
@section('controller_route', route('brand.index') )
@section('action', 'Danh sách')
@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('flash::message')
               
                <div class="btnAdd">
                    <a href="{{ route($module['module'].'.create') }}">
                        <fa class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</fa>
                    </a>
                </div>
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="30px"><input type="checkbox" name="chkAll" id="chkAll"></th>
                            <th width="30px">STT</th>
                            <th>Tên thương hiệu</th>
                            <th>Liên kết</th>
                            <th>Số thứ tự</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td><input type="checkbox" name="chkItem[]" value="{!! $item['id'] !!}"></td>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{!! $item->name !!}</td>
                                <td><a href="{{ url('thuong-hieu/'.$item->slug) }}" target="_blank">{{ url('thuong-hieu/'.$item->slug) }}</a></td>
                                <td>{{ $item->order }}</td>
                                <td>
                                    <div>
                                        <a href="{{ route('brand.edit', ['id'=> $item->id ]) }}" title="Sửa">
                                            <i class="fa fa-pencil fa-fw"></i> Sửa
                                        </a> &nbsp; &nbsp; &nbsp;
                                          <a href="javascript:void(0);" class="btn-destroy" 
                                          data-href="{{ route( 'brand.destroy',  $item->id ) }}"
                                          data-toggle="modal" data-target="#confim">
                                          <i class="fa fa-trash-o fa-fw"></i> Xóa
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
               
            </div>
        </div>
    </div>
@stop