<div class="row mb-3">
    <div class="col-md-3">
        <label for="status_filter">Filter by Status</label>
        <select id="status_filter" class="form-control">
            <option value="">-- All Status --</option>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover manage-u-table" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Company</th>
                <th>Branch</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Owner</th>
                <th>Contact</th>
                <th>Created</th>
                <th>Status</th>
                <th>@lang('common.action')</th>
            </tr>
        </thead>
        <tbody>
            {!! $sl = null !!}
            @foreach ($results as $value)
            <tr class="{!! $value->employee_id !!}">
                <td style="width: 100px;">{!! ++$sl !!}</td>
                <td>
                    @if ($value->site_photo_1 != '' && file_exists('uploads/companyPhoto/' . $value->site_photo_1))
                    <a href="{!! route('employees.show', $value->emp_id) !!}"><img style=" width: 70px; " src="{!! asset('uploads/companyPhoto/' . $value->site_photo_1) !!}"
                            alt="user-img" class="img-circle"></a>
                    @else
                    <a href="{!! route('employees.show', $value->emp_id) !!}"> <img style=" width: 70px; " src="{!! asset('admin_assets/img/default.png') !!}"
                            alt="user-img" class="img-circle"></a>
                    @endif
                </td>
                <td>
                    <span class="font-medium">
                        {{ $value->company_name }}
                    </span>
                    <br /><span class="text-muted">Industry :
                        {{$value->industry}}
                    </span>
                </td>
                <td>
                    <span class="font-medium">
                        {{$value->branch->branch_name ?? ' '}}
                    </span>
                </td>
                <td>
                    <span class="font-medium">
                        {{$value->email}}
                    </span>
                </td>
                <td>
                    <span class="font-medium">
                        {{ $value->phone }}
                    </span>

                </td>
                <td>
                    <span class="font-medium">
                        {{ $value->owner_name }}
                    </span>
                    <br /><span class="text-muted">Phone :
                        {{$value->owner_phone}}
                    </span>
                </td>
                <td>
                    <span class="font-medium">
                        {{ $value->contact_person_name }}
                    </span>
                    <br /><span class="text-muted">Phone :
                        {{$value->contact_person_phone}}
                    </span>
                </td>
                <td>
                    <span class="font-medium">
                        {{ $value->created_at }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('company.toggleStatus', $value->company_id) }}" class="btn btn-xs {{ $value->status == 1 ? 'btn-success' : 'btn-danger' }}">
                        {{ $value->status == 1 ? 'Active' : 'Inactive' }}
                    </a>
                </td>

                <td style="width: 150px">
                    <a title="Profile" href="{!! route('company.show', $value->company_id) !!}" class="btn btn-primary btn-xs btnColor">
                        <i class="glyphicon glyphicon-th-large" aria-hidden="true"></i>
                    </a>
                    <a href="{!! route('company.edit', $value->company_id) !!}" class="btn btn-success btn-xs btnColor">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <a href="{!! route('company.delete', $value->company_id) !!}" data-token="{!! csrf_token() !!}"
                        data-id="{!! $value->company_id !!}"
                        class="delete btn btn-danger btn-xs deleteBtn btnColor"><i class="fa fa-trash-o"
                            aria-hidden="true"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>