<div class="table-responsive">
    <table class="table table-hover manage-u-table" id="example">
		<thead>
			 <tr class="tr_header">
				<th>@lang('common.serial')</th>
				<th>@lang('common.month')</th>
				<th>Name</th>
				<th>Salary</th>
				<th>Working Days</th>
				<th>Wages Per Day</th>
				<th>Basic</th>
				<th>Emp Share</th>
				<th>Employer Share</th>
				<th>Advance</th>
				<th>Dress Deduction</th>
				<th>Allowance</th>
				<th>Salary</th>
			</tr>
		</thead>
		<tbody>
			@if(count($results)>0)
				{!! $sl=null !!}
				@foreach($results AS $value)
					<tr>
						<td style="width: 100px;">{!! ++$sl !!}</td>
						<td>
							@php
								$month = $value->month;
								$dateObj   = DateTime::createFromFormat('!m', $month);
								$monthName = $dateObj->format('F');
								$year = $value->year;

								$monthAndYearName = $monthName." ".$year ;
								echo $monthAndYearName;
						   @endphp
						</td>
						<td>
						    {!! $value->employees->name !!}
						    <br>
								<span class="text-muted">Email : {{$value->employees->email }}</span>
								<br>
								<span class="text-muted">Post : {{$value->employees->post_applied }}</span>
						</td>
						<td>{!! $value->salary !!}</td>
						<td>{!! $value->working_days !!}</td>
						<td>{!! $value->per_day !!}</td>
						<td>{!! $value->basic !!}</td>
						<td>{{ $value->emp_pf + $value->emp_esi }}</td>
						<td>{{ $value->empr_pf + $value->empr_esi }}</td>
						<td>{!! $value->advance !!}</td>
						<td>{!! $value->dress !!}</td>
						<td>{!! $value->allowance !!}</td>
						<td>{!! $value->totalSalary !!}</td>
						
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="6">@lang('common.no_data_available') !</td>
				</tr>
			@endif
		</tbody>
	</table>


</div>
