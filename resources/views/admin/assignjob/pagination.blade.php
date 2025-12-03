<div class="table-responsive">
	<table class="table table-hover manage-u-table" id="example">
		<thead>
			<tr class="tr_header">
				<th>@lang('common.serial')</th>
				<th>Emp ID</th>
				<th>Name</th>
				<th>Company</th>
				<th>Job Role</th>
				<th>Salary (Month)</th>
				<th>Shift</th>
				<th>Working(hrs)</th>
				<th>Status</th>
				<th style="text-align: center;">@lang('common.action')</th>
			</tr>
		</thead>
		<tbody>
			{!! $sl=null !!}
			@foreach($results as $value)
			<tr class="{!! $value->promotion_id !!}">
				<td style="width: 100px;">{!! ++$sl !!}</td>
				<td>
					{{ $value->employees->employee_id ?? 'N/A' }}
				</td>
				<td>
					{{ $value->employees->name ?? 'N/A' }}
				</td>
				<td>
					{{ $value->company->company_name ?? 'N/A' }}
				</td>
				<td>
					{{ $value->employees->job->post }}
				</td>
				<td>
					{{ $value->salary ?? 'N/A' }}
				</td>
				<td>
					{{ $value->shift }}
				</td>
				<td>
					{{ $value->shift_timing }}
				</td>
				<td>
					@if ($value->status == 1)
					<a href="javascript:;" onclick="changeStatus({{ $value->job_id }}, 'Terminated')" data-target="#status-change" data-toggle="modal">
						<span class="label label-success">@lang('common.active')</span>
					</a>
					@else
					<a href="javascript:;" onclick="changeStatus({{ $value->job_id }}, 'Active')" data-target="#status-change" data-toggle="modal">
						<span class="label label-danger">@lang('common.terminated')</span>
					</a>
					@endif
				</td>
				<td style="width: 100px;">
					<a href="{!! route('assignJob.edit',$value->job_id) !!}" class="btn btn-success btn-xs btnColor">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</a>
					<a href="{!!route('assignJob.delete',$value->job_id )!!}" data-token="{!! csrf_token() !!}" data-id="{!! $value->job_id !!}" class="delete btn btn-danger btn-xs deleteBtn btnColor"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</div>