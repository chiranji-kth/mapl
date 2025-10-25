@extends('admin.master')
@section('content')
@section('title')
    Fllow-up Activity
@endsection
<style>

.activity-list > li {
  /*border-bottom: 1px solid #eee;*/
  border-top: 1px solid #ccc;
  padding: 10px 0px 10px 0px;
    
}
.activity-list > li span{
    font-size: 12px;
    font-weight: 600;
    border-bottom: dotted #ccc 2px;
}
.activity-list > li p a{
    padding-left: 10px;
    font-size: 13px;
    font-weight: 500;
}
.activity-list .float-left {
  margin-right: 10px;
  width: 40px;
  height: 40px;
  float: left;
  display: block;
  border-radius: 50%;
  background-color: #eee;
  font-size: 20px;
  line-height: 100%;
  line-height: 43px;
  text-align: center; }
  .activity-list .float-left a {
    display: inline-block;
    color: #999; }
</style>
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
            <a href="{{ route('lead.index') }}"
                class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i
                    class="fa fa-list-ul" aria-hidden="true"></i> @lang('lead.view_lead') </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i> @yield('title')</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <ul class="activity-list list-unstyled">
                                <li class="clearfix">
                                    <div class="act-content">
                                        <span class="text-small">A MONTH AGO</span>
                                        <p><i class="fa fa-user"></i><a href="#">Manish munde</a>
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.
                                        </p>
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <div class="act-content">
                                        <span class="text-small">11 Min Ago, On </span>
                                        <p class="mb0">
                                            <i class="fa fa-user"></i><a href="#">sumit tayal</a>
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.
                                        </p>
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <div class="act-content">
                                        <span class="text-small">11 Min Ago, On </span>
                                        <p class="mb20">
                                            <i class="fa fa-user"></i><a href="#">Kishor Das</a>
                                            Lorem Ipsum is simply dummy text of the printing 
                                        </p>
                                    </div>
                                </li>
                            </ul>
                            
                            
                        {{ Form::model($editModeData, ['route' => ['lead.update', $editModeData->lead_id], 'method' => 'PUT', 'files' => 'true', 'class' => ' ajaxFormSubmit', 'id' => 'leadForm', 'data-redirect' => route('lead.index')]) }}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <textarea cols="100" rows="5" class="form-control required message" required id="message"
                                            placeholder="Write followup" name="name" ></textarea>
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
