@extends('admin.master')
@section('content')
@section('title')
Attendance
@endsection
<style>
	.table>tbody>tr>td {
		padding: 5px 7px;
	}

	.address {
		margin-top: 22px;
	}

	.employeeName {
		position: relative;
	}

	#employee_id-error {
		position: absolute;
		top: 66px;
		left: 0;
		width: 100%he;
		width: 100%;
		height: 100%;
	}

	.icon-question {
		color: #7460ee;
		font-size: 16px;
		vertical-align: text-bottom;
	}
</style>
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
			<ol class="breadcrumb">
				<li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i> @lang('dashboard.dashboard')</a></li>
				<li>@yield('title')</li>

			</ol>
		</div>
		<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
			<a href="{{route('attendance.index')}}" class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">
				<i class="fa fa-list-ul" aria-hidden="true"></i> View Attendance</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-info">
				<div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i> @yield('title')</div>
				<div class="panel-wrapper collapse in" aria-expanded="true">
					<div class="panel-body">
						@if($errors->any())
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							@foreach($errors->all() as $error)
							<strong>{!! $error !!}</strong><br>
							@endforeach
						</div>
						@endif
						@if(session()->has('success'))
						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<i class="cr-icon glyphicon glyphicon-ok"></i>&nbsp;<strong>{{ session()->get('success') }}</strong>
						</div>
						@endif
						@if(session()->has('error'))
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							&nbsp;<strong>{{ session()->get('error') }}</strong>
						</div>
						@endif
						{{ Form::open(['route' => 'attendance.store', 'method' => 'POST', 'id' => 'attendanceForm']) }}
						<div class="form-body">
							<div class="row">
								<div class="col-md-4">
									<label>Company <span class="validateRq">*</span></label>
									{{ Form::select('company_id', $companyList, null, ['class' => 'form-control select2', 'id' => 'company_id']) }}
								</div>

								<div class="col-md-3">
									<label>Month <span class="validateRq">*</span></label>
									<input type="text" name="month" id="month" class="form-control monthFieldOnly" placeholder="MM">
								</div>

								<div class="col-md-3">
									<label>Year <span class="validateRq">*</span></label>
									<input type="text" name="year" id="year" class="form-control yearField" placeholder="YYYY">
								</div>

								<div class="col-md-2">
									<button type="button" id="loadEmployees" class="btn btn-info" style="margin-top: 24px">Load Employees</button>
								</div>
							</div>
						</div>

						<div class="table-responsive" style="margin-top:20px;">
							<table class="table table-bordered" id="employeeTable" style="display:none;">
								<thead>
									<tr>
										<th><input type="checkbox" id="select_all"></th>
										<th>Emp. ID</th>
										<th>Name</th>
										<th>Gender</th>
										<th>Post</th>
										<th>Shift Timing (hrs.)</th>
										<th>Days Worked</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>

						<button type="submit" class="btn btn-success" id="submitAttendance" style="display:none;">Submit Attendance</button>
						{{ Form::close() }}

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('page_scripts')
<script>
	$(document).ready(function() {
		$('#loadEmployees').on('click', function() {
			let companyId = $('#company_id').val();
			let month = $('#month').val();
			let year = $('#year').val();

			if (!companyId || !month || !year) {
				alert('Please select Company, Month & Year');
				return;
			}

			$.ajax({
				url: "{{ route('attendance.getEmployees') }}",
				method: "POST",
				data: {
					company_id: companyId,
					month: month,
					year: year,
					_token: "{{ csrf_token() }}"
				},
				success: function(data) {
					let tbody = $('#employeeTable tbody');
					tbody.empty();

					if (data.length > 0) {
						$.each(data, function(i, emp) {
							tbody.append(`
                            <tr>
                                <td><input type="checkbox" name="selected[]" value="${emp.emp_id}" class="select_emp"></td>
                                <td>${emp.employee_id}</td>
                                <td>${emp.name}</td>
                                <td>${emp.gender}</td>
                                <td>${emp.post}</td>
								<td>${emp.shift_timing}</td>
                                <td>
									<input type="number" name="days[${emp.emp_id}]" class="form-control" min="0" max="31">
									<input type="hidden" name="assign_job_id[${emp.emp_id}]" value="${emp.job_id}">
								</td>

                            </tr>
                        `);
						});

						$('#employeeTable').show();
						$('#submitAttendance').show();
					} else {
						$('#employeeTable').hide();
						$('#submitAttendance').hide();
						alert('No active employees found for this company.');
					}
				},
				error: function() {
					alert('Error loading employees!');
				}
			});
		});

		// Select All checkbox
		$(document).on('change', '#select_all', function() {
			$('.select_emp').prop('checked', this.checked);
		});
	});
</script>
@endsection