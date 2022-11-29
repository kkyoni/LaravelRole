@extends('admin.layouts.app')
@section('title')
Role Management - Edit
@endsection
@section('mainContent')
@if(Session::has('message'))
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-{{ Session::has('alert-type') }}">{!! Session::get('message') !!}</div>
	</div>
</div>
@endif
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-12">
		<h2><i class="fa fa-users" aria-hidden="true"></i> Edit Role From</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('admin.dashboard') }}">Home</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ route('admin.role.index') }}">Role Table</a>
			</li>
			<li class="breadcrumb-item active">
				<span class="label label-success float-right all_backgroud">Edit Role</span>
			</li>
		</ol>
	</div>
</div>
<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox">
				<div class="ibox-content">
					{!! Form::open(array('route' => ['admin.role.update'],'files' => 'true','id' => 'roleAddForm')) !!}
					@include('admin.pages.role.form')
					<div class="hr-line-dashed"></div>
					<div class="col-sm-6">
						<div class="form-group row">
							<div class="col-sm-8 col-sm-offset-8">
								<button class="btn btn-primary btn-sm" type="submit">Save changes</button>
								<a href="{{route('admin.role.index')}}" class="btn btn-danger btn-sm">Cancel</a>
							</div>
						</div>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('styles')
<link href="{{ asset('assets/admin/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
@endsection
@section('scripts')
<script src="{{ asset('assets/admin/js/plugins/iCheck/icheck.min.js')}}"></script>
<script>
$(document).ready(function () {
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
	});
});
</script>
@endsection