@extends('admin.master')
@section('content')
@section('title')
@lang('add new quotation')
@endsection
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <ol class="breadcrumb">
                <li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                        @lang('dashboard.dashboard')</a></li>
                <li>Add New Quotation</li>
            </ol>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
            <a href="{{ route('customer.index') }}"
                class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i
                    class="fa fa-list-ul" aria-hidden="true"></i> View Quotation </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i>add new quotation</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        {{ Form::open(['route' => 'quotation.store', 'enctype' => 'multipart/form-data', 'class' => 'ajaxFormSubmit', 'id' => 'customerForm', 'data-redirect' => route('quotation.index')]) }}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="exampleInput">Select Branch<span class="validateRq">*</span></label>
                                    <div class="input-group col-md-12">
                                        <select input class="form-control required branch" required name="branch_id" id="branch_id">
                                            <option value="">-- Select Branch --</option>
                                            @foreach($branches as $branch)
                                            <option value="{{ $branch->branch_id }}">{{ $branch->branch_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInput">Party Name<span class="validateRq">*</span></label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control required name" required id="name"
                                            placeholder="Name" name="name" type="text"
                                            value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="phone">Date<span class="validateRq">*</span></label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="date"
                                            placeholder="Date" name="qdate" type="date">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="phone">State Code<span class="validateRq">*</span></label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="state_code"
                                            placeholder="State Code" name="state_code" type="text">
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="phone">Phone</label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="contact" placeholder="Phone" name="contact" type="text" maxlength="10" minlength="0"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);">
                                        <span class="text-danger" id="phone_err"></span>
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
                                <div class="col-md-4">
                                    <label for="exampleInput">GST No</label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="gst_no"
                                            placeholder="GST NO" name="gst_no" type="text"
                                            value="{{ old('gst_no') }}">
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="exampleInput">Address</label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="address"
                                            placeholder="Address" name="address" type="text"
                                            value="{{ old('address') }}">
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInput">Deduction</label><br />
                                        <input type="checkbox" name="deduction[]" class="form-controle" value="PF"> PF
                                        <input type="checkbox" name="deduction[]" class="form-controle" value="ESI"> ESI
                                        <input type="checkbox" name="deduction[]" class="form-controle" value="CGST"> CGST
                                        <input type="checkbox" name="deduction[]" class="form-controle" value="SGST"> SGST
                                        <input type="checkbox" name="deduction[]" class="form-controle" value="IGST"> IGST
                                    </div>
                                </div> -->
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInput">NOTE:</label><br />
                                    <input type="checkbox" name="note[]" class="form-controle" value="PF & ESI IS INCLUDED & GST IS EXTRA"> PF & ESI IS INCLUDED & GST IS EXTRA<br />
                                    <input type="checkbox" name="note[]" class="form-controle" value="PF, ESI & GST ARE APPLICABLE AS PER GOVT. NORMS"> PF, ESI & GST ARE APPLICABLE AS PER GOVT. NORMS
                                </div>
                            </div>
                            <br /><br />

                            <hr>
                            <h4>Add Quotation Items</h4>
                            <div id="dynamic-rows-wrapper">
                                <div class="row dynamic-row" style="margin-bottom: 20px;">
                                    <div class="col-md-4">
                                        <div class="form-group app-label">
                                            <label class="text-muted">Particluar <span class="validateRq">*</span></label> <br>
                                            <div class="form-group">
                                                <select class="form-control" id="particluar" name="items[0][particluar]" required>
                                                    <option value="">--- @lang('common.please_select') ---</option>
                                                    @foreach ($jobs as $job)
                                                    <option value="{{ $job->job_id }}">{{ $job->post }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger" id="particluar_err"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-muted">Gender <span class="validateRq">*</span></label> <br>
                                        <div class="form-group">
                                            <select class="form-control" id="gender" name="items[0][gender]" required>
                                                <option value="">-- Select Gender --</option>
                                                <option value="Male" {{ (Input::old("gender") == 'Male' ? "selected":"") }}>Male</option>
                                                <option value="Female" {{ (Input::old("gender") == 'Female' ? "selected":"") }}>Female</option>
                                            </select>
                                            <span class="text-danger" id="gender_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="text-muted">Working Hour <span class="validateRq">*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[0][working_hour]" class="form-control" placeholder="Working Hour" required />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="text-muted">QTY <span class="validateRq">*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[0][qty]" class="form-control qty" placeholder="QTY" required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-muted">Rate <span class="validateRq">*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[0][rate]" class="form-control rate" placeholder="rate" required />
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <label>Deductions / Taxes</label><br>
                                        <input type="checkbox" name="items[0][pf]" class="pf"> PF
                                        <input type="checkbox" name="items[0][esi]" class="esi"> ESI
                                        <input type="checkbox" name="items[0][cgst]" class="cgst"> CGST
                                        <input type="checkbox" name="items[0][sgst]" class="sgst"> SGST
                                        <input type="checkbox" name="items[0][igst]" class="igst"> IGST
                                    </div>
                                    <div class="col-md-2">
                                        <label>Total</label>
                                        <input type="text" name="items[0][total]" class="form-control line-total" value="0.00" readonly>
                                    </div>
                                    <div class="col-md-2">
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
        let rowCount = 1;

        // Add new row
        $('#add-row').click(function() {
            let newRow = `
                                    <div class="row dynamic-row" style="margin-bottom: 20px;">
                                        <div class="col-md-4">
                                            <label class="text-muted">Particluar  <span class="validateRq">*</span></label> <br>
                                            <div class="form-group">
                                                <select name="items[${rowCount}][particluar]" class="form-control" required>
                                                    <option value="">--Select--</option>
                                                    @foreach ($jobs as $job)
                                                        <option value="{{ $job->job_id }}">{{ $job->post }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        <label class="text-muted">Gender <span class="validateRq">*</span></label> <br>
                                        <div class="form-group">
                                            <select class="form-control" id="gender" name="items[${rowCount}][gender]" required>
                                                <option value="">-- Select Gender --</option>
                                                <option value="Male" {{ (Input::old("gender") == 'Male' ? "selected":"") }}>Male</option>
                                                <option value="Female" {{ (Input::old("gender") == 'Female' ? "selected":"") }}>Female</option>
                                            </select>
                                            <span class="text-danger" id="gender_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="text-muted">Working Hour <span class="validateRq">*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[${rowCount}][working_hour]" class="form-control" placeholder="Working Hour" required />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="text-muted">QTY <span class="validateRq">*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[${rowCount}][qty]" class="form-control qty" placeholder="QTY" required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-muted">Rate <span class="validateRq">*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[${rowCount}][rate]" class="form-control rate" placeholder="rate" required />
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="text-muted">Deductions / Taxes</label> <br>
                                        <div class="form-group">
                                            <input type="checkbox" name="items[${rowCount}][pf]" class="pf"> PF
                                            <input type="checkbox" name="items[${rowCount}][esi]" class="esi"> ESI
                                            <input type="checkbox" name="items[${rowCount}][cgst]" class="cgst"> CGST
                                            <input type="checkbox" name="items[${rowCount}][sgst]" class="sgst"> SGST
                                            <input type="checkbox" name="items[${rowCount}][igst]" class="igst"> IGST
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="text-muted">Total <span class="validateRq">*</span></label> <br>
                                        <div class="form-group">
                                        <input type="text" name="items[${rowCount}][total]" class="form-control line-total" value="0.00" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
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

        // Calculate row total
        function calculateRowTotal(row) {
            let qty = parseFloat(row.find('.qty').val()) || 0;
            let rate = parseFloat(row.find('.rate').val()) || 0;

            let total = qty * rate;

            // Check deductions / taxes
            let pf = row.find('.pf').is(':checked') ? total * 0.13 : 0;
            let esi = row.find('.esi').is(':checked') ? total * 0.0325 : 0;
            let cgst = row.find('.cgst').is(':checked') ? total * 0.09 : 0;
            let sgst = row.find('.sgst').is(':checked') ? total * 0.09 : 0;
            let igst = row.find('.igst').is(':checked') ? total * 0.18 : 0;

            let rowTotal = total + pf + esi + cgst + sgst + igst;

            row.find('.line-total').val(rowTotal.toFixed(2));
            calculateGrandTotal();
        }

        // Calculate grand total
        function calculateGrandTotal() {
            let grandTotal = 0;
            $('.line-total').each(function() {
                grandTotal += parseFloat($(this).val()) || 0;
            });
            $('#grand-total').text(grandTotal.toFixed(2));
        }

        // Bind events
        $(document).on('input', '.qty, .rate', function() {
            let row = $(this).closest('.dynamic-row');
            calculateRowTotal(row);
        });

        $(document).on('change', '.pf, .esi, .cgst, .sgst, .igst', function() {
            let row = $(this).closest('.dynamic-row');
            calculateRowTotal(row);
        });

        // Initial calculation
        $('.dynamic-row').each(function() {
            calculateRowTotal($(this));
        });
    </script>
    @endsection