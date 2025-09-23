@extends('admin.master')
@section('content')
@section('title')
    @lang('customer.edit_customer')
@endsection
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <ol class="breadcrumb">
                <li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                        @lang('dashboard.dashboard')</a></li>
                <li>@yield('title')</li>
            </ol>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
            <a href="{{ route('customer.index') }}"
                class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i
                    class="fa fa-list-ul" aria-hidden="true"></i> @lang('customer.view_customer') </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i> @yield('title')</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        {{ Form::model($editModeData, ['route' => ['customer.update', $editModeData->customer_id], 'method' => 'PUT', 'files' => 'true', 'class' => ' ajaxFormSubmit', 'id' => 'customerForm', 'data-redirect' => route('customer.index')]) }}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInput">Name<span class="validateRq">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-user"></i></div>
                                        <input class="form-control required name" required id="name"
                                            placeholder="Name" name="name" type="text"
                                            value="{{ $editModeData->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone">Phone<span class="validateRq">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                        <input class="form-control required phone" required id="phone"
                                            placeholder="Phone" name="phone" type="text" value="{{ $editModeData->phone }}">
                                    </div>
                                </div>
                            </div>
                            <br/>
                            
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
