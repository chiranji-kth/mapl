@extends('admin.master')
@section('content')
@section('title')
    Career
@endsection
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <ol class="breadcrumb">
                <li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                        @lang('dashboard.dashboard')</a></li>
                <li>@yield('title')</li>
            </ol>
        </div>
        <!--<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">-->
        <!--    <a href="{{ route('jobPost.create') }}"-->
        <!--        class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"> <i-->
        <!--            class="fa fa-plus-circle" aria-hidden="true"></i> Career</a>-->
        <!--</div>-->
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-table fa-fw"></i> @yield('title')</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <i
                                    class="cr-icon glyphicon glyphicon-ok"></i>&nbsp;<strong>{{ session()->get('success') }}</strong>
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <i
                                    class="glyphicon glyphicon-remove"></i>&nbsp;<strong>{{ session()->get('error') }}</strong>
                            </div>
                        @endif
                        
                        <div class="data">
							@include('admin.recruitment.career.pagination')
						</div>
						
						
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_scripts')
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap.js"></script>
<script>
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
       
