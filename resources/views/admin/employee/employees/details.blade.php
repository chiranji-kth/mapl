@extends('admin.master')
@section('content')
@section('title')

View Applicant

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
				<li>Employee Detail</li>
			</ol>
		</div>

	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-info">
				<div class="panel-heading"><i class="mdi mdi-table fa-fw"></i>
					Employee Profile</div>
				<div class="panel-wrapper collapse in" aria-expanded="true">
					<div class="panel-body">
						<div class="panel-body">
							<div class="">
								<div class="col-xs-6 col-sm-6 col-md-5">
									<div id="resume">
										<p><strong>{{$result->name}}</strong></p>
										<p>{{$result->email}}</p>
										<p>{{$result->phone}}</p>
										<p class="applicant_address"> <b>Current @lang('employee.address') : </b> District: {{ $result->c_district ? $result->c_district : '' }}, City: {{ $result->c_city ? $result->c_city : '' }}, Address: {{ $result->c_address ? $result->c_address : '' }}</p>
										<p class="applicant_address"> <b>Permanent @lang('employee.address') : </b> District: {{ $result->p_district ? $result->p_district : '' }}, City: {{ $result->p_city ? $result->p_city : '' }}, Address: {{ $result->p_address ? $result->p_address : '' }}</p>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-3">
									<p> <b>Joining Date :</b> {{$result->date_of_joining}}</p>
									<p>
									<p><b>KYC :</b> {{$result->kyc_doc}}</p>
									<p>
									<p> <b>KYC Doc :</b>
										<?php
										if ($result->kyc_file != '') {
										?>
											<a href="{!! asset('uploads/employeeKycDoc/'.$result->kyc_file) !!}" dounload target="_blank"> View</a>
										<?php  } ?>
									</p>
									<p>

									</p>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-4">
									<div class="applicant_pic text-right">
										<?php
										if ($result->photo != '') {
										?>
											<img style="width: 124px;height:135px" src="{!! asset('uploads/employeePhoto/'.$result->photo) !!}">
										<?php  } else { ?>
											<img style="width: 124px;height:135px" src="{!! asset('admin_assets/img/default.png') !!}">
										<?php } ?>
									</div>
									<br>
								</div>


								<div class="personal_info">
									<div class="row">
										<div class="col-xs-12">
											<div class="panel-custom">
												<h3 class="panel-title"><i class="fa fa-info-circle"></i> @lang('employee.personal_information')</h3>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="personal_info">
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Alter Phone</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->alter_phone}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Bank</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->bank}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Account no</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->acc_no}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">IFSC</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->ifc_code}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Branch</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->branch}}</div>
											</div>

											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Esic No</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->esic_no}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">UAN No</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->uan_no}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Nominee</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->nominee}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">BANK DETAILS OF ESIC/PF</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->esic_pf}}</div>
											</div>



											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Marital Status</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->marital_status}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Father Name</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->father_name}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Applying Date</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{dateConvertDBtoForm($result->created_at)}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">@lang('employee.date_of_birth')</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{dateConvertDBtoForm($result->dob)}}</div>
											</div>

											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">@lang('employee.gender')</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->gender}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Aadhar No</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->aadhar}}</div>
											</div>


											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Highest Qualification</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->highest_qualification}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Weight</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->weight}} KG</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Height</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->height}} FEET</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Experience</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->experience}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Employment Status</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->employment_status}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Post Applied</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->job->post ?? 'N/A'}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Salary</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->salary_expectations}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Other Post Applied</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->other_post_applied}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Time Preference</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->time_preference}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Remarks</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->remarks}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Filled By</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->filled_by}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Reference By</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$result->referd_by}}</div>
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