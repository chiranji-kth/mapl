@extends('admin.master')
@section('content')
@section('title')
Edit Career
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
                <li>Edit Career</li>

            </ol>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <a href="{{ route('careerJob.index') }}"
                class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i
                    class="fa fa-list-ul" aria-hidden="true"></i>
                View Career</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i> Edit Career</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        {{ Form::open(['route' => ['careerJob.update', $empModeData->career_applicant_id], 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal ajaxFormSubmit', 'id' => 'employeeForm', 'data-redirect' => route('careerJob.index')]) }}

                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Name<span
                                                class="validateRq">*</span></label>
                                        <input class="form-control required name validText" id="name" style="text-transform:uppercase"
                                            placeholder="@lang('employee.name')" name="name" type="text"
                                            value="{{ $empModeData->name }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Father Name<span
                                                class="validateRq">*</span></label>
                                        <input class="form-control father_name validText" id="father_name" style="text-transform:uppercase"
                                            placeholder="@lang('employee.father_name')" name="father_name" type="text"
                                            value="{{ $empModeData->father_name }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="exampleInput">@lang('employee.date_of_birth')<span
                                            class="validateRq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input class="form-control dob dateField"
                                            id="dob" placeholder="@lang('employee.dob')" name="dob"
                                            type="text" value="{{ $empModeData->dob ? \Carbon\Carbon::parse($empModeData->dob)->format('d/m/Y') : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInput">@lang('employee.email')</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input class="form-control email" id="email"
                                            placeholder="@lang('employee.email')" name="email" type="email"
                                            value="{{ $empModeData->email }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="exampleInput">@lang('employee.phone')<span
                                            class="validateRq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input class="form-control number phone" id="phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10"
                                            placeholder="@lang('employee.phone')" name="phone" type="number"
                                            value="{{ $empModeData->phone }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInput">Alter Phone</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input class="form-control number alter_phone" id="alter_phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10"
                                            placeholder="Alter Phone" name="alter_phone" type="number"
                                            value="{{ $empModeData->alter_phone }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">@lang('employee.gender')<span
                                                class="validateRq">*</span></label>
                                        <select name="gender" class="form-control gender select2">
                                            <option value="">--- @lang('common.please_select') ---</option>
                                            <option value="male"
                                                @if ('MALE'==$empModeData->gender) {{ 'selected' }} @endif>
                                                MALE</option>
                                            <option value="female"
                                                @if ('FEMALE'==$empModeData->gender) {{ 'selected' }} @endif>
                                                FEMALE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Marital Status<span
                                                class="validateRq">*</span></label>
                                        <select name="marital_status" class="form-control marital_status select2">
                                            <option value="">--- marital status ---</option>
                                            <option value="MARRIED"
                                                @if ('MARRIED'==$empModeData->marital_status) {{ 'selected' }} @endif>
                                                MARRIED</option>
                                            <option value="UNMARRIED"
                                                @if ('UNMARRIED'==$empModeData->marital_status) {{ 'selected' }} @endif>
                                                UNMARRIED</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-2">
                                    <label for="exampleInput">Aadhar<span
                                            class="validateRq">*</span></label>
                                    <div class="input-group">
                                        <input class="form-control number aadhar" id="aadhar" placeholder="Aadhar" name="aadhar" type="number"
                                            value="{{ $empModeData->aadhar }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Highest Qualification<span
                                                class="validateRq">*</span></label>
                                        <input class="form-control highest_qualification" id="highest_qualification" style="text-transform:uppercase"
                                            placeholder="Highest Qualification" name="highest_qualification" type="text"
                                            value="{{ $empModeData->highest_qualification }}">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInput">Weight (in KG)</label>
                                        <input class="form-control weight" id="weight" style="text-transform:uppercase"
                                            placeholder="Weight" name="weight" type="text"
                                            value="{{ $empModeData->weight }}">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInput">Height (in FEET)</label>
                                        <input class="form-control height" id="height" style="text-transform:uppercase"
                                            placeholder="height" name="height" type="text"
                                            value="{{ $empModeData->height }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Employment Status<span
                                                class="validateRq">*</span></label>
                                        <select name="employment_status" class="form-control employment_status select2">
                                            <option value="">--- @lang('common.please_select') ---</option>
                                            <option value="FRESHER"
                                                @if ('FRESHER'==$empModeData->employment_status) {{ 'selected' }} @endif>
                                                FRESHER</option>
                                            <option value="WORKING"
                                                @if ('WORKING'==$empModeData->employment_status) {{ 'selected' }} @endif>
                                                WORKING</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <h5 class="text-danger">Parmanent Address</h5>
                            <hr />
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="p_state">State<span class="validateRq">*</span></label>
                                        <select name="p_state" id="p_state" class="form-control select2" required>
                                            <option value="">-- Select State --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="p_district">District<span class="validateRq">*</span></label>
                                        <select name="p_district" id="p_district" class="form-control select2" required>
                                            <option value="">-- Select District --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>City</label>
                                    <input type="text" id="p_city" name="p_city" class="form-control" value="{{ $empModeData->p_city }}">
                                </div>
                                <div class="col-md-12">
                                    <label>Address</label>
                                    <input type="text" id="p_address" name="p_address" class="form-control" value="{{ $empModeData->p_address }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <h5 class="text-danger">Current Address</h5>
                                </div>
                                <div class="col-md-9 text-success">
                                    <label>
                                        <input type="checkbox" id="sameAddress" name="same_address" value="1" @if($empModeData->same_address)
                                        checked
                                        @endif>
                                        Current Address Same as Permanent
                                    </label>
                                </div>
                            </div>

                            <hr />
                            <div class="row">
                                <div class="col-md-4">
                                    <label>State<span class="validateRq">*</span></label>
                                    <select name="c_state" id="c_state" class="form-control select2" required>
                                        <option value="">-- Select State --</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>District<span class="validateRq">*</span></label>
                                    <select name="c_district" id="c_district" class="form-control select2" required>
                                        <option value="">-- Select District --</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>City</label>
                                    <input type="text" id="c_city" name="c_city" class="form-control" value="{{ $empModeData->c_city }}">
                                </div>
                                <div class="col-md-12">
                                    <label>Address</label>
                                    <input type="text" id="c_address" name="c_address" class="form-control" value="{{ $empModeData->c_address }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Post Applied For<span
                                                class="validateRq">*</span></label>
                                        <select name="post_applied" class="form-control post_applied select2">
                                            <option value="">--- @lang('common.please_select') ---</option>
                                            @foreach ($jobs as $job)
                                            <option value="{{ $job->job_id }}" @if ($job->job_id == $empModeData->post_applied) selected @endif>{{ $job->post }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Salary Expectations </label>
                                        <input class="form-control salary_expectations" id="salary_expectations"
                                            placeholder="Salary Expectations" name="salary_expectations" type="text"
                                            value="{{ $empModeData->salary_expectations }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Other Post Applied</label>
                                        <input class="form-control other_post_applied" id="other_post_applied" style="text-transform:uppercase"
                                            placeholder="Other Post Applied" name="other_post_applied" type="text"
                                            value="{{ $empModeData->other_post_applied }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Duty Time Preference </label>
                                        <select name="time_preference" class="form-control time_preference select2">
                                            <option value="">--- @lang('common.please_select') ---</option>
                                            <option value="DAY"
                                                @if ('DAY'==$empModeData->time_preference) {{ 'selected' }} @endif>
                                                DAY</option>
                                            <option value="NIGHT"
                                                @if ('NIGHT'==$empModeData->time_preference) {{ 'selected' }} @endif>
                                                NIGHT</option>
                                            <option value="BOTH"
                                                @if ('BOTH'==$empModeData->time_preference) {{ 'selected' }} @endif>
                                                BOTH</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Remarks (If Any)</label>
                                        <input class="form-control remarks" id="other_post_applied" style="text-transform:uppercase"
                                            placeholder="Remarks" name="remarks" type="text"
                                            value="{{ $empModeData->remarks }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Form Filled By</label>
                                        <input class="form-control filled_by validText" id="filled_by" style="text-transform:uppercase"
                                            placeholder="Form Filled By" name="filled_by" type="text"
                                            value="{{ $empModeData->filled_by }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Reference By</label>
                                        <input class="form-control referd_by validText" id="referd_by" style="text-transform:uppercase"
                                            placeholder="Reference By" name="referd_by" type="text"
                                            value="{{ $empModeData->referd_by }}">
                                    </div>
                                </div>
                                <!--<div class="col-md-3">-->
                                <!--    <label for="exampleInput">@lang('employee.date_of_joining')<span-->
                                <!--            class="validateRq">*</span></label>-->
                                <!--    <div class="input-group">-->
                                <!--        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>-->
                                <!--        <input class="form-control date_of_joining dateField" readonly-->
                                <!--            id="date_of_joining" placeholder="@lang('employee.date_of_joining')"-->
                                <!--            name="date_of_joining" type="text"-->
                                <!--            value="{{ old('date_of_joining') }}">-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>

                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <button type="submit" class="btn btn-info btn_style"><i class="fa fa-check"></i>
                                        @lang('common.save')</button>
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

@endsection
@section('page_scripts')
<script>
    $(function() {
        $(".dob").datepicker({
            dateFormat: "dd/mm/y",
            changeMonth: true,
            changeYear: true,
            yearRange: "1980:2025"
        });
    });
</script>
<script>
    $('input').attr('autocomplete', 'off');

    function alphaOnly(event) {
        var value = String.fromCharCode(event.which);
        var pattern = new RegExp(/[a-zA-Z ]/i);
        return pattern.test(value);
    }

    $('.validText').bind('keypress', alphaOnly);

    $('input[name=same]').click(function() {
        // alert('Using the same address');  
        if ($("input[name=same]:checked").is(':checked')) {
            $('#c_state').val($('#p_state').val());
            $('#c_district').val($('#p_district').val());
            $('#c_city').val($('#p_city').val());
            $('#c_address').val($('#p_address').val());
        } else {
            $('#c_state').val('');
            $('#c_district').val('');
            $('#c_city').val('');
            $('#c_address').val('');
        }
    });
</script>

<script>
    $(document).ready(function() {

        // ================== PERMANENT ADDRESS ===================
        let p_state = $("#p_state");
        let p_district = $("#p_district");
        let oldPState = "{{ $empModeData->p_state }}";
        let oldPDistrict = "{{ $empModeData->p_district }}";

        // Load all states for permanent
        $.get("{{ route('get-states') }}", function(states) {
            p_state.empty().append('<option value="">-- Select State --</option>');
            states.forEach(state => {
                p_state.append(`<option value="${state.state_id}">${state.name}</option>`);
            });

            if (oldPState) {
                p_state.val(oldPState);
                p_state.val(oldPState).trigger('change');
                // Now load districts after state is set
                $.get("{{ url('/get-districts') }}/" + oldPState, function(districts) {
                    p_district.empty().append('<option value="">-- Select District --</option>');
                    districts.forEach(d => {
                        p_district.append(`<option value="${d.dist_id}">${d.name}</option>`);
                    });
                    if (oldPDistrict) {
                        p_district.val(oldPDistrict);
                        p_district.val(oldPDistrict).trigger('change');
                    }
                });
            }
        });

        // When permanent state changes, load districts
        p_state.on('change', function() {
            let stateId = $(this).val();
            p_district.empty().append('<option value="">-- Select District --</option>');
            if (stateId) {
                $.get("{{ url('/get-districts') }}/" + stateId, function(districts) {
                    districts.forEach(d => {
                        p_district.append(`<option value="${d.dist_id}">${d.name}</option>`);
                    });
                    if (oldPDistrict && stateId == oldPState) {
                        p_district.val(oldPDistrict);
                    }
                });
            }
        });

        // ================== CURRENT ADDRESS ===================
        let c_state = $("#c_state");
        let c_district = $("#c_district");
        let oldCState = "{{ $empModeData->c_state }}";
        let oldCDistrict = "{{ $empModeData->c_district }}";

        $.get("{{ route('get-states') }}", function(states) {
            c_state.empty().append('<option value="">-- Select State --</option>');
            states.forEach(state => {
                c_state.append(`<option value="${state.state_id}">${state.name}</option>`);
            });

            if (oldCState) {
                c_state.val(oldCState);
                c_state.val(oldCState).trigger('change');

                $.get("{{ url('/get-districts') }}/" + oldCState, function(districts) {
                    c_district.empty().append('<option value="">-- Select District --</option>');
                    districts.forEach(d => {
                        c_district.append(`<option value="${d.dist_id}">${d.name}</option>`);
                    });
                    if (oldCDistrict) {
                        c_district.val(oldCDistrict).trigger('change'); // ✅ only this
                    }
                });
            }
        });

        c_state.on('change', function() {
            let stateId = $(this).val();
            c_district.empty().append('<option value="">-- Select District --</option>');
            if (stateId) {
                $.get("{{ url('/get-districts') }}/" + stateId, function(districts) {
                    districts.forEach(d => {
                        c_district.append(`<option value="${d.dist_id}">${d.name}</option>`);
                    });
                    if (oldCDistrict && stateId == oldCState) {
                        c_district.val(oldCDistrict);
                    }
                });
            }
        });

        function loadDistrictsForState(stateId, selectedDistrictId = null, callback = null) {
            if (!stateId) return;

            $.get("{{ url('/get-districts') }}/" + stateId, function(districts) {
                let $cDistrict = $('#c_district');
                $cDistrict.empty().append('<option value="">-- Select District --</option>');
                districts.forEach(d => {
                    $cDistrict.append(`<option value="${d.dist_id}">${d.name}</option>`);
                });

                if (selectedDistrictId) {
                    $cDistrict.val(selectedDistrictId).trigger('change');
                }

                if (callback) callback(); // ✅ call callback when done
            });
        }

        // ================== SAME ADDRESS CHECK ===================
        $('#sameAddress').on('change', function() {
            if ($(this).is(':checked')) {
                // Copy city & address
                $('#c_city').val($('#p_city').val());
                $('#c_address').val($('#p_address').val());

                // Copy state and then load districts correctly
                let pStateVal = $('#p_state').val();
                let pDistrictVal = $('#p_district').val();

                $('#c_state').val(pStateVal).trigger('change');

                // ✅ Call district load after state change
                loadDistrictsForState(pStateVal, pDistrictVal);
            } else {
                // Reset current address fields
                $('#c_state').val('').trigger('change');
                $('#c_district').empty().append('<option value="">-- Select District --</option>');
                $('#c_city').val('');
                $('#c_address').val('');
            }
        });

    });
</script>
@endsection