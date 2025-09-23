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
                        {{ Form::model($quotation, ['route' => ['quotation.update', $quotation->id], 'method' => 'PUT', 'files' => 'true', 'class' => ' ajaxFormSubmit', 'id' => 'customerForm', 'data-redirect' => route('quotation.index')]) }}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="exampleInput">Select Branch<span class="validateRq">*</span></label>
                                    <div class="input-group col-md-12">
                                        <select class="form-control required branch" name="branch_id" required>
                                            <option value="">Select Branch</option>
                                            <option value="1" {{ old('branch_id', $quotation->branch_id ?? '') == 1 ? 'selected' : '' }}>MAPL</option>
                                            <option value="2" {{ old('branch_id', $quotation->branch_id ?? '') == 2 ? 'selected' : '' }}>AASTHA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInput">Party Name<span class="validateRq">*</span></label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control required name" required id="name"
                                            placeholder="Name" name="name" type="text"
                                            value="{{ old('name', $quotation->name ?? '') }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="phone">Date<span class="validateRq">*</span></label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="date"
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
                                    <label for="phone">Contact<span class="validateRq">*</span></label>
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
                                <div class="col-md-8">
                                    <label for="exampleInput">Address</label>
                                    <div class="input-group col-md-12">
                                        <input class="form-control" id="address"
                                            placeholder="Address" name="address" type="text"
                                            value="{{ old('address', $quotation->address ?? '') }}">
                                    </div>
                                </div>
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

                            </div>
                            <br />

                            <hr>
                            <h4>Add Quotation Items</h4>
                            <div id="dynamic-rows-wrapper">
                                @if(isset($details) && count($details))
                                @foreach($details as $index => $item)
                                <div class="row dynamic-row" style="margin-bottom: 20px;">
                                    <div class="col-md-4">
                                        <div class="form-group app-label">
                                            <label class="text-muted">Particluar <span>*</span></label> <br>
                                            <div class="form-group">
                                                <select class="form-control" id="particluar" name="items[{{ $index }}][particluar]" required>
                                                    <option value="">-- Select Post --</option>
                                                    <option value="WEEKLY OFF" {{ (Input::old("particluar") == 'WEEKLY OFF' ? "selected":"") }}>WEEKLY OFF</option>
                                                    <option value="SUPERVISOR" {{ (Input::old("particluar") == 'SUPERVISOR' ? "selected":"") }}>SUPERVISOR</option>
                                                    <option value="GUARD" {{ $item->particluar == 'GUARD' ? "selected":"" }}>GUARD</option>
                                                    <option value="BOUNCER" {{ $item->particluar == 'BOUNCER' ? "selected":"" }}>BOUNCER</option>
                                                    <option value="GUNMAN" {{ $item->particluar == 'GUNMAN' ? "selected":"" }}>GUNMAN</option>
                                                    <option value="OFFICE BOY" {{ $item->particluar == 'OFFICE BOY' ? "selected":"" }}>OFFICE BOY</option>
                                                    <option value="DATA ENTRY OPERATOR" {{ $item->particluar == 'DATA ENTRY OPERATOR' ? "selected":"" }}>DATA ENTRY OPERATOR</option>
                                                    <option value="DRIVER" {{ $item->particluar == 'DRIVER' ? "selected":"" }}>DRIVER</option>
                                                    <option value="HOUSEKEEPING" {{ $item->particluar == 'HOUSEKEEPING' ? "selected":"" }}>HOUSEKEEPING</option>
                                                    <option value="MAN POWER SUPPLY FOR WORKSHOP" {{ $item->particluar == 'MAN POWER SUPPLY FOR WORKSHOP' ? "selected":"" }}>MAN POWER SUPPLY FOR WORKSHOP</option>
                                                    <option value="OTHER" {{ $item->particluar == 'OTHER' ? "selected":"" }}>OTHER</option>
                                                </select>
                                                <span class="text-danger" id="particluar_err"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-muted">Gender <span>*</span></label> <br>
                                        <div class="form-group">
                                            <select class="form-control" name="items[{{ $index }}][gender]" required>
                                                <option value="Male" {{ $item->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ $item->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                            <span class="text-danger" id="gender_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-muted">Working Hour <span>*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[{{ $index }}][working_hour]" value="{{ $item->working_hour }}" class="form-control" placeholder="Working Hour" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-muted">QTY <span>*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[{{ $index }}][qty]" value="{{ $item->qty }}" class="form-control" placeholder="QTY" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-muted">Rate <span>*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[{{ $index }}][rate]" value="{{ $item->rate }}" class="form-control" placeholder="rate" required />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="text-muted"></label> <br>
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
        let rowCount = 1;

        // let rowCount = {
        //     {
        //         isset($details) ? count($details) : 1
        //     }
        // };

        $('#add-row').click(function() {
            let newRow = `
        <div class="row dynamic-row mt-2" style="margin-bottom: 20px;">
            <div class="col-md-4">
                                        <div class="form-group app-label">
                                            <label class="text-muted">Particluar <span>*</span></label> <br>
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
                                    <div class="col-md-4">
                                        <label class="text-muted">Gender <span>*</span></label> <br>
                                        <div class="form-group">
                                            <select class="form-control" id="gender" name="items[${rowCount}][gender]" required>
                                                <option value="">-- Select Gender --</option>
                                                <option value="Male" {{ (Input::old("gender") == 'Male' ? "selected":"") }}>Male</option>
                                                <option value="Female" {{ (Input::old("gender") == 'Female' ? "selected":"") }}>Female</option>
                                            </select>
                                            <span class="text-danger" id="gender_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-muted">Working Hour <span>*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[${rowCount}][working_hour]" class="form-control" placeholder="Working Hour" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-muted">QTY <span>*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[${rowCount}][qty]" class="form-control" placeholder="QTY" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-muted">Rate <span>*</span></label> <br>
                                        <div class="form-group">
                                            <input type="number" name="items[${rowCount}][rate]" class="form-control" placeholder="rate" required />
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
        });
    </script>
    @endsection