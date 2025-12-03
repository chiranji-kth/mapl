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
                <a href="{{ route('quotation.index') }}"
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
                            {{ Form::model($quotation, ['route' => ['quotation.update', $quotation->id], 'method' => 'PUT', 'files' => 'true', 'class' => ' ajaxFormSubmit', 'id' => 'customerForm', 'data-redirect' => route('quotation.index')]) }}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="exampleInput">Select Branch<span class="validateRq">*</span></label>
                                        <div class="input-group col-md-12">
                                            <select class="form-control required branch" name="branch_id" required>
                                                <option value="">Select Branch</option>
                                                @foreach($branches as $branch)
                                                <option value="{{ $branch->branch_id }}" {{ old('branch_id', $quotation->branch_id ?? '') == $branch->branch_id ? 'selected' : '' }}>{{ $branch->branch_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInput">Company Name<span class="validateRq">*</span></label>
                                        <div class="input-group col-md-12">
                                            <input class="form-control required name" required id="name"
                                                placeholder="Name" name="name" type="text"
                                                value="{{ old('name', $quotation->name ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="phone">Date<span class="validateRq">*</span></label>
                                        <div class="input-group col-md-12">
                                            <input class="form-control date" id="date"
                                                placeholder="Date" name="qdate" type="date"
                                                value="{{ old('qdate', $quotation->qdate ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="phone">State Code<span class="validateRq">*</span></label>
                                        <div class="input-group col-md-12">
                                            <input class="form-control" id="state_code"
                                                placeholder="State Code" name="state_code" type="text"
                                                value="{{ old('state_code', $quotation->state_code ?? '') }}">
                                        </div>
                                    </div>

                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="phone">Contact </label>
                                        <div class="input-group col-md-12">
                                            <input class="form-control" id="contact"
                                                placeholder="Contact" name="contact" type="text"
                                                value="{{ old('contact', $quotation->contact ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInput">Email</label>
                                        <div class="input-group col-md-12">
                                            <input class="form-control" id="email"
                                                placeholder="Email" name="email" type="email"
                                                value="{{ old('email', $quotation->email ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInput">GST No</label>
                                        <div class="input-group col-md-12">
                                            <input class="form-control" id="gst_no"
                                                placeholder="GST NO" name="gst_no" type="text"
                                                value="{{ old('gst_no', $quotation->gst_no ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInput">Deduction</label><br />
                                            @php
                                            $deductions = old('deduction', $quotation->deduction ?? []);
                                            @endphp

                                            <input type="checkbox" name="deduction[]" value="PF" {{ in_array('PF', $deductions) ? 'checked' : '' }}> PF
                                            <input type="checkbox" name="deduction[]" value="ESI" {{ in_array('ESI', $deductions) ? 'checked' : '' }}> ESI
                                            <input type="checkbox" name="deduction[]" value="CGST" {{ in_array('CGST', $deductions) ? 'checked' : '' }}> CGST
                                            <input type="checkbox" name="deduction[]" value="SGST" {{ in_array('SGST', $deductions) ? 'checked' : '' }}> SGST
                                            <input type="checkbox" name="deduction[]" value="IGST" {{ in_array('IGST', $deductions) ? 'checked' : '' }}> IGST

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Labour Surcharge</label>
                                        <div class="input-group col-md-12">
                                            <input class="form-control" id="labour_surcharge" name="labour_surcharge" type="text"
                                                value="{{ old('labour_surcharge', $quotation->labour_surcharge) }}" placeholder="Labour Surcharge">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Service Charge (%)</label>
                                        <div class="input-group col-md-12">
                                            <input class="form-control" id="service_charge" name="service_charge" type="text"
                                                value="{{ old('service_charge', $quotation->service_charge) }}" placeholder="Service Charge">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="exampleInput">Address</label>
                                        <div class="input-group col-md-12">
                                            <input class="form-control" id="address"
                                                placeholder="Address" name="address" type="text"
                                                value="{{ old('address', $quotation->address ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="note">NOTE:</label><br />
                                            @php
                                            $notes = old('note', isset($quotation->note) ? explode(', ', $quotation->note) : []);
                                            @endphp
                                            <input type="checkbox" name="note[]" value="PF & ESI IS INCLUDED & GST IS EXTRA" {{ in_array('PF & ESI IS INCLUDED & GST IS EXTRA', $notes) ? 'checked' : '' }}> PF & ESI IS INCLUDED & GST IS EXTRA<br />
                                            <input type="checkbox" name="note[]" value="PF ESI & GST ARE APPLICABLE AS PER GOVT. NORMS" {{ in_array('PF ESI & GST ARE APPLICABLE AS PER GOVT. NORMS', $notes) ? 'checked' : '' }}> PF ESI & GST ARE APPLICABLE AS PER GOVT. NORMS
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <h4>Add Quotation Items</h4>
                                <div id="dynamic-rows-wrapper">
                                    @if(isset($details) && count($details))
                                    @foreach($details as $index => $item)
                                    <div class="row dynamic-row" style="margin-bottom: 20px;">
                                        <div class="col-md-3">
                                            <div class="form-group app-label">
                                                <label class="text-muted">Particluar <span>*</span></label> <br>
                                                <div class="form-group">
                                                    <select class="form-control select2" id="particluar" name="items[{{ $index }}][particluar]" required>
                                                        <option value="">-- Select Post --</option>
                                                        @foreach ($jobs as $job)
                                                        <option value="{{ $job->job_id }}" @if ($job->job_id == $item->particluar) selected @endif>{{ $job->post }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger" id="particluar_err"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="text-muted">Gender <span>*</span></label> <br>
                                            <div class="form-group">
                                                <select class="form-control" name="items[{{ $index }}][gender]" required>
                                                    <option value="Male" {{ $item->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                    <option value="Female" {{ $item->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                                </select>
                                                <span class="text-danger" id="gender_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="text-muted">Working Hour <span>*</span></label> <br>
                                            <div class="form-group">
                                                <input type="number" name="items[{{ $index }}][working_hour]" value="{{ $item->working_hour }}" class="form-control" placeholder="Working Hour" required />
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="text-muted">QTY <span>*</span></label> <br>
                                            <div class="form-group">
                                                <input type="number" name="items[{{ $index }}][qty]" value="{{ $item->qty }}" class="form-control qty" placeholder="QTY" required />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="text-muted">Rate <span>*</span></label> <br>
                                            <div class="form-group">
                                                <input type="number" name="items[{{ $index }}][rate]" value="{{ $item->rate }}" class="form-control rate" placeholder="rate" required />
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-5">
                                            <label>Deductions / Taxes</label><br>
                                            <input type="checkbox" name="items[{{ $index }}][pf]" class="pf" @if($item->pf) checked @endif> PF
                                            <input type="checkbox" name="items[{{ $index }}][esi]" class="esi" @if($item->esi) checked @endif> ESI
                                            <input type="checkbox" name="items[{{ $index }}][cgst]" class="cgst" @if($item->cgst) checked @endif> CGST
                                            <input type="checkbox" name="items[{{ $index }}][sgst]" class="sgst" @if($item->sgst) checked @endif> SGST
                                            <input type="checkbox" name="items[{{ $index }}][igst]" class="igst" @if($item->igst) checked @endif> IGST
                                        </div> -->
                                        <div class="col-md-2">
                                            <label>Total</label>
                                            <input type="text" name="items[{{ $index }}][total]" class="form-control line-total" value="0.00" readonly>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="text-muted"></label> <br>
                                            <button type="button" class="btn btn-danger remove-row"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                                <br>
                                <button type="button" id="add-row" class="btn btn-primary pb-5" style="margin-bottom: 50px;"><i class="fa fa-plus"></i> Add Row</button>
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
            <div class="col-md-3">
                <label class="text-muted">Particular <span class="validateRq">*</span></label>
                <select name="items[${rowCount}][particluar]" class="form-control select2" required>
                    <option value="">--Select--</option>
                    @foreach ($jobs as $job)
                        <option value="{{ $job->job_id }}">{{ $job->post }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="text-muted">Gender <span class="validateRq">*</span></label>
                <select class="form-control" name="items[${rowCount}][gender]" required>
                    <option value="">-- Select Gender --</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="col-md-1">
                <label class="text-muted">Working Hour <span class="validateRq">*</span></label>
                <input type="number" name="items[${rowCount}][working_hour]" class="form-control" placeholder="Working Hour" required />
            </div>
            <div class="col-md-1">
                <label class="text-muted">QTY <span class="validateRq">*</span></label>
                <input type="number" name="items[${rowCount}][qty]" class="form-control qty" placeholder="QTY" required />
            </div>
            <div class="col-md-2">
                <label class="text-muted">Rate <span class="validateRq">*</span></label>
                <input type="number" name="items[${rowCount}][rate]" class="form-control rate" placeholder="Rate" required />
            </div>
            <div class="col-md-2">
                <label class="text-muted">Total</label>
                <input type="text" name="items[${rowCount}][total]" class="form-control line-total" value="0.00" readonly />
            </div>
            <div class="col-md-1">
                <label class="text-muted">&nbsp;</label><br>
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

                let labourSurcharge = parseFloat($('#labour_surcharge').val()) || 0;
                let serviceCharge = parseFloat($('#service_charge').val()) || 0;
                serviceCharge = subTotal * (serviceCharge / 100);
                // Total before GST
                let totalBeforeGST = subTotal + labourSurcharge + serviceCharge + totalPF + totalESI;

                // GST on totalBeforeGST
                if ($('input[value="CGST"]').is(':checked')) totalCGST = totalBeforeGST * CGST_RATE;
                if ($('input[value="SGST"]').is(':checked')) totalSGST = totalBeforeGST * SGST_RATE;
                if ($('input[value="IGST"]').is(':checked')) totalIGST = totalBeforeGST * IGST_RATE;

                // Grand Total (including all charges)
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

            // Event bindings
            $(document).on('input', '.qty, .rate', function() {
                let row = $(this).closest('.dynamic-row');
                calculateRowTotal(row);
            });

            $(document).on('change', 'input[name="deduction[]"]', function() {
                calculateGrandTotal();
            });

            $(document).on('input', '#labour_surcharge, #service_charge', function() {
                calculateGrandTotal();
            });

            // Initial calculation
            $('.dynamic-row').each(function() {
                calculateRowTotal($(this));
            });
        </script>
        @endsection