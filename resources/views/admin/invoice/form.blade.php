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
            <a href="{{ route('invoice.index') }}"
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
                                    <label for="exampleInput">Company<span class="validateRq">*</span></label>
                                    <div class="input-group col-md-12">
                                        <select input class="form-control required company select2" required name="company_id" id="company_id">
                                            <option value="">Select Company</option>
                                            @foreach($companys as $company)
                                            <option value="<?= $company->company_id ?>"><?= $company->company_name ?></option>
                                            @endforeach
                                            <option value="other">
                                                Other
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="exampleInput">Branch<span class="validateRq">*</span></label>
                                    <div class="input-group col-md-12" id="branch">

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>Month <span class="validateRq">*</span></label>
                                    <input type="text" name="month" id="month" class="form-control monthFieldOnly" placeholder="MM" onkeydown="return false">
                                </div>

                                <div class="col-md-2">
                                    <label>Year <span class="validateRq">*</span></label>
                                    <input type="text" name="year" id="year" class="form-control yearField" placeholder="YYYY" onkeydown="return false">
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

                                </div>
                            </div>
                            <br>
                            <button type="button" id="add-row" class="btn btn-primary pb-5" style="margin-bottom: 50px; display: none"><i class="fa fa-plus"></i> Add Row</button>
                            <br><br>


                            <!-- Totals Section -->
                            <!-- Totals Section -->
                            <div class="row">
                                <div class="col-md-8">&nbsp;</div>
                                <div class="col-md-4">
                                    <div class="panel panel-default" style="padding: 15px;">
                                        <h4><strong>Totals</strong></h4>
                                        <div class="row">
                                            <div class="col-md-6"><strong>Sub Total:</strong></div>
                                            <div class="col-md-6 text-right"><span id="sub-total">0.00</span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">PF (13%):</div>
                                            <div class="col-md-6 text-right"><span id="pf-total">0.00</span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">ESI (3.25%):</div>
                                            <div class="col-md-6 text-right"><span id="esi-total">0.00</span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">Labour Surcharge:</div>
                                            <div class="col-md-6 text-right"><span id="labour-charge">0.00</span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">Service Charge (%):</div>
                                            <div class="col-md-6 text-right"><span id="service-charge">0.00</span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6"><strong>Total:</strong></div>
                                            <div class="col-md-6 text-right"><span id="total">0.00</span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">CGST (9%):</div>
                                            <div class="col-md-6 text-right"><span id="cgst-total">0.00</span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">SGST (9%):</div>
                                            <div class="col-md-6 text-right"><span id="sgst-total">0.00</span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">IGST (18%):</div>
                                            <div class="col-md-6 text-right"><span id="igst-total">0.00</span></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6"><strong>Grand Total:</strong></div>
                                            <div class="col-md-6 text-right"><strong><span id="grand-total">0.00</span></strong></div>
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
        const PF_RATE = 0.13;
        const ESI_RATE = 0.0325;
        const CGST_RATE = 0.09;
        const SGST_RATE = 0.09;
        const IGST_RATE = 0.18;
        let rowCount = 0;


        $('#company_id').on('change', function() {
            const companyId = $(this).val();

            // Reset sections
            $('#branch').html('');
            $('#otherCompanyFields').slideUp();
            $('#otherCompanyFields input').val('');
            $('#add-row').hide(); // Hide Add Row button by default

            if (companyId && companyId !== 'other') {
                // Fetch branch for selected company
                $.ajax({
                    url: "{{ url('invoice/get-branch') }}/" + companyId,
                    type: 'GET',
                    success: function(data) {
                        if (data && data.name) {
                            $('#branch').html(`
                                <input type="hidden" name="branch_id" id="branch_hidden" value="${data.id}">
                                <input type="text" name="branch_name" id="branchid" class="form-control" value="${data.name}" readonly>
                            `);
                        } else {
                            $('#branch').html('<input type="text" class="form-control" value="No branch found" readonly>');
                        }
                    },
                    error: function() {
                        alert('Error fetching branch. Please try again.');
                    }
                });

                loadAssignJobs();

            } else if (companyId === 'other') {
                // Show fields for Other company
                $('#otherCompanyFields').slideDown();

                // Show branch dropdown
                $('#branch').html(`
                    <select class="form-control required" name="branch_id" id="branch_id" required>
                        <option value="">Select Branch</option>
                        <option value="1">MAPL</option>
                        <option value="2">AASTHA</option>
                    </select>
                `);

                // ✅ Show Add Row button
                $('#add-row').show();
            } else {
                // Reset if no company selected
                $('#branch').html('');
                $('#add-row').hide();
            }
        });




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
                                <option value="{{ $job->post }}">{{ $job->post }}</option>
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
                    <input type="number" name="items[${rowCount}][payout]" class="form-control payout" placeholder="Payout" readonly />
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
            calculateGrandTotal();
        });


        // Calculate payout per row
        function calculatePayout(row) {
            const days = parseFloat(row.find('input[name*="[days]"]').val()) || 0;
            const rate = parseFloat(row.find('input[name*="[rate]"]').val()) || 0;
            const qty = parseFloat(row.find('input[name*="[qty]"]').val()) || 1;
            const month = parseInt($('#month').val()) || new Date().getMonth() + 1;
            const year = parseInt($('#year').val()) || new Date().getFullYear();

            if (month >= 1 && month <= 12) {
                const daysInMonth = new Date(year, month, 0).getDate();
                // const payout = (days * rate * qty) / daysInMonth;
                const payout = (days * rate) / daysInMonth;
                // const payout = days * rate * qty;
                // const payout = days * rate;
                row.find('.payout').val(payout.toFixed(2));
            } else {
                row.find('.payout').val('');
            }
            calculateGrandTotal();
        }

        // Calculate totals
        function calculateGrandTotal() {
            let subTotal = 0;
            let totalQty = 0;

            // Loop through all rows to calculate subtotal and total qty
            $('.dynamic-row').each(function() {
                const payout = parseFloat($(this).find('.payout').val()) || 0;
                const qty = parseFloat($(this).find('input[name*="[qty]"]').val()) || 0;
                subTotal += payout;
                totalQty += qty;
            });

            // $('.dynamic-row').each(function() {
            //     subTotal += parseFloat($(this).find('.payout').val()) || 0;
            // });

            let totalPF = $('input[name="deduction[]"][value="PF"]').is(':checked') ? subTotal * PF_RATE : 0;
            let totalESI = $('input[name="deduction[]"][value="ESI"]').is(':checked') ? subTotal * ESI_RATE : 0;

            let labourSurcharge = parseFloat($('#labour_surcharge').val()) || 0;
            let serviceCharge = parseFloat($('#service_charge').val()) || 0;

            serviceCharge = (subTotal * (serviceCharge / 100));
            serviceCharge = parseFloat(serviceCharge.toFixed(2));

            let totalBeforeGST = subTotal + labourSurcharge + serviceCharge + totalPF + totalESI;

            let totalCGST = 0,
                totalSGST = 0,
                totalIGST = 0;
            if ($('input[name="deduction[]"][value="IGST"]').is(':checked')) {
                totalIGST = totalBeforeGST * IGST_RATE;
            } else {
                totalCGST = $('input[name="deduction[]"][value="CGST"]').is(':checked') ? totalBeforeGST * CGST_RATE : 0;
                totalSGST = $('input[name="deduction[]"][value="SGST"]').is(':checked') ? totalBeforeGST * SGST_RATE : 0;
            }

            let grandTotal = totalBeforeGST + totalCGST + totalSGST + totalIGST;

            $('#sub-total').text(subTotal.toFixed(2));
            $('#pf-total').text(totalPF.toFixed(2));
            $('#esi-total').text(totalESI.toFixed(2));
            $('#total').text(totalBeforeGST.toFixed(2));
            $('#cgst-total').text(totalCGST.toFixed(2));
            $('#sgst-total').text(totalSGST.toFixed(2));
            $('#igst-total').text(totalIGST.toFixed(2));
            $('#labour-charge').text(labourSurcharge);
            $('#service-charge').text(serviceCharge);
            $('#grand-total').text(grandTotal.toFixed(2));
        }

        // Trigger calculation when input changes
        $(document).on('input', 'input[name*="[days]"], input[name*="[rate]"], input[name*="[qty]"], #month, #year', function() {
            const row = $(this).closest('.dynamic-row');
            calculatePayout(row);
        });


        $(document).on('change', 'input[name="deduction[]"]', calculateGrandTotal);

        $(document).on('input', '#labour_surcharge, #service_charge', function() {
            calculateGrandTotal();
        });

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
                            <div class="col-md-2">
                                <label>Days</label>
                                <input type="number" name="items[${index}][days]" class="form-control" value="${job.total_attendance_days}">
                            </div>
                            <div class="col-md-2">
                                <label>QTY</label>
                                <input type="number" name="items[${index}][qty]" class="form-control" value="${job.total_assign_jobs}">
                            </div>
                            <div class="col-md-3">
                                <label>Rate</label>
                                <input type="number" name="items[${index}][rate]" class="form-control" value="${job.rate}">
                            </div>
                            <div class="col-md-3">
                                <label>Payout</label>
                                <input type="text" name="items[${index}][payout]" class="form-control payout" readonly>
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