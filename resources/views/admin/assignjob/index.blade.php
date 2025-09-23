@extends('admin.master')
@section('content')
@section('title')
Assign Job
@endsection
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		   <ol class="breadcrumb">
				<li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i> @lang('dashboard.dashboard')</a></li>
				<li>@yield('title')</li>
			</ol>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="{{ route('assignJob.create') }}"  class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Assign Job</a>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-info">
				<div class="panel-heading"><i class="mdi mdi-table fa-fw"></i> Assign Job</div>
				<div class="panel-wrapper collapse in" aria-expanded="true">
					<div class="panel-body">
						<form target="_blank" action="{{ route('employee.print') }}">
						@if(session()->has('success'))
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<i class="cr-icon glyphicon glyphicon-ok"></i>&nbsp;<strong>{{ session()->get('success') }}</strong>
							</div>
						@endif
						@if(session()->has('error'))
							<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<i class="glyphicon glyphicon-remove"></i>&nbsp;<strong>{{ session()->get('error') }}</strong>
							</div>
						@endif
						<!--<div class="row">-->
						<!--	<div class="col-md-3">-->
						<!--		<div class="form-group">-->
						<!--			<label for="exampleInput">@lang('employee.name')</label>-->
						<!--			<div id="custom-search-input">-->
						<!--				<div class="input-group col-md-12">-->
						<!--					<input type="text" class="search-query form-control employee_name"-->
						<!--					 placeholder="@lang('employee.search_by_employee_name')" onkeyup="getData(1)" name="employee_name"/>-->
						<!--					<span class="input-group-btn">-->
						<!--						<button class="btn btn-danger" type="button">-->
						<!--							<span class=" glyphicon glyphicon-search"></span>-->
						<!--						</button>-->
      <!--                          			</span>-->
						<!--				</div>-->
						<!--			</div>-->
						<!--		</div>-->
						<!--	</div>-->

						<!--</div>-->
							<br>
						<div class="data">
							@include('admin.assignjob.pagination')
						</div>

						 <!--   <div class="row">-->
							<!--<div class="col-md-offset-8 col-md-3 text-right float-left">-->
							<!--	<div class="form-group">-->
							<!--		<button class="btn btn-primary" style="margin-right: 10px;">Print Results</button>-->
							<!--	</div>-->
							<!--</div>-->
							<!--</div>-->
                       </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#status-change">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="status-change" tabindex="-1" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="p-5 text-center mt-5">
            <div class="text-xl mt-5"><h2>Are You Sure?</h2></div>
            <div class="text-slate-500 mt-2" style="padding-bottom: 20px;" id="active"><h5>You want change Status!</h5></div>
        </div>
        <form action="{{ route('assignJob.changestatus') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" id="id" name="id">
            <input type="hidden" id="status" name="status">
            <center>
                <button type="submit" class="btn btn-primary" id="btnActive"></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload();">Cancel</button>
            </center>
      </form>
    </div>
  </div>
  </div>
</div>

@endsection

@section('page_scripts')
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
    function changeStatus($orderId, $status) {
        $("#id").val($orderId);
        $("#status").val($status);
        $("#btnActive").html('Yes, '  + $status  + ' it!');
        document.getElementById('active').innerHTML = "You want to " + $status;
    }
$(document).ready(function () {
    
      $('#example').DataTable(
            { 
                language: {
        searchPlaceholder: "Search records",
        search: "",
      },
      pageLength: 25
    });
    
});
</script>
@endsection
