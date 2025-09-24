<div class="table-responsive">
    <table class="table table-hover manage-u-table" id="example">
        <thead>
            <tr>
                <th>@lang('common.serial')</th>
                <th>Job</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Father</th>
                <th>DOB</th>
                <th>Employment</th>
                <th>Apply</th>
                <th>@lang('common.action')</th>
            </tr>
        </thead>
        <tbody>
            {!! $sl = null !!}
            @if (count($results) > 0)
            @foreach ($results as $value)
            <tr class="{!! $value->job_id !!}">
                <td style="width: 70px;">{!! ++$sl !!}</td>
                <td>{{ $value->job->post ?? 'N/A' }}
                    <br /><span class="text-muted">
                        Exp: {{ $value->experience ? \Illuminate\Support\Str::limit($value->experience, 10, '...') : 'None' }}
                    </span>
                </td>
                <td>
                    {{ $value->name }}
                    <br /><span class="text-muted">Email:
                        {{ $value->email }} </span>
                </td>
                <td>
                    {{ $value->phone }}
                    <br /><span class="text-muted">Gender:
                        {{ $value->gender }} </span>
                </td>
                <td>
                    {{ $value->father_name }}
                </td>
                <td>
                    {{ date('d/m/Y', strtotime($value->dob)) }}
                    <br /><span class="text-muted">Aadhar:
                        {{ $value->aadhar }} </span>
                </td>
                <td>
                    {{ $value->employment_status }}
                </td>
                <td>
                    {{ date('d M Y', strtotime($value->created_at)) }}
                </td>
                <td style="width: 100px;">
                    <a href="{!! route('employees.makeemployee', $value->career_applicant_id) !!}"
                        class="btn btn-success btn-xs btnColor">
                        Make a Employee
                    </a>
                    <a title="View"
                        href="{{ route('careerJob.show', $value->career_applicant_id) }}"
                        class="btn btn-primary btn-xs btnColor">
                        <i class="glyphicon glyphicon-th-large" aria-hidden="true"></i>
                    </a>
                    <a href="{!! route('careerJob.delete', $value->career_applicant_id) !!}"
                        data-token="{!! csrf_token() !!}"
                        data-id="{!! $value->career_applicant_id !!}"
                        class="delete btn btn-danger btn-xs deleteBtn btnColor"><i
                            class="fa fa-trash-o" aria-hidden="true"></i>
                    </a>
                    <a href="{!! route('careerJob.edit', $value->career_applicant_id) !!}" class="btn btn-success btn-xs btnColor">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6">@lang('common.no_data_available')</td>
            </tr>
            @endif
        </tbody>
    </table>

</div>