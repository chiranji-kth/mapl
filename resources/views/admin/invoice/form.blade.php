@extends('admin.master')
@section('content')
@section('title')
@lang('add new invoice')
@endsection
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <ol class="breadcrumb">
                <li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                        @lang('dashboard.dashboard')</a></li>
                <li>Add New Invoice</li>
            </ol>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
            <a href="{{ route('customer.index') }}"
                class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i
                    class="fa fa-list-ul" aria-hidden="true"></i> View Invoice </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i>add new invoice</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        {{ Form::open(['route' => 'invoice.store', 'enctype' => 'multipart/form-data', 'class' => 'ajaxFormSubmit', 'id' => 'customerForm', 'data-redirect' => route('invoice.index')]) }}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="exampleInput">Branch<span class="validateRq">*</span></label>
                                    <div class="input-group col-md-12">
                                        <select input class="form-control required branch" required name="branch_id" id="branch_id">
                                            <option value="">Select Branch</option>
                                            <option value="1">MAPL</option>
                                            <option value="2">AASTHA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInput">Company Name<span class="validateRq">*</span></label>
                                    <div class="input-group col-md-12">
                                        <select class="form-control select2 required" name="company_id" id="company_id" required>
                                            <option value="">-- Select Company --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Month <span class="validateRq">*</span></label>
                                    <input type="text" name="month" id="month" class="form-control monthFieldOnly" placeholder="MM">
                                </div>

                                <div class="col-md-3">
                                    <label>Year <span class="validateRq">*</span></label>
                                    <input type="text" name="year" id="year" class="form-control yearField" placeholder="YYYY">
                                </div>
                                <div class="col-md-3">
                                    <label for="phone">Date<span class="validateRq">*</span></label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="date"
                                            placeholder="Date" name="qdate" type="date">
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div id="otherCompanyFields" class="row" style="display: none; margin-top: 15px;">
                                <div class="col-md-4">
                                    <label for="phone">Company name</label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="name"
                                            placeholder="Company Name" name="name" type="text">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="phone">Phone</label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="contact"
                                            placeholder="Phone" name="contact" type="text">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInput">Email</label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="email"
                                            placeholder="Email" name="email" type="email"
                                            value="{{ old('email') }}">
                                    </div>
                                </div>
                                <br />
                                <div class="col-md-4">
                                    <label for="exampleInput">GST No</label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="gst_no"
                                            placeholder="GST NO" name="gst_no" type="text"
                                            value="{{ old('gst_no') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInput">Pincode</label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="pincode"
                                            placeholder="Pincode" name="pincode" type="text"
                                            value="{{ old('pincode') }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="exampleInput">
                                        <Address></Address>
                                    </label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="address"
                                            placeholder="Address" name="address" type="text"
                                            value="{{ old('address') }}">
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInput">Deduction</label><br />
                                        <input type="checkbox" name="deduction[]" class="form-controle" value="PF"> PF
                                        <input type="checkbox" name="deduction[]" class="form-controle" value="ESI"> ESI
                                        <input type="checkbox" name="deduction[]" class="form-controle" value="CGST"> CGST
                                        <input type="checkbox" name="deduction[]" class="form-controle" value="SGST"> SGST
                                        <input type="checkbox" name="deduction[]" class="form-controle" value="IGST"> IGST
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInput">Labour Surcharge</label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="labour_surcharge"
                                            placeholder="Labour Surcharge" name="labour_surcharge" type="text"
                                            value="{{ old('labour_surcharge') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInput">Service Charge</label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="service_charge"
                                            placeholder="Service Charge" name="service_charge" type="text"
                                            value="{{ old('service_charge') }}">
                                    </div>
                                </div>
                            </div>
                            <br />

                            <!-- <div class="col-md-8">
                                    <label for="exampleInput">Address</label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="address"
                                            placeholder="Address" name="address" type="text"
                                            value="{{ old('address') }}">
                                    </div>
                                </div> -->
                            <br />

                            <hr>
                            <h4>Add Invoice Items</h4>
                            <div id="dynamic-rows-wrapper">
                                <div class="row dynamic-row" style="margin-bottom: 20px;">
                                    <div class="col-md-3">
                                        <div class="form-group app-label">
                                            <label class="text-muted">Particluar <span class="validateRq">*</span></label> <br>
                                            <div class="form-group">
                                                <select class="form-control select2" id="particluar" name="items[0][particluar]" required>
                                                    <option value="">-- Select Post --</option>
                                                    @foreach ($jobs as $job)
                                                    <option value="{{ $job->job_id }}">{{ $job->post }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger" id="particluar_err"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-muted">Gender <span class="validateRq">*</span></label> <br>
                                        <div class="form-group">
                                            <select class="form-control select2" id="gender" name="items[0][gender]" required>
                                                <option value="">-- Select Gender --</option>
                                                <option value="Male" {{ (Input::old("gender") == 'Male' ? "selected":"") }}>Male</option>
                                                <option value="Female" {{ (Input::old("gender") == 'Female' ? "selected":"") }}>Female</option>
                                            </select>
                                            <span class="text-danger" id="gender_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-muted">Month <span>*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[0][month]" class="form-control" placeholder="Month" min="1" max="12" required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-muted">Year <span>*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[0][year]" class="form-control" placeholder="Year" min="2020" required />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="text-muted">Working Hour <span class="validateRq">*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[0][working_hour]" class="form-control" placeholder="Working Hour" min="1" required />
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="text-muted">Days <span>*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[0][days]" class="form-control" placeholder="No Of Days" min="1" required />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="text-muted">QTY <span>*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[0][qty]" class="form-control" placeholder="QTY" min="1" required />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="text-muted">Rate <span>*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[0][rate]" class="form-control" placeholder="rate" min="0" required />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="text-muted">Payout <span>*</span></label> <br>
                                        <div class="form-group">
                                            <input type="text" name="items[0][payout]" class="form-control" placeholder="Payout" readonly required />
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="text-muted"></label> <br>
                                        <button type="button" class="btn btn-danger remove-row"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button type="button" id="add-row" class="btn btn-primary pb-5" style="margin-bottom: 50px;"><i class="fa fa-plus"></i> Add Row</button>
                            <br>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <button type="submit" class="btn btn-info btn_style"><i class="fa fa-check"></i>
                                            @lang('common.save')</button>
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
    @endsection

    @section('page_scripts')
    <script>
        $('#branch_id').on('change', function() {
            const branchId = $(this).val();
            const companySelect = $('#company_id');

            // Clear existing options
            companySelect.html('<option value="">-- Select Company --</option>');

            if (branchId) {
                $.ajax({
                    url: "{{ url('invoice/get-companies') }}/" + branchId,
                    type: 'GET',
                    success: function(data) {
                        if (data.length > 0) {
                            $.each(data, function(index, company) {
                                companySelect.append('<option value="' + company.company_id + '">' + company.company_name + '</option>');
                            });
                        } else {
                            companySelect.append('<option value="">No companies found</option>');
                        }

                        // Always add the "Other" option
                        companySelect.append('<option value="other">Other</option>');
                    },
                    error: function() {
                        alert('Error loading companies. Please try again.');
                    }
                });
            } else {
                // If no branch selected, reset company list
                companySelect.html('<option value="">-- Select Company --</option><option value="other">Other</option>');
            }
        });



        $('#company_id').on('change', function() {
            if ($(this).val() === 'other') {
                $('#otherCompanyFields').slideDown();
            } else {
                $('#otherCompanyFields').slideUp();
                $('#otherCompanyFields input').val(''); // clear all inputs
            }
        });

        // Function to get days in a month
        function getDaysInMonth(month, year) {
            return new Date(year, month, 0).getDate();
        }

        // Function to calculate payout
        function calculatePayout(row) {
            const days = parseFloat(row.find('input[name*="[days]"]').val()) || 0;
            const rate = parseFloat(row.find('input[name*="[rate]"]').val()) || 0;
            const qty = parseFloat(row.find('input[name*="[qty]"]').val()) || 1;
            const month = parseInt(row.find('input[name*="[month]"]').val()) || 0;
            const year = parseInt(row.find('input[name*="[year]"]').val()) || new Date().getFullYear();

            if (month > 0 && month <= 12) {
                // Get actual days in the selected month
                const daysInMonth = getDaysInMonth(month, year);

                // Calculate payout: (days * rate * qty) / actual_days_in_month
                const payout = (days * rate * qty) / daysInMonth;

                // Update payout field
                row.find('input[name*="[payout]"]').val(payout.toFixed(2));
            } else {
                // If month is not valid, clear payout
                row.find('input[name*="[payout]"]').val('');
            }
        }

        // Prevent negative values in number fields
        $(document).on('input', 'input[type="number"]', function() {
            if (this.value < 0) {
                this.value = '';
            }
        });

        // Add event listeners for payout calculation on existing row
        $(document).on('input', 'input[name*="[days]"], input[name*="[rate]"], input[name*="[qty]"], input[name*="[month]"], input[name*="[year]"]', function() {
            const row = $(this).closest('.dynamic-row');
            calculatePayout(row);
        });


        let rowCount = 1;

        $('#add-row').click(function() {
            let newRow = `
        <div class="row dynamic-row mt-2" style="margin-bottom: 20px;">
            <div class="col-md-3">
                <div class="form-group app-label">
                    <label class="text-muted">Particluar <span class="validateRq">*</span></label> <br>
                    <div class="form-group">
                        <select class="form-control select2" id="particluar" name="items[${rowCount}][particluar]" required>
                            <option value="">-- Select Post --</option>
                            @foreach ($jobs as $job)
                                <option value="{{ $job->job_id }}">{{ $job->post }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="particluar_err"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <label class="text-muted">Gender <span class="validateRq">*</span></label> <br>
                <div class="form-group">
                    <select class="form-control" id="gender" name="items[${rowCount}][gender]" required>
                        <option value="">-- Select Gender --</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <span class="text-danger" id="gender_err"></span>
                </div>
            </div>
            <div class="col-md-3">
                <label class="text-muted">Month <span>*</span></label> <br>
                <div class="form-group">
                    <input type="number" name="items[${rowCount}][month]" class="form-control" placeholder="Month" min="1" max="12" required />
                </div>
            </div>
            <div class="col-md-3">
                <label class="text-muted">Year <span>*</span></label> <br>
                <div class="form-group">
                    <input type="number" name="items[${rowCount}][year]" class="form-control" placeholder="Year" min="2020" required />
                </div>
            </div>
            
            <div class="col-md-2">
                <label class="text-muted">Working Hour <span class="validateRq">*</span></label> <br>
                <div class="form-group">
                    <input type="number" name="items[${rowCount}][working_hour]" class="form-control" placeholder="Working Hour" min="0" required />
                </div>
            </div>
            
            <div class="col-md-2">
                <label class="text-muted">Days <span>*</span></label> <br>
                <div class="form-group">
                    <input type="number" name="items[${rowCount}][days]" class="form-control" placeholder="No Of Days" min="1" required />
                </div>
            </div>
            <div class="col-md-2">
                <label class="text-muted">QTY <span>*</span></label> <br>
                <div class="form-group">
                    <input type="number" name="items[${rowCount}][qty]" class="form-control" placeholder="QTY" min="1" required />
                </div>
            </div>
            <div class="col-md-2">
                <label class="text-muted">Rate <span>*</span></label> <br>
                <div class="form-group">
                    <input type="number" name="items[${rowCount}][rate]" class="form-control" placeholder="rate" min="0" required />
                </div>
            </div>
            <div class="col-md-2">
                <label class="text-muted">Payout <span>*</span></label> <br>
                <div class="form-group">
                    <input type="number" name="items[${rowCount}][payout]" class="form-control" placeholder="Payout" readonly />
                </div>
            </div>
            <div class="col-md-1">
                <label class="text-muted"></label> <br>
                <button type="button" class="btn btn-danger remove-row"><i class="fa fa-trash"></i></button>
            </div>
        </div>`;
            $('#dynamic-rows-wrapper').append(newRow);
            rowCount++;
        });

        // Remove row
        $(document).on('click', '.remove-row', function() {
            $(this).closest('.dynamic-row').remove();
        });
    </script>

    <script>
        function loadAssignJobs() {
            const companyId = $('#company_id').val();
            const month = $('#month').val();
            const year = $('#year').val();

            if (companyId && month && year && companyId !== 'other') {
                $.ajax({
                    url: "{{ url('invoice/get-assign-jobs') }}",
                    data: {
                        company_id: companyId,
                        month: month,
                        year: year
                    },
                    type: 'GET',
                    success: function(data) {
                        if (data.length > 0) {
                            // Clear existing dynamic rows
                            $('#dynamic-rows-wrapper').html('');

                            // Populate rows from assign jobs
                            data.forEach(function(job, index) {
                                let row = `
                        <div class="row dynamic-row mt-2" style="margin-bottom: 20px;">
                            <div class="col-md-3">
                                <label>Particular</label>
                                <input type="text" name="items[${index}][particluar]" class="form-control" value="${job.post}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label>Gender</label>
                                <input type="text" name="items[${index}][gender]" class="form-control" value="${job.gender}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label>Month</label>
                                <input type="number" name="items[${index}][month]" class="form-control" value="${month}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label>Year</label>
                                <input type="number" name="items[${index}][year]" class="form-control" value="${year}" readonly>
                            </div>
                            <div class="col-md-2">
                                <label>Working Hour</label>                                    
                                <input type="number" name="items[${index}][working_hour]" class="form-control" value="${job.shift_timing}" min="1" readonly />
                            </div>
                            <div class="col-md-3">
                                <label>Days</label>
                                <input type="number" name="items[${index}][days]" class="form-control" value="${job.total_attendance_days}" readonly>
                            </div>
                            <div class="col-md-2">
                                <label>QTY</label>
                                <input type="number" name="items[${index}][qty]" class="form-control" value="${job.total_assign_jobs}" readonly>
                            </div>
                            <div class="col-md-2">
                                <label>Rate</label>
                                <input type="number" name="items[${index}][rate]" class="form-control" value="${job.rate}">
                            </div>
                            <div class="col-md-2">
                                <label>Payout</label>
                                <input type="text" name="items[${index}][payout]" class="form-control" readonly>
                            </div>
                        </div><hr>`;
                                $('#dynamic-rows-wrapper').append(row);

                                // Calculate initial payout
                                calculatePayout($('.dynamic-row').last());
                            });
                        } else {
                            $('#dynamic-rows-wrapper').html('<p>No assigned jobs found for selected company/month/year.</p>');
                        }
                    }
                });
            }
        }

        // Trigger AJAX when company, month, or year changes
        $('#company_id, #month, #year').on('change', loadAssignJobs);
    </script>
    @endsection