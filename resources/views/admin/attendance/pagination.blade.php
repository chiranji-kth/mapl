<div class="table-responsive">
	@forelse($grouped as $companyName => $months)

	@foreach($months as $monthYear => $records)
	@php
	[$month, $year] = explode('-', $monthYear);
	$dateObj = DateTime::createFromFormat('!m', $month);
	@endphp

	<table class="table table-hover manage-u-table" id="example">
		<thead>
			<tr class="tr_header">
				<th>@lang('common.serial')</th>
				<th>Company</th>
				<th>Month</th>
				<th>EMP ID</th>
				<th>Name</th>
				<th>Gender</th>
				<th>Post</th>
				<th>Shift Timing</th>
				<th>Working Days</th>
			</tr>
		</thead>
		<tbody>
			@foreach($records as $index => $value)
			<tr>
				<td>{{ $index + 1 }}</td>
				<td>{{ $value->company->company_name ?? '-' }}</td>
				<td>
					@php
					$dateObj = DateTime::createFromFormat('!m', $value->month);
					echo $dateObj->format('F') . ', ' . $value->year;
					@endphp
				</td>
				<td>{{ $value->employee->employee_id ?? '-' }}</td>
				<td>{{ $value->employee->name ?? '-' }}</td>
				<td>{{ $value->employee->gender ?? '-' }}</td>
				<td>{{ $value->assignJob->job->post ?? '-' }}</td>
				<td>{{ $value->assignJob->shift_timing ?? '-' }} (hrs.)</td>
				<td>{{ $value->days_worked }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@endforeach
	@empty
	<div class="alert alert-warning text-center">
		@lang('common.no_data_available') !
	</div>
	@endforelse
</div>