@php
$front_setting = getFrontData();
@endphp
@extends('front.master')

@section('title')
{{ $front_setting->company_title }}
@endsection

@section('meta')
<meta name="og:title" content="{{ $front_setting->company_title }}" />
<meta name="og:image" content="{{ url('uploads/front/'.$front_setting->logo) }}" />
<meta name="og:url" content="{{ url('/') }}" />
<meta name="og:description" content="{{ $front_setting->about_us_description }}" />
<meta name="description" content="{{ $front_setting->about_us_description }}" />

@endsection

@section('content')

<div class="pagehding-sec maplform">
    <div class="pagehding-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-heading">
                    <h1>Job Search</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href>Job Search</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-12">

                @if($errors->any())
                <div class="alert alert-danger alert-dismissible mb-20" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    @foreach($errors->all() as $error)
                    <strong>{!! $error !!}</strong><br>
                    @endforeach
                </div>
                @endif

                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissable  mb-20">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="cr-icon glyphicon glyphicon-ok"></i>&nbsp;<strong>{{ session()->get('success') }}</strong>
                </div>
                @endif
                @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissable  mb-20">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>{{ session()->get('error') }}</strong>
                </div>
                @endif

                <!--<div class="job-detail text-center job-single border rounded p-4">-->
                <!--    <div class="job-single-img mb-2">-->
                <!--        <img src="images/featured-job/img-1.png" alt="feature" class="img-fluid mx-auto d-block">-->
                <!--    </div>-->
                <!--    <h4 class=""><a href="#" class="text-dark">Career</a></h4>-->
                <!--</div>-->

                <!--<div class="row">-->
                <!--    <div class="col-lg-12">-->
                <!--        <h5 class="text-dark mt-4">Job Description :</h5>-->
                <!--    </div>-->
                <!--</div>-->

                <!--<div class="row">-->
                <!--    <div class="col-lg-12">-->
                <!--        <div class="job-detail border rounded mt-2 p-4">-->
                <!--            <div class="job-detail-desc">-->

                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->

                <div class="row cForm">
                    <div class="col-lg-12">
                        <div class="condidateForm job-detail border rounded">
                            <div class="form-header">
                                <h2><i class="fa fa-briefcase"></i> Career Application Form</h2>
                                <p>Please fill out all required fields marked with <span class="required-asterisk">*</span></p>
                            </div>

                            <form id="post_career" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <!-- Personal Information Section -->
                                <div class="section-header">
                                    <i class="fa fa-user"></i> Personal Information
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label class="">Post Applied For <span>*</span></label> <br>
                                            <div class="form-group">
                                                <select class="form-control select2" id="post_applied" name="post_applied" required>
                                                    <option value="">-- Select Post --</option>
                                                    @foreach ($jobs as $job)
                                                    <option value="{{ $job->job_id }}">{{ $job->post }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger" id="post_applied_err"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label class="">Candidate Name <span>*</span></label>
                                            <input name="name" value="{{ old('name') }}" id="name" type="text" class="form-control validText" placeholder="Candidate Name" style="text-transform:uppercase" required>
                                            <span class="text-danger" id="name_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label class="">Father Name <span>*</span></label>
                                            <input name="father_name" value="{{ old('father_name') }}" id="father_name" type="text" class="form-control validText" placeholder="Father Name" style="text-transform:uppercase">
                                            <span class="text-danger" id="father_name_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label class="">Email Id </label>
                                            <input name="email" value="{{ old('email') }}" id="email" type="email" class="form-control" placeholder="Email Id.">
                                            <span class="text-danger" id="email_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label class="">Mobile No. <span>*</span></label>
                                            <input name="phone" value="{{ old('phone') }}" id="phone" type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" class="form-control" placeholder="Mobile No.">
                                            <span class="text-danger" id="phone_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label class="">Alter Phone No. </label>
                                            <input name="alter_phone" value="{{ old('alter_phone') }}" id="alter_phone" type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" class="form-control" placeholder="alter phone No.">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="for-group app-label h-65">
                                            <label class="">Gender <span>*</span></label> <br>
                                            <input name="gender" class="gender" value="MALE" type="radio" <?php if (Input::old('gender') == "MALE") {
                                                                                                                echo 'checked="checked"';
                                                                                                            } ?> required> MALE
                                            <input name="gender" class="gender" value="FEMALE" type="radio" <?php if (Input::old('gender') == "FEMALE") {
                                                                                                                echo 'checked="checked"';
                                                                                                            } ?> required> FEMALE
                                        </div>
                                        <span class="text-danger" id="gender_err"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group app-label h-65">
                                            <label class="">Marital Status <span>*</span></label> <br>
                                            <input name="marital_status" class="marital_status" value="MARRIED" type="radio" <?php if (Input::old('gender') == "MARRIED") {
                                                                                                                                    echo 'checked="checked"';
                                                                                                                                } ?> required> MARRIED
                                            <input name="marital_status" class="marital_status" value="UNMARRIED" type="radio" <?php if (Input::old('gender') == "UNMARRIED") {
                                                                                                                                    echo 'checked="checked"';
                                                                                                                                } ?> required> UNMARRIED

                                        </div>
                                        <span class="text-danger" id="marital_status_err"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label class="">Date Of Birth <span>*</span></label>
                                            <input name="dob" value="{{ old('dob') }}" id="dob" type="text" class="form-control dateField" placeholder="DD/MM/YY">

                                            <!--<input type="date" id="dob" class="cdate form-control" name="dob" placeholder="Select From Date"> -->
                                            <span class="text-danger" id="dob_err"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label class="">Aadhar No. <span>*</span></label>
                                            <input name="aadhar" value="{{ old('aadhar') }}" id="aadhar" type="text" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12" class="form-control" placeholder="Aadhar No.">
                                            <span class="text-danger" id="aadhar_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group app-label">
                                            <label class="">Height (in FEET)</label>
                                            <input name="height" value="{{ old('height') }}" type="number" class="form-control" placeholder="Height" style="text-transform:uppercase">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group app-label">
                                            <label class="">Weight (in KG)</label>
                                            <input name="weight" value="{{ old('weight') }}" type="number" class="form-control" placeholder="Weight" style="text-transform:uppercase">
                                        </div>
                                    </div>
                                </div>

                                <!-- Professional Information Section -->
                                <div class="section-header">
                                    <i class="fa fa-graduation-cap"></i> Professional Information
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label class="">Highest Qualification <span>*</span></label>
                                            <input name="highest_qualification" value="{{ old('highest_qualification') }}" id="highest_qualification" type="text" class="form-control" placeholder="Highest Qualification" required style="text-transform:uppercase">
                                            <span class="text-danger" id="highest_qualification_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group app-label h-65">
                                            <label class="">Employment Status <span>*</span></label> <br>
                                            <input name="employment_status" class="employment_status" value="FRESHER" type="radio" <?php if (Input::old('employment_status') == "FRESHER") {
                                                                                                                                        echo 'checked="checked"';
                                                                                                                                    } ?> required> FRESHER
                                            <input name="employment_status" class="employment_status" value="WORKING" type="radio" <?php if (Input::old('employment_status') == "WORKING") {
                                                                                                                                        echo 'checked="checked"';
                                                                                                                                    } ?> required> WORKING

                                        </div>
                                        <span class="text-danger" id="employment_status_err"></span>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group app-label">
                                            <label class="">Duty Time Preference <span>*</span></label> <br>
                                            <input name="time_preference" class="time_preference" value="DAY" type="radio" <?php if (Input::old('time_preference') == "DAY") {
                                                                                                                                echo 'checked="checked"';
                                                                                                                            } ?> required> DAY
                                            <input name="time_preference" class="time_preference" value="NIGHT" type="radio" <?php if (Input::old('time_preference') == "NIGHT") {
                                                                                                                                    echo 'checked="checked"';
                                                                                                                                } ?> required> NIGHT
                                            <input name="time_preference" class="time_preference" value="BOTH" type="radio" <?php if (Input::old('time_preference') == "BOTH") {
                                                                                                                                echo 'checked="checked"';
                                                                                                                            } ?> required> BOTH

                                        </div>
                                        <span class="text-danger" id="time_preference_err"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label class="">Experience</label>
                                            <input name="experience" value="{{ old('experience') }}" type="text" class="form-control" placeholder="Experience" style="text-transform:uppercase">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label class="">Salary Expectations </label>
                                            <input name="salary_expectations" value="{{ old('salary_expectations') }}" id="salary_expectations" type="text" class="form-control" placeholder="salary_exp">
                                            <span class="text-danger" id="salary_expectations_err"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Address Information Section -->
                                <div class="section-header">
                                    <i class="fa fa-home"></i> Address Information
                                </div>
                                <div class="address-section">
                                    <h4><i class="fa fa-map-marker"></i> Permanent Address</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group app-label">
                                                <label class="">Address <span>*</span></label>
                                                <input type="text" name="p_address" value="{{ old('p_address') }}" id="p_address" class="form-control" placeholder="Address" style="text-transform:uppercase" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group app-label">
                                                <label class="">State <span>*</span></label>
                                                <select name="p_state" id="p_state" class="form-control" required>
                                                    <option value="">-- Select State --</option>
                                                </select>
                                                <span class="text-danger" id="p_district_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group app-label">
                                                <label class="">District <span>*</span></label>
                                                <select name="p_district" id="p_district" class="form-control" required>
                                                    <option value="">-- Select District --</option>
                                                </select>
                                                <span class="text-danger" id="p_district_err"></span>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group app-label">
                                                <label class="">City <span>*</span></label>
                                                <input name="p_city" value="{{ old('p_city') }}" type="text" id="p_city" class="form-control validText" placeholder="city" required style="text-transform:uppercase">
                                                <span class="text-danger" id="p_city_err"></span>
                                            </div>
                                        </div>
                                        <!--<div class="col-md-4">-->
                                        <!--    <div class="form-group app-label">-->
                                        <!--        <label>State </label>-->
                                        <!--        <input name="p_state" value="{{ old('p_state') }}" type="text" id="p_state" class="form-control validText" placeholder="Enter state" required style="text-transform:uppercase">-->
                                        <!--        <span class="text-danger" id="p_state_err"></span>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                    </div>

                                    <div class="same-address-check">
                                        <label>
                                            <input type="checkbox" name="same" value="Y" id="same_address_check">
                                            <strong>Current Address Same as Permanent Address</strong>
                                        </label>
                                    </div>

                                    <div class="address-section">
                                        <h4><i class="fa fa-map-marker"></i> Current Address</h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group app-label">
                                                    <label class="">Address <span>*</span></label>
                                                    <input type="text" name="c_address" value="{{ old('c_address') }}" id="c_address" class="form-control" placeholder="Address" style="text-transform:uppercase" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group app-label">
                                                    <label>State <span>*</span></label>
                                                    <select name="c_state" id="c_state" class="form-control" required>
                                                        <option value="">-- Select State --</option>
                                                    </select>
                                                    <span class="text-danger" id="c_state_err"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group app-label">
                                                    <label class="">District <span>*</span></label>
                                                    <select name="c_district" id="c_district" class="form-control" required>
                                                        <option value="">-- Select District --</option>
                                                    </select>
                                                    <span class="text-danger" id="c_district_err"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group app-label">
                                                    <label class="">City <span>*</span></label>
                                                    <input name="c_city" value="{{ old('c_city') }}" type="text" id="c_city" class="form-control validText" placeholder="city" required style="text-transform:uppercase">
                                                    <span class="text-danger" id="c_city_err"></span>
                                                </div>
                                            </div>

                                            <!-- Additional Information Section -->
                                            <div class="section-header">
                                                <i class="fa fa-info-circle"></i> Additional Information
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group app-label">
                                                        <label class="">Other Post Applied</label>
                                                        <input name="other_post_applied" value="{{ old('other_post_applied') }}" type="text" class="form-control" placeholder="Other Post Applied" style="text-transform:uppercase">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group app-label">
                                                        <label class="">Remarks (If Any)</label>
                                                        <input name="remarks" value="{{ old('remarks') }}" type="text" class="form-control" placeholder="Remarks (If Any)" style="text-transform:uppercase">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group app-label">
                                                        <label class="">Form Filled By <span>*</span></label>
                                                        <input name="filled_by" value="{{ old('filled_by') }}" type="text" id="filled_by" class="form-control validText" placeholder="Form Filled By" required style="text-transform:uppercase">
                                                        <span class="text-danger" id="filled_by_err"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group app-label">
                                                        <label class="">Reference By</label>
                                                        <input name="referd_by" value="{{ old('referd_by') }}" id="referd_by" type="text" class="form-control validText" placeholder="Reference By" style="text-transform:uppercase">
                                                        <span class="text-danger" id="referd_by_err"></span>
                                                    </div>
                                                </div>
                                                <!--<div class="col-lg-6">-->
                                                <!--    <div class="form-group picture">-->
                                                <!--        <label class="">Candidate Photo</label>-->
                                                <!--        <input name="picture" type="file" class="form-control" placeholder="Candidate Photo">-->
                                                <!--    </div>-->
                                                <!--</div>-->



                                                <div class="col-lg-12">
                                                    <!--<div class="form-group app-label">-->
                                                    <!--    <label>Cover Letter :</label>-->
                                                    <!--    <textarea name="cover_letter" id="addition-information" rows="4" class="form-control resume" placeholder="Write Something About You">{{ old('name') }}</textarea>-->
                                                    <!--</div>-->
                                                    <div class="single-input-fieldsbtn">
                                                        <button type="button" id="submitcareer" class="btn-submit">
                                                            <i class="fa fa-paper-plane"></i> Submit Application
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                            </form>
                        </div>
                        <div id="signup_message"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('custom-section')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script>
    $(function() {
        $("#dob").datepicker({
            dateFormat: "dd/mm/y",
            changeMonth: true,
            changeYear: true,
            yearRange: "1980:2025"
        });
    });
</script>

<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        $('#post_applied').on('input', function() {
            checkpost_applied();
        });
        $('#name').on('input', function() {
            checkname();
        });
        $('#father_name').on('input', function() {
            checkfathername();
        });
        // $('#email').on('input', function() {
        //     checkemail();
        // });
        $('#phone').on('input', function() {
            checkphone();
        });

        $('#dob').on('input', function() {
            checkdob();
        });
        $('#aadhar').on('input', function() {
            checkaadhar();
        });
        $('#highest_qualification').on('input', function() {
            checkhighest_qualification();
        });
        // $('#salary_expectations').on('input', function() {
        //     checksalary_expectations();
        // });
        $('#filled_by').on('input', function() {
            checkfilled_by();
        });
        $('.time_preference').click('input:radio', function() {
            checktime_preference();
        });
        $('.employment_status').click('input:radio', function() {
            checkemployment_status();
        });
        $('.gender').click('input:radio', function() {
            checkgender();
        });
        $('.marital_status').click('input:radio', function() {
            checkmarital_status();
        });

        $('#p_address').on('input', checkPermanentAddress);
        $('#p_state').on('change', checkPermanentState);
        $('#p_district').on('change', checkPermanentDistrict);
        $('#p_city').on('input', checkPermanentCity);

        $('#c_address').on('input', checkCurrentAddress);
        $('#c_state').on('change', checkCurrentState);
        $('#c_district').on('change', checkCurrentDistrict);
        $('#c_city').on('input', checkCurrentCity);


        $('#submitcareer').click(function() {

            if (!checkpost_applied() && !checkname() && !checkfathername() && !checkphone() && !checkdob() && !checkaadhar() && !checkhighest_qualification() && !checkfilled_by() && !checktime_preference() && !checkemployment_status() && !checkgender() && !checkmarital_status() && !checkPermanentAddress() &&
                !checkPermanentState() && !checkPermanentDistrict() && !checkPermanentCity() && !checkCurrentAddress() && !checkCurrentState() && !checkCurrentDistrict() && !checkCurrentCity()) {
                $("#signup_message").html(`<div class="alert alert-danger alert-dismissable  mb-20"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Please fill all required field</strong></div>`);
            } else if (!checkpost_applied() || !checkname() || !checkfathername() || !checkphone() || !checkdob() || !checkaadhar() || !checkhighest_qualification() || !checkfilled_by() || !checktime_preference() || !checkemployment_status() || !checkgender() || !checkmarital_status() || !checkPermanentAddress() ||
                !checkPermanentState() || !checkPermanentDistrict() || !checkPermanentCity() || !checkCurrentAddress() || !checkCurrentState() || !checkCurrentDistrict() || !checkCurrentCity()) {
                $("#signup_message").html(`<div class="alert alert-danger alert-dismissable  mb-20"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Please fill all required field</strong></div>`);
            } else {
                $("#signup_message").html("");
                var form = $('#post_career')[0];
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "{{ route('career.application') }}",
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    // beforeSend: function() {
                    //     $('#registerbtn').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                    //     $('#registerbtn').attr("disabled", true);
                    // },
                    success: function(result) {
                        var obj = JSON.parse(result);
                        if (obj.status == true) {
                            $('#signup_message').html(obj.message);
                            setTimeout(function() {
                                $('#post_career').trigger("reset");
                                $('#submitcareer').html('Apply');
                            }, 1000);
                        } else {
                            $('#signup_message').html(obj.message);
                            if (obj.error) {

                                $.each(response.errors, function(key, val) {
                                    $("#" + key + "_err").html(val[0]);
                                })


                            }
                        }
                    }
                });
            }

        });

    });


    function checkpost_applied() {
        var post_applied = $('#post_applied').val();
        if (post_applied == "") {
            $('#post_applied_err').html('Post is Required');
            return false;
        } else {
            $('#post_applied_err').html("");
            return true;
        }
    }

    function checkname() {
        var pattern = /^[A-Za-z ]+$/;
        var user = $('#name').val();
        var validuser = pattern.test(user);
        // if ($('#firstname').val().length < 5) {
        //     $('#firstname_err').html('First Name length is too short');
        //     return false;
        // }
        if (user == "") {
            $('#name_err').html('Name is required');
            return false;
        } else if (!validuser) {
            $('#name_err').html('Name should be Alphabet only');
            return false;
        } else {
            $('#name_err').html('');
            return true;
        }
    }

    function checkfathername() {
        var pattern = /^[A-Za-z ]+$/;
        var user = $('#father_name').val();
        var validuser = pattern.test(user);
        if (user == "") {
            $('#father_name_err').html('Father name is required');
            return false;
        } else if (!validuser) {
            $('#father_name_err').html('Father Name should be Alphabet only');
            return false;
        } else {
            $('#father_name_err').html('');
            return true;
        }
    }

    // function checkemail() {
    //     var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    //     var email = $('#email').val();
    //     var validemail = pattern1.test(email);
    //     if (email == "") {
    //         $('#email_err').html('Email is required field');
    //         return false;
    //     } else if (!validemail) {
    //         $('#email_err').html('invalid email');
    //         return false;
    //     } else {
    //         $('#email_err').html('');
    //         return true;
    //     }
    // }

    function checkphone() {
        if (!$.isNumeric($("#phone").val())) {
            $("#phone_err").html("only number is allowed");
            return false;
        } else if ($("#phone").val().length != 10) {
            $("#phone_err").html("10 digit required");
            return false;
        } else {
            $("#phone_err").html("");
            return true;
        }
    }


    function checkdob() {
        var dob = $('#dob').val();
        if (dob == "") {
            $('#dob_err').html('DOB is Required');
            return false;
        } else {
            $('#dob_err').html("");
            return true;
        }
    }

    function checktime_preference() {
        if (!$(".time_preference").is(':checked')) {
            $('#time_preference_err').html('Time Preference is Required');
            return false;
        } else {
            $('#time_preference_err').html("");
            return true;
        }
    }

    function checkemployment_status() {
        if (!$(".employment_status").is(':checked')) {
            $('#employment_status_err').html('Employment Status is Required');
            return false;
        } else {
            $('#employment_status_err').html("");
            return true;
        }
    }

    function checkgender() {
        if (!$(".gender").is(':checked')) {
            $('#gender_err').html('Gender is Required');
            return false;
        } else {
            $('#gender_err').html("");
            return true;
        }
    }

    function checkmarital_status() {
        if (!$(".marital_status").is(':checked')) {
            $('#marital_status_err').html('Marital Status is Required');
            return false;
        } else {
            $('#marital_status_err').html("");
            return true;
        }
    }

    function checkaadhar() {
        if (!$.isNumeric($("#aadhar").val())) {
            $("#aadhar_err").html("only number is allowed");
            return false;
        } else if ($("#aadhar").val().length != 12) {
            $("#aadhar_err").html("12 digit required");
            return false;
        } else {
            $("#aadhar_err").html("");
            return true;
        }
    }

    function checkhighest_qualification() {
        var highest_qualification = $('#highest_qualification').val();
        if (highest_qualification == "") {
            $('#highest_qualification_err').html('highest Qualification can not be empty');
            return false;
        } else {
            $('#highest_qualification_err').html("");
            return true;
        }
    }
    // function checksalary_expectations() {
    //     var salary_expectations = $('#salary_expectations').val();
    //     if (salary_expectations == "") {
    //         $('#salary_expectations_err').html('This field can not be empty');
    //         return false;
    //     }  else {
    //         $('#salary_expectations_err').html("");
    //         return true;
    //     }
    // }
    function checkfilled_by() {
        var filled_by = $('#filled_by').val();
        if (filled_by == "") {
            $('#filled_by_err').html('This field can not be empty');
            return false;
        } else {
            $('#filled_by_err').html("");
            return true;
        }
    }

    function checkPermanentAddress() {
        var address = $('#p_address').val();
        if (address == "") {
            $('#p_address').next('.text-danger').remove();
            $('#p_address').after('<span class="text-danger">Address is required</span>');
            return false;
        } else {
            $('#p_address').next('.text-danger').remove();
            return true;
        }
    }

    function checkPermanentState() {
        var state = $('#p_state').val();
        if (state == "") {
            $('#p_state_err').html('State is required');
            return false;
        } else {
            $('#p_state_err').html('');
            return true;
        }
    }

    function checkPermanentDistrict() {
        var district = $('#p_district').val();
        if (district == "") {
            $('#p_district_err').html('District is required');
            return false;
        } else {
            $('#p_district_err').html('');
            return true;
        }
    }

    function checkPermanentCity() {
        var city = $('#p_city').val();
        if (city == "") {
            $('#p_city_err').html('City is required');
            return false;
        } else {
            $('#p_city_err').html('');
            return true;
        }
    }

    function checkCurrentAddress() {
        var address = $('#c_address').val();
        if (address == "") {
            $('#c_address').next('.text-danger').remove();
            $('#c_address').after('<span class="text-danger">Address is required</span>');
            return false;
        } else {
            $('#c_address').next('.text-danger').remove();
            return true;
        }
    }

    function checkCurrentState() {
        var state = $('#c_state').val();
        if (state == "") {
            $('#c_state_err').html('State is required');
            return false;
        } else {
            $('#c_state_err').html('');
            return true;
        }
    }

    function checkCurrentDistrict() {
        var district = $('#c_district').val();
        if (district == "") {
            $('#c_district_err').html('District is required');
            return false;
        } else {
            $('#c_district_err').html('');
            return true;
        }
    }

    function checkCurrentCity() {
        var city = $('#c_city').val();
        if (city == "") {
            $('#c_city_err').html('City is required');
            return false;
        } else {
            $('#c_city_err').html('');
            return true;
        }
    }
</script>

<script>
    function alphaOnly(event) {
        var value = String.fromCharCode(event.which);
        var pattern = new RegExp(/[a-zA-Z ]/i);
        return pattern.test(value);
    }

    $('.validText').bind('keypress', alphaOnly);
</script>

<script>
    document.forms[0].reset();

    $(document).ready(function() {

        function copyPermanentToCurrent() {
            // Copy address
            $('#c_address').val($('#p_address').val());

            // Copy city
            $('#c_city').val($('#p_city').val());

            // Copy state
            let permanentState = $('#p_state').val();
            $('#c_state').val(permanentState).trigger('change');

            // After districts load, set district
            let permanentDistrict = $('#p_district').val();

            // Wait until #c_district options are populated
            let interval = setInterval(function() {
                if ($('#c_district option').length > 1) {
                    $('#c_district').val(permanentDistrict);
                    clearInterval(interval);
                }
            }, 50);
        }

        // Checkbox toggle
        $('#same_address_check').change(function() {
            if ($(this).is(':checked')) {
                copyPermanentToCurrent();
            } else {
                $('#c_address').val('');
                $('#c_city').val('');
                $('#c_state').val('').trigger('change');
                $('#c_district').val('');
            }
        });

        // Update current address if permanent fields change
        $('#p_address, #p_city, #p_state, #p_district').on('input change', function() {
            if ($('#same_address_check').is(':checked')) {
                copyPermanentToCurrent();
            }
        });

    });
</script>

<script>
    $('.cdate').datepicker({
        dateFormat: 'yy/mm/dd'
    })
</script>

<script>
    $(document).ready(function() {
        let stateDropdown = $("#p_state");
        let districtDropdown = $("#p_district");

        // Load all states
        $.get("{{ route('get-states') }}", function(states) {
            states.forEach(state => {
                stateDropdown.append(`<option value="${state.state_id}">${state.name}</option>`);
            });

            // Preselect old state if exists
            @if(old('p_state'))
            stateDropdown.val("{{ old('p_state') }}").trigger('change');
            @endif
        });

        // Load districts on state change
        stateDropdown.on("change", function() {
            let stateId = $(this).val();
            districtDropdown.empty().append('<option value="">-- Select District --</option>');
            console.log(stateId);
            if (stateId) {
                $.get("{{ url('/get-districts') }}/" + stateId, function(districts) {
                    districts.forEach(district => {
                        districtDropdown.append(`<option value="${district.dist_id}">${district.name}</option>`);
                    });

                    // Preselect old district if exists
                    @if(old('p_district'))
                    districtDropdown.val("{{ old('p_district') }}");
                    @endif
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        let stateDropdown = $("#c_state");
        let districtDropdown = $("#c_district");

        // Load all states
        $.get("{{ route('get-states') }}", function(states) {
            states.forEach(state => {
                stateDropdown.append(`<option value="${state.state_id}">${state.name}</option>`);
            });

            // Preselect old state if exists
            @if(old('p_state'))
            stateDropdown.val("{{ old('p_state') }}").trigger('change');
            @endif
        });

        // Load districts on state change
        stateDropdown.on("change", function() {
            let stateId = $(this).val();
            districtDropdown.empty().append('<option value="">-- Select District --</option>');

            if (stateId) {
                $.get("{{ url('/get-districts') }}/" + stateId, function(districts) {
                    districts.forEach(district => {
                        districtDropdown.append(`<option value="${district.dist_id}">${district.name}</option>`);
                    });

                    // Preselect old district if exists
                    @if(old('p_district'))
                    districtDropdown.val("{{ old('p_district') }}");
                    @endif
                });
            }
        });
    });
</script>

@endsection