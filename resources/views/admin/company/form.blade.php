@extends('admin.master')
@section('content')
@section('title')
Create Company
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
                <li>Create Company</li>

            </ol>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <a href="{{ route('company.index') }}"
                class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i
                    class="fa fa-list-ul" aria-hidden="true"></i>
                View Company</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i> Create Company</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        {{ Form::open(['route' => 'company.store', 'enctype' => 'multipart/form-data', 'class' => 'ajaxFormSubmit', 'id' => 'employeeForm', 'data-redirect' => route('company.index')]) }}

                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Company Name<span
                                                class="validateRq">*</span></label>
                                        <input class="form-control required company_name validText" id="company_name" style="text-transform:uppercase"
                                            placeholder="Company Name" name="company_name" type="text"
                                            value="{{ old('company_name') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Industry Type<span
                                                class="validateRq">*</span></label>
                                        <input class="form-control required industry validText" id="industry" style="text-transform:uppercase"
                                            placeholder="Industry Type" name="industry" type="text"
                                            value="{{  old('industry') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInput">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input class="form-control"
                                            placeholder="@lang('employee.email')" name="email" type="email"
                                            value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInput">Phone<span
                                            class="validateRq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input class="form-control number phone required" id="phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10"
                                            placeholder="@lang('employee.phone')" name="phone" type="number"
                                            value="{{ old('phone') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="branch_id">Select Branch<span
                                                class="validateRq">*</span></label>
                                        <select name="branch_id" id="branch_id" class="form-control">
                                            <option value="">-- Select Branch --</option>
                                            @foreach($branches as $branch)
                                            <option value="{{ $branch->branch_id }}">{{ $branch->branch_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="exampleInput">Address<span
                                                class="validateRq">*</span></label>
                                        <input class="form-control address" id="address" style="text-transform:uppercase"
                                            placeholder="Address" name="address" type="text"
                                            value="{{  old('address') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">GST</label>
                                        <div class="input-group">
                                            <input class="form-control" placeholder="GST" name="gst" type="text" style="text-transform:uppercase"
                                                value="{{ old('gst') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Pan</label>
                                        <div class="input-group">
                                            <input class="form-control" placeholder="PAN" name="pan" type="text" style="text-transform:uppercase"
                                                value="{{ old('pan') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Owner Name<span
                                                class="validateRq">*</span></label>
                                        <div class="input-group">
                                            <input class="form-control owner_name validText" id="owner_name" placeholder="Owner Name" name="owner_name" type="text" style="text-transform:uppercase"
                                                value="{{ old('owner_name') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Owner Phone<span
                                                class="validateRq">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input class="form-control number owner_phone" id="owner_phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10"
                                                placeholder="Owner Phone" name="owner_phone" type="number"
                                                value="{{ old('owner_phone') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Contact Person Name <span
                                                class="validateRq">*</span></label>
                                        <input class="form-control contact_person_name validText" id="contact_person_name"
                                            placeholder="contact person name" name="contact_person_name" type="text" style="text-transform:uppercase"
                                            value="{{ old('contact_person_name') }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="exampleInput">Contact Person Phone<span
                                            class="validateRq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input class="form-control number contact_person_phone" id="contact_person_phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10"
                                            placeholder="contact person phone" name="contact_person_phone" type="number"
                                            value="{{ old('contact_person_phone') }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="exampleInput">Date of Service (Start Date)<span
                                            class="validateRq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input class="form-control date_of_service dateField" readonly
                                            id="date_of_service" placeholder="Date of Service"
                                            name="date_of_service" type="text"
                                            value="{{ old('date_of_service') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">State</label>
                                        <select name="state" id="state" class="form-control">
                                            <option value="">-- Select State --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">District</label>
                                        <select name="district" id="district" class="form-control">
                                            <option value="">-- Select District --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">City </label>
                                        <input class="form-control city validText" id="city" style="text-transform:uppercase"
                                            placeholder="City" name="city" type="text"
                                            value="{{ old('city') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInput">Site Address<span
                                                class="validateRq">*</span></label>
                                        <input class="form-control site_address" id="site_address"
                                            placeholder="site address" name="site_address" type="text" style="text-transform:uppercase"
                                            value="{{  old('site_address') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="exampleInput">Site Photo</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="	fa fa-picture-o"></i></span>
                                        <input class="form-control"
                                            accept="image/png, image/jpeg, image/gif,image/jpg" name="site_photo_1"
                                            type="file">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInput">Site Photo 2</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="	fa fa-picture-o"></i></span>
                                        <input class="form-control"
                                            accept="image/png, image/jpeg, image/gif,image/jpg" name="site_photo_2"
                                            type="file">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-actions" style="margin-top:2rem;">
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
    function alphaOnly(event) {
        var value = String.fromCharCode(event.which);
        var pattern = new RegExp(/[a-zA-Z ]/i);
        return pattern.test(value);
    }

    $('.validText').bind('keypress', alphaOnly);
</script>
<script>
    $(document).ready(function() {
        let stateDropdown = $("#state");
        let districtDropdown = $("#district");

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
@endsection