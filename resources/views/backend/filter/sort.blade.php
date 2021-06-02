@extends('backend.layouts.app') 
@section('controller','Filter')
@section('controller_route', route('list-category-filter'))
@section('action','Sắp xếp')
@section('content')
	<div class="content">
        <div class="clearfix"></div>
        @include('flash::message')
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-sm-12">
                    <div class="dd" id="nestable">
                        <ol class="dd-list">
                            @foreach ($data as $item)
                                <li class="dd-item" data-id="{{ $item->id }}">
                                    <div class="dd-handle">
                                        {{ $item->name }}
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
@stop

@section('scripts')
    <script>
        jQuery(document).ready(function($) {
            var updateOutput = function(e){
                var list   = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                    var param = window.JSON.stringify(list.nestable('serialize'));
                    $.ajax({
                        url: '{{ route('sort.filter.update') }}',
                        type: 'POST',
                        data: {
                            _token : $('#token').val(),
                            jsonMenu: param
                        },
                    }).done(function() {
                            $.toast({
                            text: "Cập nhật thành công !",
                            heading: 'Thông báo',
                            icon: 'success',
                            showHideTransition: 'fade',
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 1000, 
                            stack: 5, 
                            position: 'top-right', 
                            textAlign: 'left',
                            loader: true,
                            loaderBg: '#9ec600',
                        });
                    })
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            };
            $('#nestable').nestable({
                group: 1,
                maxDepth : 1
            }).on('change', updateOutput);
            updateOutput($('#nestable').data('output', $('#nestable-output')));
        });
    </script>
@endsection