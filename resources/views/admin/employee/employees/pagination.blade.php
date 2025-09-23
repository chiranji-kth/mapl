<div class="table-responsive">
    <table class="table table-hover manage-u-table"  id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>@lang('employee.photo')</th>
                <th>Job</th>
                <th>Name</th>
                <th>Phone</th>
                <th>@lang('employee.date_of_joining')</th>
                <th>Created</th>
                <th>@lang('common.action')</th>
            </tr>
        </thead>
        <tbody>
            {!! $sl = null !!}
            @foreach ($results as $value)
                <tr class="{!! $value->employee_id !!}">
                    <td style="width: 100px;">{!! ++$sl !!}</td>
                    <td>
                        @if ($value->photo != '' && file_exists('uploads/employeePhoto/' . $value->photo))
                            <a href="{!! route('employees.show', $value->employee_id) !!}"><img style=" width: 70px; " src="{!! asset('uploads/employeePhoto/' . $value->photo) !!}"
                                    alt="user-img" class="img-circle"></a>
                        @else
                            <a href="{!! route('employees.show', $value->employee_id) !!}"> <img style=" width: 70px; " src="{!! asset('admin_assets/img/default.png') !!}"
                                    alt="user-img" class="img-circle"></a>
                        @endif
                    </td>
                    <td>
                        <span class="font-medium">
                            {{ $value->post_applied }}
                        </span>
                        <br /><span class="text-muted">Exp : 
                            {{$value->experience ? $value->experience : 'None'}}
                        </span>
                    </td>
                    <td>
                        <span class="font-medium">
                            {{ $value->name }}
                        </span>
                        <br /><span class="text-muted">Email:
                            {{ $value->email }} 
                        </span>
                    </td>
                    <td>
                        <span class="font-medium">
                            {{ $value->phone }}
                        </span>
                        <br /><span class="text-muted">Gender:
                            {{ $value->gender }} 
                        </span>
                    </td>
                    <td>
                        <span class="font-medium">
                            {{ dateConvertDBtoForm($value->date_of_joining) }}
                        </span>
                    </td>
                    <td>
                        <span class="font-medium">
                            {{ $value->created_at }}
                        </span>
                    </td>
                    <!--<td>-->
                    <!--    @if ($value->status == 1)-->
                    <!--        <span class="label label-success">@lang('common.active')</span>-->
                    <!--        </span>-->
                    <!--    @elseif($value->status == 2)-->
                    <!--        <span class="label label-warning">@lang('common.inactive')</span>-->
                    <!--    @else-->
                    <!--        <span class="label label-danger">@lang('common.terminated')</span>-->
                    <!--    @endif-->
                    <!--</td>-->

                    <td style="width: 150px">
                        <a title="Profile" href="{!! route('employees.show', $value->emp_id) !!}" class="btn btn-primary btn-xs btnColor">
                            <i class="glyphicon glyphicon-th-large" aria-hidden="true"></i>
                        </a>
                        <a href="{!! route('employees.edit', $value->emp_id) !!}" class="btn btn-success btn-xs btnColor">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <a href="{!! route('employees.delete', $value->emp_id) !!}" data-token="{!! csrf_token() !!}"
                            data-id="{!! $value->emp_id !!}"
                            class="delete btn btn-danger btn-xs deleteBtn btnColor"><i class="fa fa-trash-o"
                                aria-hidden="true"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
