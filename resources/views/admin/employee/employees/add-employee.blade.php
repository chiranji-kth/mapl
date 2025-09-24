@extends('admin.master')
@section('content')
@section('title')
Create Employee
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
                <li>Create Employee</li>

            </ol>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <a href="{{ route('employees.index') }}"
                class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i
                    class="fa fa-list-ul" aria-hidden="true"></i>
                @lang('employee.view_employee')</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i> Create Employee</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        {{ Form::open(['route' => 'employees.store', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal ajaxFormSubmit', 'id' => 'employeeForm', 'data-redirect' => route('employees.index')]) }}
                        <input name="applicant_id" type="hidden" value="{{ $empModeData->career_applicant_id }}">
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
                                        <input class="form-control dob dateField" readonly
                                            id="dob" placeholder="@lang('employee.dob')" name="dob"
                                            type="text" value="{{ $empModeData->dob }}">
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
                                        <input class="form-control number phone" id="alter_phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10"
                                            placeholder="alter phone" name="alter_phone" type="number"
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
                                            class="validateRq">*</span></lable>
                                        <div class="input-group">
                                            <input class="form-control number aadhar" id="phone" placeholder="Aadhar" name="aadhar" type="number"
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
                                            placeholder="Weight" name="weight" type="number"
                                            value="{{ $empModeData->weight }}">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInput">Height (in FEET)</label>
                                        <input class="form-control height" id="height" style="text-transform:uppercase"
                                            placeholder="height" name="height" type="number"
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
                                        <label for="exampleInput">State</label>
                                        <select name="p_state" id="p_state" class="form-control" required>
                                            <option value="">-- Select State --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInput">District</label>
                                        <select name="p_district" id="p_district" class="form-control" required>
                                            <option value="">-- Select District --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInput">City</label>
                                        <input class="form-control p_city validText" id="p_city" style="text-transform:uppercase"
                                            placeholder="City" name="p_city" type="text"
                                            value="{{ $empModeData->p_city }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInput">Address</label>
                                        <input class="form-control p_address" id="p_address" style="text-transform:uppercase"
                                            placeholder="address" name="p_address" type="text"
                                            value="{{ $empModeData->p_address }}">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5 class="text-danger">Current Address</h5>
                                </div>
                                <div class="col-md-9 text-success"><input type="checkbox" name="same" value="Y" /> Current Address Same as Parmanent </div>
                            </div>

                            <hr />
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label>State <span class="required-asterisk">*</span></label>
                                        <select name="c_state" id="c_state" class="form-control" required>
                                            <option value="">-- Select State --</option>
                                        </select>
                                        <span class="text-danger" id="c_state_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInput">District</label>
                                        <select name="c_district" id="c_district" class="form-control" required>
                                            <option value="">-- Select District --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInput">City</label>
                                        <input class="form-control c_city validText" id="c_city" style="text-transform:uppercase"
                                            placeholder="City" name="c_city" type="text"
                                            value="{{ $empModeData->c_city }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInput">Address</label>
                                        <input class="form-control c_address" id="c_address" style="text-transform:uppercase"
                                            placeholder="address" name="c_address" type="text"
                                            value="{{ $empModeData->c_address }}">
                                    </div>
                                </div>

                            </div>
                            <h5 class="text-danger">Bank Details</h5>
                            <hr />
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Bank<span
                                                class="validateRq">*</span></label>
                                        <input class="form-control bank required validText" id="bank" style="text-transform:uppercase"
                                            placeholder="Bank Name" name="bank" type="text"
                                            value="{{ $empModeData->bank }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Ac/No<span
                                                class="validateRq">*</span></label>
                                        <input class="form-control acc_no" id="acc_no"
                                            placeholder="Account no" name="acc_no" type="number" value="{{ $empModeData->acc_no }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">IFSC Code<span
                                                class="validateRq">*</span></label>
                                        <input class="form-control ifc_code" id="ifc_code" style="text-transform:uppercase"
                                            placeholder="IFSC Code" name="ifc_code" type="text"
                                            value="{{ $empModeData->ifc_code }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Branch<span
                                                class="validateRq">*</span></label>
                                        <input class="form-control branch validText" id="branch" style="text-transform:uppercase"
                                            placeholder="Branch" name="branch" type="text"
                                            value="{{ $empModeData->branch }}">
                                    </div>
                                </div>
                            </div>
                            <h5 class="text-danger">Previous Esic Details</h5>
                            <hr />
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">ESIC No</label>
                                        <input class="form-control esic_no" id="esic_no" style="text-transform:uppercase"
                                            placeholder="ESIC No" name="esic_no" type="text"
                                            value="{{ $empModeData->esic_no }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">UAN NO</label>
                                        <input class="form-control uan_no" id="uan_no" style="text-transform:uppercase"
                                            placeholder="UAN NO" name="uan_no" type="text"
                                            value="{{ $empModeData->uan_no }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">NOMINEE NAME</label>
                                        <input class="form-control nominee" id="nominee" style="text-transform:uppercase"
                                            placeholder="NOMINEE NAME" name="nominee" type="text"
                                            value="{{ $empModeData->nominee }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">BANK DETAILS OF ESIC/PF</label>
                                        <input class="form-control esic_pf" id="esic_pf" style="text-transform:uppercase"
                                            placeholder="BANK DETAILS OF ESIC/PF" name="esic_pf" type="text"
                                            value="{{ $empModeData->esic_pf }}">
                                    </div>
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
                                        <label for="exampleInput">Salary <span
                                                class="validateRq">*</span></label>
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
                                        <label for="exampleInput">Duty Time Preference <span
                                                class="validateRq">*</span></label>
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
                                        <label for="exampleInput">Form Filled By <span
                                                class="validateRq">*</span></label>
                                        <input class="form-control filled_by validText" id="filled_by" readonly style="text-transform:uppercase"
                                            placeholder="Form Filled By" name="filled_by" type="text"
                                            value="{{ $empModeData->filled_by }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Reference By</label>
                                        <input class="form-control referd_by validText" id="referd_by" readonly style="text-transform:uppercase"
                                            placeholder="Reference By" name="referd_by" type="text"
                                            value="{{ $empModeData->referd_by }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInput">@lang('employee.date_of_joining')<span
                                            class="validateRq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input class="form-control date_of_joining dateField" readonly
                                            id="date_of_joining" placeholder="@lang('employee.date_of_joining')"
                                            name="date_of_joining" type="text"
                                            value="{{ old('date_of_joining') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="exampleInput">@lang('employee.photo')</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="	fa fa-picture-o"></i></span>
                                        <input class="form-control photo" id="photo"
                                            accept="image/png, image/jpeg, image/gif,image/jpg" name="photo"
                                            type="file">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInput">@lang('employee.kyc')<span
                                                class="validateRq">*</span></label>
                                        <select name="kyc_doc" id="kyc_doc" class="form-control kyc_doc required select2">
                                            <option value="">--- @lang('common.please_select') ---</option>
                                            <option value="AADHAR CARD" @if ('AADHAR CARD'==$empModeData->kyc_doc) {{ 'selected' }} @endif > AADHAR CARD</option>
                                            <option value="VOTER ID" @if ('VOTER ID'==$empModeData->kyc_doc) {{ 'selected' }} @endif >VOTER ID</option>
                                            <option value="PAN CARD" @if ('PAN CARD'==$empModeData->kyc_doc) {{ 'selected' }} @endif >PAN CARD</option>
                                            <option value="BANK PASSBOOK" @if ('BANK PASSBOOK'==$empModeData->kyc_doc) {{ 'selected' }} @endif >BANK PASSBOOK</option>
                                            <option value="DRIVER LICENSE" @if ('DRIVER LICENSE'==$empModeData->kyc_doc) {{ 'selected' }} @endif >DRIVER LICENSE</option>
                                            <option value="OTHER" @if ('OTHER'==$empModeData->kyc_doc) {{ 'selected' }} @endif >OTHER</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInput">@lang('employee.kyc_doc')</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="	fa fa-file-o"></i></span>
                                        <input class="form-control kyc" id="kyc_file"
                                            accept="application/pdf" name="kyc_file"
                                            type="file">
                                    </div>
                                </div>
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
    $('.dob').datepicker({
        dateFormat: 'dd/mm/yy'
    })
</script>

<script>
    $(document).ready(function() {
        let stateDropdown = $("#p_state");
        let districtDropdown = $("#p_district");
        let oldState = "{{ $empModeData->p_state }}"; // ID of old state
        let oldDistrict = "{{ $empModeData->p_district }}"; // ID of old district

        // Load all states
        $.get("{{ route('get-states') }}", function(states) {
            stateDropdown.empty().append('<option value="">-- Select State --</option>');
            states.forEach(state => {
                stateDropdown.append(`<option value="${state.state_id}">${state.name}</option>`);
            });

            // Preselect old state
            stateDropdown.val(oldState);

            // Load districts for old state
            if (oldState) {
                $.get("{{ url('/get-districts') }}/" + oldState, function(districts) {
                    districtDropdown.empty().append('<option value="">-- Select District --</option>');
                    districts.forEach(d => {
                        districtDropdown.append(`<option value="${d.dist_id}">${d.name}</option>`);
                    });

                    // Preselect old district
                    if (oldDistrict) districtDropdown.val(oldDistrict);
                });
            }
        });

        // When state changes, load districts dynamically
        stateDropdown.on('change', function() {
            let stateId = $(this).val();
            districtDropdown.empty().append('<option value="">-- Select District --</option>');
            if (stateId) {
                $.get("{{ url('/get-districts') }}/" + stateId, function(districts) {
                    districts.forEach(d => {
                        districtDropdown.append(`<option value="${d.dist_id}">${d.name}</option>`);
                    });
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        let stateDropdown = $("#c_state");
        let districtDropdown = $("#c_district");
        let oldState = "{{ $empModeData->c_state }}";
        let oldDistrict = "{{ $empModeData->c_district }}";

        // Load all states
        $.get("{{ route('get-states') }}", function(states) {
            states.forEach(state => {
                stateDropdown.append(`<option value="${state.state_id}">${state.name}</option>`);
            });

            // Preselect state
            stateDropdown.val(oldState).trigger('change');
        });

        // Load districts when state changes
        stateDropdown.on("change", function() {
            let stateId = $(this).val();
            districtDropdown.empty().append('<option value="">-- Select District --</option>');
            if (stateId) {
                $.get("{{ url('/get-districts') }}/" + stateId, function(districts) {
                    districts.forEach(district => {
                        districtDropdown.append(`<option value="${district.id}">${district.name}</option>`);
                    });

                    // Only after districts are loaded, select old district
                    if (oldDistrict) {
                        districtDropdown.val(oldDistrict);
                    }
                });
            }
        });
    });
</script>


@endsection