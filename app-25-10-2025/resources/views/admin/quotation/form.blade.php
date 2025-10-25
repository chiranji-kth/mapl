@extends('admin.master')
@section('content')
@section('title')
@lang('add new quotation')
@endsection

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <ol class="breadcrumb">
                <li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i> @lang('dashboard.dashboard')</a></li>
                <li>Add New Quotation</li>
            </ol>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
            <a href="{{ route('customer.index') }}" class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i class="fa fa-list-ul" aria-hidden="true"></i> View Quotation </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i> Add New Quotation</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        {{ Form::open(['route' => 'quotation.store', 'enctype' => 'multipart/form-data', 'class' => 'ajaxFormSubmit', 'id' => 'customerForm', 'data-redirect' => route('quotation.index')]) }}

                        <div class="form-body">
                            <!-- Customer Info -->
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Select Branch<span class="validateRq">*</span></label>
                                    <select class="form-control required branch" required name="branch_id" id="branch_id">
                                        <option value="">-- Select Branch --</option>
                                        @foreach($branches as $branch)
                                        <option value="{{ $branch->branch_id }}">{{ $branch->branch_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Company Name<span class="validateRq">*</span></label>
                                    <input class="form-control required" required id="name" placeholder="Name" name="name" type="text" value="{{ old('name') }}">
                                </div>
                                <div class="col-md-3">
                                    <label>Date<span class="validateRq">*</span></label>
                                    <input class="form-control date" id="date" placeholder="Date" name="qdate" type="date">
                                </div>
                                <div class="col-md-2">
                                    <label>State Code<span class="validateRq">*</span></label>
                                    <input class="form-control" id="state_code" placeholder="State Code" name="state_code" type="text">
                                </div>
                            </div>

                            <br />

                            <div class="row">
                                <div class="col-md-4">
                                    <label>Phone</label>
                                    <input class="form-control" id="contact" placeholder="Phone" name="contact" type="text" maxlength="10" minlength="0" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);">
                                </div>
                                <div class="col-md-4">
                                    <label>Email</label>
                                    <input class="form-control" id="email" placeholder="Email" name="email" type="email" value="{{ old('email') }}">
                                </div>
                                <div class="col-md-4">
                                    <label>GST No</label>
                                    <input class="form-control" id="gst_no" placeholder="GST NO" name="gst_no" type="text" value="{{ old('gst_no') }}">
                                </div>
                            </div>

                            <br />

                            <div class="row">
                                <div class="col-md-8">
                                    <label>Address</label>
                                    <input class="form-control" id="address" placeholder="Address" name="address" type="text" value="{{ old('address') }}">
                                </div>
                                <div class="col-md-4">
                                    <label>Deduction / Tax</label><br>
                                    <input type="checkbox" name="deduction[]" value="PF"> PF
                                    <input type="checkbox" name="deduction[]" value="ESI"> ESI
                                    <input type="checkbox" name="deduction[]" value="CGST"> CGST
                                    <input type="checkbox" name="deduction[]" value="SGST"> SGST
                                    <input type="checkbox" name="deduction[]" value="IGST"> IGST
                                </div>
                            </div>

                            <br /><br />

                            <hr>
                            <h4>Add Quotation Items</h4>
                            <div id="dynamic-rows-wrapper">
                                <div class="row dynamic-row" style="margin-bottom: 20px;">
                                    <div class="col-md-2">
                                        <label>Particular <span class="validateRq">*</span></label>
                                        <select class="form-control select2" id="particluar" name="items[0][particluar]" required>
                                            <option value="">--- Please Select ---</option>
                                            @foreach ($jobs as $job)
                                            <option value="{{ $job->job_id }}">{{ $job->post }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Gender <span class="validateRq">*</span></label>
                                        <select class="form-control" name="items[0][gender]" required>
                                            <option value="">-- Select Gender --</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Working Hour <span class="validateRq">*</span></label>
                                        <input type="number" name="items[0][working_hour]" class="form-control" placeholder="Working Hour" required />
                                    </div>
                                    <div class="col-md-2">
                                        <label>QTY <span class="validateRq">*</span></label>
                                        <input type="number" name="items[0][qty]" class="form-control qty" placeholder="QTY" required />
                                    </div>
                                    <div class="col-md-2">
                                        <label>Rate <span class="validateRq">*</span></label>
                                        <input type="number" name="items[0][rate]" class="form-control rate" placeholder="Rate" required />
                                    </div>
                                    <div class="col-md-2">
                                        <label>Total</label>
                                        <input type="text" name="items[0][total]" class="form-control line-total" value="0.00" readonly>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <button type="button" id="add-row" class="btn btn-primary pb-5"><i class="fa fa-plus"></i> Add Row</button>

                            <br><br>

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
                                <button type="submit" class="btn btn-info btn_style"><i class="fa fa-check"></i> @lang('common.save')</button>
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
    $(function() {
        $(".date").datepicker({
            dateFormat: "dd/mm/y",
            changeMonth: true,
            changeYear: true,
            yearRange: "1980:2025"
        });
    });
</script>
    <script>
        let rowCount = 1;

        // Percentages
        const PF_RATE = 0.13;
        const ESI_RATE = 0.0325;
        const CGST_RATE = 0.09;
        const SGST_RATE = 0.09;
        const IGST_RATE = 0.18;

        // Add new row
        $('#add-row').click(function() {
            let newRow = `
<div class="row dynamic-row" style="margin-bottom: 20px;">
    <div class="col-md-2">
        <label>Particular</label>
        <select name="items[${rowCount}][particluar]" class="form-control select2" required>
            <option value="">--Select--</option>
            @foreach ($jobs as $job)
                <option value="{{ $job->job_id }}">{{ $job->post }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <label>Gender</label>
        <select class="form-control" name="items[${rowCount}][gender]" required>
            <option value="">-- Select Gender --</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </div>
    <div class="col-md-2">
        <label>Working Hour</label>
        <input type="number" name="items[${rowCount}][working_hour]" class="form-control" placeholder="Working Hour" required />
    </div>
    <div class="col-md-2">
        <label>QTY</label>
        <input type="number" name="items[${rowCount}][qty]" class="form-control qty" placeholder="QTY" required />
    </div>
    <div class="col-md-2">
        <label>Rate</label>
        <input type="number" name="items[${rowCount}][rate]" class="form-control rate" placeholder="Rate" required />
    </div>
    <div class="col-md-2">
        <label>Total</label>
        <input type="text" name="items[${rowCount}][total]" class="form-control line-total" value="0.00" readonly />
    </div>
    <div class="col-md-2">
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

        // Calculate row total
        function calculateRowTotal(row) {
            let qty = parseFloat(row.find('.qty').val()) || 0;
            let rate = parseFloat(row.find('.rate').val()) || 0;
            let baseTotal = qty * rate;

            row.find('.line-total').val(baseTotal.toFixed(2));
            calculateGrandTotal();
        }

        // Calculate grand total
        function calculateGrandTotal() {
            let subTotal = 0;
            let totalPF = 0;
            let totalESI = 0;
            let totalCGST = 0;
            let totalSGST = 0;
            let totalIGST = 0;

            $('.dynamic-row').each(function() {
                let row = $(this);
                let qty = parseFloat(row.find('.qty').val()) || 0;
                let rate = parseFloat(row.find('.rate').val()) || 0;
                let baseTotal = qty * rate;

                subTotal += baseTotal;
            });

            // PF and ESI
            if ($('input[value="PF"]').is(':checked')) totalPF = subTotal * PF_RATE;
            if ($('input[value="ESI"]').is(':checked')) totalESI = subTotal * ESI_RATE;

            // Total before GST
            let totalBeforeGST = subTotal + totalPF + totalESI;

            // GST on totalBeforeGST
            if ($('input[value="CGST"]').is(':checked')) totalCGST = totalBeforeGST * CGST_RATE;
            if ($('input[value="SGST"]').is(':checked')) totalSGST = totalBeforeGST * SGST_RATE;
            if ($('input[value="IGST"]').is(':checked')) totalIGST = totalBeforeGST * IGST_RATE;

            // Grand total
            let grandTotal = totalBeforeGST + totalCGST + totalSGST + totalIGST;

            $('#sub-total').text(subTotal.toFixed(2));
            $('#pf-total').text(totalPF.toFixed(2));
            $('#esi-total').text(totalESI.toFixed(2));
            $('#total').text(totalBeforeGST.toFixed(2));
            $('#cgst-total').text(totalCGST.toFixed(2));
            $('#sgst-total').text(totalSGST.toFixed(2));
            $('#igst-total').text(totalIGST.toFixed(2));
            $('#grand-total').text(grandTotal.toFixed(2));
        }

        // Event bindings
        $(document).on('input', '.qty, .rate', function() {
            let row = $(this).closest('.dynamic-row');
            calculateRowTotal(row);
        });

        $(document).on('change', 'input[name="deduction[]"]', function() {
            calculateGrandTotal();
        });

        // Initial calculation
        $('.dynamic-row').each(function() {
            calculateRowTotal($(this));
        });
    </script>
    @endsection