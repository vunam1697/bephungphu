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
                    <div class="btnAdd" style="display: none;">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn xóa không ?')">
                            <i class="fa fa-trash-o"></i> Xóa
                        </button>
                    </div>
                    @include('backend.layouts.components.table')
                </form>

                <p style="color: red">Nhấn vào trạng thái để duyệt nhanh bình luận.</p>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <?php $url = route($module['module'].'.index') ?>
    @include('backend.layouts.components.table-js-config', ['route'=> $url ])
    <script>
        jQuery(document).ready(function($) {
            $('body').on('click', '.activeq', function(event) {
                id = $(this).data('id');
                var btn = $(this);
                $.get('{{ route('comments.active') }}?id='+id, function(data) {
                    btn.html(data);
                });
            });
        });
    </script>
@endsection