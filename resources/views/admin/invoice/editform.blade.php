@extends('admin.master')
@section('content')
@section('title')
@lang('Edit invoice')
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
                        {{ Form::model($invoice, ['route' => ['invoice.update', $invoice->id], 'method' => 'PUT', 'files' => 'true', 'class' => ' ajaxFormSubmit', 'id' => 'customerForm', 'data-redirect' => route('invoice.index')]) }}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Select Branch <span class="validateRq">*</span></label>
                                    <div class="input-group col-md-12">
                                        <select class="form-control required branch" name="branch_id" required>
                                            <option value="">Select Branch</option>
                                            <option value="1" {{ old('branch_id', $invoice->branch_id) == 1 ? 'selected' : '' }}>MAPL</option>
                                            <option value="2" {{ old('branch_id', $invoice->branch_id) == 2 ? 'selected' : '' }}>AASTHA</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Party Name <span class="validateRq">*</span></label>
                                    <div class="input-group col-md-12">
                                        <select class="form-control required" name="company_id" id="company_id" required>
                                            <option value="">-- Select Company --</option>
                                        
                                            @foreach($companys as $company)
                                                <option value="{{ $company->company_id }}"
                                                    {{ (string) old('company_id', $invoice->company_id) == (string) $company->company_id ? 'selected' : '' }}>
                                                    {{ $company->company_name }}
                                                </option>
                                            @endforeach
                                        
                                            <option value="other" {{ old('company_id', $invoice->company_id) === 'other' ? 'selected' : '' }}>Other</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Date <span class="validateRq">*</span></label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="date" name="qdate" type="date"
                                            value="{{ old('qdate', $invoice->qdate) }}">
                                    </div>
                                </div>
                            </div>

                            <br>

                            {{-- Show when "Other" company selected --}}
                            <div id=" otherCompanyFields" class="row" style="display: {{ old('company_id', $invoice->company_id) === 'other' ? 'block' : 'none' }}; margin-top: 15px;">
                                <div class="col-md-4">
                                    <label>Company Name</label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="name" name="name" type="text"
                                            value="{{ old('name', $invoice->name) }}" placeholder="Company Name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Phone</label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="contact" name="contact" type="text"
                                            value="{{ old('contact', $invoice->contact) }}" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Email</label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="email" name="email" type="email"
                                            value="{{ old('email', $invoice->email) }}" placeholder="Email">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>GST No</label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="gst_no" name="gst_no" type="text"
                                            value="{{ old('gst_no', $invoice->gst_no) }}" placeholder="GST NO">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Pincode</label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="pincode" name="pincode" type="text"
                                            value="{{ old('pincode', $invoice->pincode) }}" placeholder="Pincode">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label>Address</label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="address" name="address" type="text"
                                            value="{{ old('address', $invoice->address) }}" placeholder="Address">
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInput">Deduction</label><br />
                                        @php
                                        $deductions = old('deduction', $invoice->deduction ?? []);
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
                                            value="{{ old('labour_surcharge', $invoice->labour_surcharge) }}" placeholder="Labour Surcharge">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Service Charge</label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="service_charge" name="service_charge" type="text"
                                            value="{{ old('service_charge', $invoice->service_charge) }}" placeholder="Service Charge">
                                    </div>
                                </div>
                            </div>


                            <br>


                            <hr>
                            <h4>Add Invoice Items</h4>
                            <div id="dynamic-rows-wrapper">
                                @if(isset($details) && count($details))
                                @foreach($details as $index => $item)
                                
                                <div class="row dynamic-row" style="margin-bottom: 20px;">
                                    <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id }}">
                                    <div class="col-md-3">
                                        <div class="form-group app-label">
                                            <label class="text-muted">Particular <span class="validateRq">*</span></label> <br>
                                            <div class="form-group">
                                                <select class="form-control" name="items[{{ $index }}][particluar]" required>
                                                    <option value="">-- Select Post --</option>
                                                    @foreach(['SUPERVISOR', 'WEEKLY OFF', 'GUARD', 'BOUNCER', 'GUNMAN', 'OFFICE BOY', 'DATA ENTRY OPERATOR', 'DRIVER', 'HOUSEKEEPING', 'MAN POWER SUPPLY FOR WORKSHOP' , 'OTHER'] as $role)
                                                    <option value="{{ $role }}" {{ $item->particluar == $role ? 'selected' : '' }}>{{ $role }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger" id="particluar_err"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-muted">Gender <span class="validateRq">*</span></label> <br>
                                        <div class="form-group">
                                            <select class="form-control" id="gender" name="items[{{ $index }}][gender]" required>
                                                <option value="">-- Select Gender --</option>
                                                <option value="Male" {{ $item->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ $item->gender == 'Female' ? 'selected' : '' }}>Female</option>

                                            </select>
                                            <span class="text-danger" id="gender_err"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="text-muted">Month <span>*</span></label>
                                        <input type="number" name="items[{{ $index }}][month]" class="form-control" placeholder="Month" min="1" max="12" required value="{{ $item->month }}">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="text-muted">Year <span>*</span></label>
                                        <input type="number" name="items[{{ $index }}][year]" class="form-control" placeholder="Year" min="2020" required value="{{ $item->year }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="text-muted">Working Hour <span class="validateRq">*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[{{ $index }}][working_hour]" class="form-control" placeholder="Working Hour" min="1" value="{{ $item->working_hour }}" required />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <label class="text-muted">Days <span>*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[{{ $index }}][days]" class="form-control" placeholder="No Of Days" min="1" value="{{ $item->days }}" required />
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="text-muted">QTY <span>*</span></label>
                                        <input type="number" name="items[{{ $index }}][qty]" class="form-control" placeholder="QTY" min="1" required value="{{ $item->qty }}">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="text-muted">Rate <span>*</span></label>
                                        <input type="number" name="items[{{ $index }}][rate]" class="form-control" placeholder="Rate" min="0" required value="{{ $item->rate }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="text-muted">Payout <span>*</span></label> <br>
                                        <div class="form-group">
                                            <input type="text" name="items[{{ $index }}][payout]" class="form-control" placeholder="Payout" value="{{ $item->payout }}" readonly required />
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <br/>
                                        <button type="button" class="btn btn-danger remove-row"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                                @endforeach
                                @endif
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


         let rowCount = {{ $index + 1 }};

        $('#add-row').click(function() {
            let newRow = `
        <div class="row dynamic-row mt-2" style="margin-bottom: 20px;">
            <div class="col-md-3">
                                        <div class="form-group app-label">
                                            <label class="text-muted">Particluar <span class="validateRq">*</span></label> <br>
                                            <div class="form-group">
                                                <select class="form-control" id="particluar" name="items[${rowCount}][particluar]" required>
                                                    <option value="">-- Select Post --</option>
                                                    <option value="SUPERVISOR" {{ (Input::old("particluar") == 'SUPERVISOR' ? "selected":"") }}>SUPERVISOR</option>
                                                    <option value="WEEKLY OFF" {{ (Input::old("particluar") == 'WEEKLY OFF' ? "selected":"") }}>WEEKLY OFF</option>
                                                    <option value="GUARD" {{ (Input::old("particluar") == 'GUARD' ? "selected":"") }}>GUARD</option>
                                                    <option value="BOUNCER" {{ (Input::old("particluar") == 'BOUNCER' ? "selected":"") }}>BOUNCER</option>
                                                    <option value="GUNMAN" {{ (Input::old("particluar") == 'GUNMAN' ? "selected":"") }}>GUNMAN</option>
                                                    <option value="OFFICE BOY" {{ (Input::old("particluar") == 'OFFICE BOY' ? "selected":"") }}>OFFICE BOY</option>
                                                    <option value="DATA ENTRY OPERATOR" {{ (Input::old("particluar") == 'DATA ENTRY OPERATOR' ? "selected":"") }}>DATA ENTRY OPERATOR</option>
                                                    <option value="DRIVER" {{ (Input::old("particluar") == 'DRIVER' ? "selected":"") }}>DRIVER</option>
                                                    <option value="OTHER" {{ (Input::old("particluar") == 'OTHER' ? "selected":"") }}>OTHER</option>
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
                                    <div class="col-md-2">
                                        <label class="text-muted">Month <span>*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[${rowCount}][month]" class="form-control" placeholder="Month" min="1" max="12" required />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="text-muted">Year <span>*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[${rowCount}][year]" class="form-control" placeholder="Year" min="2020" required />
                                        </div>
                                    </div>
            
                                    <div class="col-md-2">
                                        <label class="text-muted">Working Hour <span class="validateRq">*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[${rowCount}][working_hour]" class="form-control" placeholder="Working Hour" min="1" required />
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
    @endsection