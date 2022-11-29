@extends('admin.layouts.app')
@section('title')
Role Management
@endsection
@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-12">
		<h2><i class="fa fa-users" aria-hidden="true"></i> Role Management</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('admin.dashboard') }}">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">
				<span class="label label-success float-right all_backgroud">Role Table</span>
			</li>
		</ol>
	</div>
</div>
<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox">
				<div class="ibox-content">
					<div class="col-md-12">
						<div class="table-responsive">
							{!! $html->table(['class' => 'table table-striped table-bordered dt-responsive nowrap'], true) !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title pull-left" id="exampleModalLabel1">Role Management Detail</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body testdata"><h3>Modal Body</h3></div>
		</div>
	</div>
</div>
@endsection
@section('styles')
<link href="{{ asset('assets/admin/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('scripts')
<script src="{{ asset('assets/admin/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('assets/admin/datatable/dataTables.bootstrap4.min.js') }}"></script>
{!! $html->scripts() !!}
<script>
$(document).on("click","a.Showrole",function(e){
	var row = $(this);
	var id = $(this).attr('data-id');
	$.ajax({
		url:"{{ route('admin.role.show') }}",
		type: 'get',
		data: {id: id},
		success:function(msg){
			$('.testdata').html(msg);
			$('#basicModal').modal('show');
		},error:function(){
			swal("Error!", 'Error in Record Not Show', "error"); 
		}
	});
});
</script>
@endsection
