<div class="table-responsive">
    <table class="table table-hover manage-u-table" id="example">
        <thead>
		    <tr class="tr_header">
                <th>@lang('common.serial')</th>
                <th>Employee</th>
                <th>Company</th>
                <th>Wages (Per day)</th>
                <th>Deduction</th>
                <th>From Date</th>
                <th>To Date</th>
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
					    {{ $value->employees->name }}
					</td>
					<td>
					    {{ $value->company->company_name }}
					</td>
					<td>
						{{ $value->perday_wages }}
					</td>
					<td>
						{{ $value->deduction }}				
					</td>
					<td>
						{{ $value->from_date }}					
					</td>
					<td>
						{{ $value->to_date }}					
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
						<a href="{!! route('assignJob.edit',$value->job_id) !!}"  class="btn btn-success btn-xs btnColor">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
						</a>
						<a href="{!!route('assignJob.delete',$value->job_id )!!}" data-token="{!! csrf_token() !!}" data-id="{!! $value->job_id !!}" class="delete btn btn-danger btn-xs deleteBtn btnColor"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
					</td>
				</tr>
			@endforeach
		</tbody>
    </table>

</div>
