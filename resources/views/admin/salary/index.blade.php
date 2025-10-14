@extends('admin.master')
@section('content')
@section('title')
Salary
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

            <a href="{{ route('payroll.export', request()->all()) }}" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">
                <i class="fa fa-file-text-o"></i> Export Salary
            </a>
            <!--	<a href="{{route('generateSalarySheet.bulk')}}"-->
            <!--class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">-->
            <!--<i class="fa fa-list-ul" aria-hidden="true"></i>  @lang('salary_sheet.Generate Bulk Salary Sheet')</a>-->
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-table fa-fw"></i> @yield('title')</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="cr-icon glyphicon glyphicon-ok"></i>&nbsp;<strong>{{ session()->get('success') }}</strong>
                        </div>
                        @endif
                        @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>{{ session()->get('error') }}</strong>
                        </div>
                        @endif
                        <!--<div class="row">-->
                        <!--	<div class="col-md-2"></div>-->

                        <!--	<div class="col-md-3">-->
                        <!--		<div class="form-group">-->
                        <!--			<label for="exampleInput">@lang('common.month')</label>-->
                        <!--			{!! Form::text('month','', $attributes = array('class'=>'form-control monthField','id'=>'month','placeholder'=>__('common.month'),'readonly'=>'readonly')) !!}-->
                        <!--		</div>-->
                        <!--	</div>-->
                        <!--	<div class="col-md-3">-->
                        <!--		<div class="form-group">-->
                        <!--			<label for="exampleInput">@lang('common.status')</label>-->
                        <!--			{{ Form::select('status', array(''=>'---- '. __('common.please_select') .' ----','0' => __('salary_sheet.unpaid'), '1' => __('salary_sheet.paid')), '', array('class' => 'form-control status select2 required')) }}-->
                        <!--		</div>-->
                        <!--	</div>-->

                        <!--</div>-->
                        <br>
                        <div class="data">
                            <form method="GET" action="{{ route('attendance.index') }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Company</label>
                                        <select name="company_id" class="form-control select2">
                                            @foreach($companyList as $id => $name)
                                            <option value="{{ $id }}" {{ request('company_id') == $id ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="exampleInput">@lang('common.month')<span class="validateRq">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input class="form-control monthFieldOnly required" id="month" placeholder="Month" name="month" type="text" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleInput">Year<span class="validateRq">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input class="form-control yearField required" id="year" placeholder="Year" name="year" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-3 d-flex align-items-end" style="margin-top: 25px;">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </form>

                            <br /><br />
                            @include('admin.salary.pagination')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('page_scripts')
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap.js"></script>
<script>
    $(document).ready(function() {

        $('#example').DataTable({
            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                'colvis'
            ],

            language: {
                searchPlaceholder: "Search records",
                search: "",
            },
            pageLength: 25
        });

    });
</script>

@endsection