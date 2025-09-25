<div class="row mb-5">
    <!-- <div class="col-md-3">
            <label for="status_filter">Filter by Status</label>
            <select id="status_filter" class="form-control">
                <option value="">-- All Status --</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div> -->

    <div class="col-md-4">
        <label for="job_filter">Filter by Job</label>
        <select id="job_filter" class="form-control">
            <option value="">-- All Jobs --</option>
            @foreach($jobs as $job)
            <option value="{{ $job->job_id }}">{{ $job->post }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label for="state_filter">Filter by State</label>
        <select id="state_filter" class="form-control">
            <option value="">-- All States --</option>
            @foreach($states as $state)
            <option value="{{ $state->state_id }}">{{ $state->state_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label for="district_filter">Filter by District</label>
        <select id="district_filter" class="form-control">
            <option value="">-- All Districts --</option>
            <!-- districts will load dynamically -->
        </select>
    </div>

</div>
<div class="row mb-3">
    <div class="col-md-3">
        <label for="created_from">Created From</label>
        <input type="date" id="created_from" class="form-control">
    </div>
    <div class="col-md-3">
        <label for="created_to">Created To</label>
        <input type="date" id="created_to" class="form-control">
    </div>
    <div class="col-md-3">
        <label for="updated_from">Updated From</label>
        <input type="date" id="updated_from" class="form-control">
    </div>
    <div class="col-md-3">
        <label for="updated_to">Updated To</label>
        <input type="date" id="updated_to" class="form-control">
    </div>
</div>

<div class="mb-3">&nbsp;</div>
<div class="table-responsive">
    <table class="table table-hover manage-u-table" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>@lang('employee.photo')</th>
                <th>EMP ID</th>
                <th>Job</th>
                <th>Name</th>
                <th>Phone</th>
                <th>@lang('employee.date_of_joining')</th>
                <th>Created</th>
                <th>@lang('common.action')</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

</div>

@section('page_scripts')
<script>
    $(document).ready(function() {

        var table = $('#example').DataTable({
            ajax: {
                url: "{{ route('employees.index') }}",
                data: function(d) {
                    d.job_id = $('#job_filter').val();
                    d.state_id = $('#state_filter').val();
                    d.district_id = $('#district_filter').val();
                    d.created_from = $('#created_from').val();
                    d.created_to = $('#created_to').val();
                    d.updated_from = $('#updated_from').val();
                    d.updated_to = $('#updated_to').val();
                }
            },
            columns: [{
                    data: null,
                    render: (data, type, row, meta) => meta.row + 1

                }, // Serial
                {
                    data: 'photo',
                    orderable: false,
                    searchable: false,
                    render: data => data
                }, // Photo
                {
                    data: 'employee_id'
                }, // employee id
                {
                    data: 'job_post'
                }, // Job
                {
                    data: 'name'
                }, // Name
                {
                    data: 'phone'
                }, // Phone
                {
                    data: 'joining_date'
                }, // Joining date
                {
                    data: 'created_at'
                }, // Created
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false,
                    render: data => data
                } // Action
            ]
        });

        // Reload table on filter change
        $('#job_filter, #state_filter, #district_filter, #created_from, #created_to, #updated_from, #updated_to').change(function() {
            table.ajax.reload();
        });

        // Dynamic districts based on selected state
        // When state dropdown changes
        $('#state_filter').on('change', function() {
            var state_id = $(this).val();
            var $district = $('#district_filter');
            $district.html('<option value="">-- All Districts --</option>');

            if (state_id) {
                $.get("{{ url('get-districts') }}/" + state_id, function(data) {
                    $.each(data, function(i, district) {
                        $district.append('<option value="' + district.dist_id + '">' + district.name + '</option>');
                    });
                });
            }
        });

    });
</script>
@endsection