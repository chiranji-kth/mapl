@extends('admin.master')
@section('content')
@section('title')
Edit Assign Job
@endsection
<style>
    .appendBtnColor {
        color: #fff;
        font-weight: 700;
    }
</style>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <ol class="breadcrumb">
                <li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                        @lang('dashboard.dashboard')</a></li>
                <li>@yield('title')</li>

            </ol>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <a href="{{ route('assignJob.index') }}"
                class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i
                    class="fa fa-list-ul" aria-hidden="true"></i> View Assign Job</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i> @yield('title')</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">

                        {{ Form::open(['route' => ['assignJob.update', $editModeData->job_id], 'method'=>'PUT', 'enctype' => 'multipart/form-data', 'class' => ' ajaxFormSubmit', 'id' => 'promotionForm', 'data-redirect' => route('assignJob.index')]) }}


                        <div class="form-body">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Employee<span
                                                class="validateRq">*</span></label>
                                        <select name="emp_id" class="form-control employeeId required select2">
                                            <option value="">--- select employee ---</option>
                                            @foreach ($employeeList as $value)
                                            <option value="{{ $value->emp_id }}"
                                                @if ($value->emp_id == $editModeData->emp_id) {{ 'selected' }} @endif>
                                                {{ $value->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Company<span
                                                class="validateRq">*</span></label>
                                        <select name="company_id" class="form-control required select2">
                                            <option value="">--- select company ---</option>
                                            @foreach ($companyList as $value)
                                            <option value="{{ $value->company_id }}"
                                                @if ($value->company_id == $editModeData->company_id) {{ 'selected' }} @endif>
                                                {{ $value->company_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- Gender (readonly) -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('employee.gender')<span class="validateRq">*</span></label>
                                        <input type="text" name="gender" class="form-control gender" readonly
                                            value="{{ $editModeData->gender }}">
                                    </div>
                                </div>

                                <!-- Job Role (readonly) -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Job Role<span class="validateRq">*</span></label>
                                        <input type="text" name="job_role" class="form-control job_role" readonly
                                            value="{{ $editModeData->job_post }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Shift<span
                                                class="validateRq">*</span></label>
                                        <select name="shift" class="form-control shift select2">
                                            <option value="">--- @lang('common.please_select') ---</option>
                                            <option value="DAY" @if ('DAY'==$editModeData->shift) {{ 'selected' }} @endif>
                                                DAY</option>
                                            <option value="NIGHT" @if ('NIGHT'==$editModeData->shift) {{ 'selected' }} @endif>
                                                NIGHT</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="shift_timing">Shift Timing (hrs.)<span class="validateRq">*</span></label>
                                        {!! Form::text(
                                        'shift_timing',
                                        old('shift_timing', $editModeData->shift_timing),
                                        [
                                        'class' => 'form-control required shift_timing',
                                        'id' => 'shift_timing',
                                        'placeholder' => 'Shift Timing',
                                        ]
                                        ) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="salary">Salary (per month)<span class="validateRq">*</span></label>
                                        {!! Form::text(
                                        'salary',
                                        old('salary', $editModeData->salary),
                                        [
                                        'class' => 'form-control required salary',
                                        'id' => 'salary',
                                        'placeholder' => 'Salary',
                                        ]
                                        ) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Wages (Per day)<span
                                                class="validateRq">*</span></label>
                                        <input class="form-control required user_name" id="perday_wages"
                                            placeholder="Wages" name="perday_wages" type="text"
                                            value="{{ $editModeData->perday_wages }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">From<span
                                                class="validateRq">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input class="form-control required dateField" id="from_date"
                                                placeholder="From Date" name="from_date" type="text"
                                                value="{{ $editModeData->from_date }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">To</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input class="form-control dateField" id="to_date"
                                                placeholder="To Date" name="to_date" type="text"
                                                value="{{ $editModeData->to_date }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Deduction</label><br />
                                        <input type="checkbox" name="deduction[]" class="form-controle" value="PF" <?= in_array('PF', explode(',',  $editModeData->deduction)) ? 'checked' : '' ?>> PF
                                        <input type="checkbox" name="deduction[]" class="form-controle" value="ESI" <?= in_array('ESI', explode(',',  $editModeData->deduction)) ? 'checked' : '' ?>> ESI
                                        <input type="checkbox" name="deduction[]" class="form-controle" value="TDS" <?= in_array('TDS', explode(',',  $editModeData->deduction)) ? 'checked' : '' ?>> TDS
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Status<span
                                                class="validateRq">*</span></label>
                                        <select name="status" class="form-control status select2">
                                            <option value="">--- @lang('common.please_select') ---</option>
                                            <option value="1" @if ('1'==$editModeData->status) {{ 'selected' }} @endif>
                                                ACTIVE</option>
                                            <option value="0" @if ('0'==$editModeData->status) {{ 'selected' }} @endif>
                                                INACTIVE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-info btn_style"><i
                                                class="fa fa-check"></i> @lang('common.save')</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('page_scripts')
<script>
    $(document).ready(function() {

        // Function to populate gender and job_role
        function populateEmployeeDetails(empId) {
            if (empId) {
                $.ajax({
                    url: "{{ route('assignJob.getEmployeeDetails', '') }}/" + empId,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            $('input[name="gender"]').val(response.data.gender);
                            $('input[name="job_role"]').val(response.data.job_role);
                        } else {
                            $('input[name="gender"]').val('');
                            $('input[name="job_role"]').val('');
                        }
                    },
                    error: function() {
                        $('input[name="gender"]').val('');
                        $('input[name="job_role"]').val('');
                    }
                });
            } else {
                $('input[name="gender"]').val('');
                $('input[name="job_role"]').val('');
            }
        }

        // On page load: populate fields if an employee is already selected
        var initialEmpId = $('.employeeId').val();
        populateEmployeeDetails(initialEmpId);

        // On change: update fields dynamically
        $('.employeeId').on('change', function() {
            var empId = $(this).val();
            populateEmployeeDetails(empId);
        });

    });
</script>
@endsection