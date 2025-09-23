@extends('admin.master')
@section('content')

@section('title')
    @if (isset($editModeData))
        @lang('promotion.edit_employee_promotion')
    @else
        @lang('promotion.add_employee_promotion')
    @endif
@endsection

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <ol class="breadcrumb">
                <li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                        @lang('dashboard.dashboard')</a></li>
                <li>Add Job</li>

            </ol>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <a href="{{ route('assignJob.index') }}"
                class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i
                    class="fa fa-list-ul" aria-hidden="true"></i> View Assign Job</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i>Add Assign Job</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">

                        {{ Form::open(['route' => 'assignJob.store', 'enctype' => 'multipart/form-data', 'class' => ' ajaxFormSubmit', 'id' => 'promotionForm', 'data-redirect' => route('assignJob.index')]) }}
            

                        <div class="form-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInput">Employee<span
                                                class="validateRq">*</span></label>
                                        {{ Form::select('emp_id', $employeeList, Input::old('emp_id'), ['class' => 'form-control employeeId required select2']) }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInput">Company<span
                                                class="validateRq">*</span></label>
                                        {{ Form::select('company_id', $companyList, Input::old('company_id'), ['class' => 'form-control companyId required select2']) }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInput">Wages (Per day) <span
                                                class="validateRq">*</span></label>
                                        {!! Form::number(
                                            'perday_wages',
                                            Input::old('perday_wages'),
                                            $attributes = [
                                                'class' => 'form-control required perday_wages',
                                                'id' => 'perday_wages',
                                                'placeholder' => 'Wages',
                                            ],
                                        ) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="exampleInput">From<span
                                            class="validateRq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        {!! Form::text(
                                            'from_date',
                                             Input::old('from_date'),
                                            $attributes = [
                                                'class' => 'form-control required dateField',
                                                'placeholder' => 'From date',
                                            ],
                                        ) !!}
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="exampleInput">To</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        {!! Form::text(
                                            'to_date',
                                             Input::old('to_date'),
                                            $attributes = [
                                                'class' => 'form-control dateField',
                                                'placeholder' => 'To date',
                                            ],
                                        ) !!}
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInput">Deduction</label><br />
                                        <input type="checkbox" name="deduction[]" class="form-controle" value="PF"> PF
                                        <input type="checkbox" name="deduction[]" class="form-controle" value="ESI"> ESI
                                        <input type="checkbox" name="deduction[]" class="form-controle" value="TDS"> TDS
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-info btn_style"><i
                                                    class="fa fa-check"></i> @lang('common.save')</button>
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
</div>
@endsection
