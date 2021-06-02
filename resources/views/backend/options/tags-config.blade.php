@extends('backend.layouts.app')
@section('controller','Liên kết tìm kiếm nhiều nhất')
@section('action','Cập nhật')
@section('controller_route', route('backend.options.tags'))
@section('content')
	<div class="content">
		<div class="clearfix"></div>
       	@include('flash::message')
       	<form action="{{ route('backend.options.post.tags') }}" method="POST">
       		@csrf
			<div class="nav-tabs-custom">
			    <ul class="nav nav-tabs">
			        <li class="active">
			            <a href="#activity" data-toggle="tab" aria-expanded="true">Liên kết tìm kiếm nhiều nhất</a>
			        </li>
			    </ul>
			    <div class="tab-content">
					<div class="tab-pane active" id="activity">
						<div class="row">
							<div class="col-sm-12">
								<div class="repeater" id="repeater">
					                <table class="table table-bordered table-hover tags-link">
					                    <thead>
						                    <tr>
						                    	<th style="width: 30px;">STT</th>
						                    	<th width="">Tiêu đề</th>
						                    	<th>Liên kết</th>
						                    	<th style="width: 20px"></th>
						                    </tr>
					                	</thead>
					                    <tbody id="sortable">
											@if (!empty($content->tags))
												@foreach ($content->tags as $id => $value)
													<?php $index = $loop->index + 1;?>
													@include('backend.repeater.row-tags-link')
												@endforeach
											@endif
					                    </tbody>
					                </table>
					                <div class="text-right">
					                    <button class="btn btn-primary" 
							            	onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'tags-link', '.tags-link')">Thêm
							            </button>
					                </div>
					            </div>
							</div>
							<div class="col-sm-12">
								<button type="submit" class="btn btn-primary">Lưu lại</button>
							</div>
						</div>
					</div>
			    </div>
			</div>
		</form>
	</div>
@stop