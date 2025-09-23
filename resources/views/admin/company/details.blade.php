@extends('admin.master')
@section('content')
@section('title')

View Company

@endsection
<style>
	.panel-custom {
		background-color: #F1F1F1;
		box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
		padding: 10px 15px;
	}

	.item {
		padding: 13px 21px;
	}
</style>
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<ol class="breadcrumb">
				<li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i> @lang('dashboard.dashboard')</a></li>
				<li>Company Detail</li>
			</ol>
		</div>

	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-info">
				<div class="panel-heading"><i class="mdi mdi-table fa-fw"></i>
					Company Information</div>
				<div class="panel-wrapper collapse in" aria-expanded="true">
					<div class="panel-body">
						<div class="panel-body">
							<div class="">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div id="resume">
										<p><strong>{{$result->company_name}}</strong></p>
										<p><b>Email :</b> {{$result->email}}</p>
										<p>
										</p>
										<p class="applicant_address"> <b>Address : </b> {{ $result->address ? $result->address : '' }}</p>
										<p> <b>Phone :</b> {{$result->phone}}</p>
										<p>

										</p>
									</div>
								</div>

								<div class="col-xs-6 col-sm-6 col-md-3">
									<div class="applicant_pic text-right">
										<?php
										if ($result->site_photo_1 != '') {
										?>
											<img style="width: 124px;height:135px" src="{!! asset('uploads/companyPhoto/'.$result->site_photo_1) !!}">
										<?php  } ?>
									</div>
									<br>
								</div>

								<div class="col-xs-6 col-sm-6 col-md-3">
									<div class="applicant_pic text-right">
										<?php
										if ($result->site_photo_2 != '') {
										?>
											<img style="width: 124px;height:135px" src="{!! asset('uploads/companyPhoto/'.$result->site_photo_2) !!}">
										<?php  } ?>
									</div>
									<br>
								</div>


								<div class="personal_info">
									<div class="row">
										<div class="col-xs-12">
											<div class="panel-custom">
												<h3 class="panel-title"><i class="fa fa-info-circle"></i> Company information</h3>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="personal_info">
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Company</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->company_name}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Industry Type</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->industry}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Branch</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{$result->branch}}</strong></div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">@lang('employee.email')</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->email}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">@lang('employee.phone')</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->phone}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">@lang('employee.address')</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->address}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">GST</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->gst}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">PAN</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->pan}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">State</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->state}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">District</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->district}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">City</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->city}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">date of service</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{dateConvertDBtoForm($result->date_of_service)}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">owner name</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->owner_name}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">owner phone</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->owner_phone}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">contact person name</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->contact_person_name}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">contact person phone</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->contact_person_phone}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">site address</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->site_address}}</div>
											</div>

											<!--<div class="item">-->
											<!--	<div class="col-xs-2 col-sm-2 col-md-3">Status</div>-->
											<!--	<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;<span-->
											<!--                                             class="label label-{{ $result->status == '1' ? 'success' : 'danger' }}">{{ $result->status == '1' ? __('recruitement.employeeyed') : __('Rejected') }}</span></div>-->
											<!--</div>-->

										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4"></div>
									<div class="col-md-4">
										<hr>

									</div>
									<div class="col-md-4"></div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection