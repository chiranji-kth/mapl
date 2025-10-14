<div class="row mb-5">
    <div class="col-md-3">
        <label for="status_filter">Filter by Status</label>
        <select id="status_filter" class="form-control">
            <option value="">-- All Status --</option>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>

    <div class="col-md-3">
        <label for="branch_filter">Filter by Branch</label>
        <select id="branch_filter" class="form-control">
            <option value="">-- All Branches --</option>
            @foreach($branches as $branch)
            <option value="{{ $branch->branch_id }}">{{ $branch->branch_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label for="state_filter">Filter by State</label>
        <select id="state_filter" class="form-control select2">
            <option value="">-- All States --</option>
            @foreach($states as $state)
            <option value="{{ $state->state_id }}">{{ $state->state_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label for="district_filter">Filter by District</label>
        <select id="district_filter" class="form-control select2">
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
                <th>Photo</th>
                <th>Company</th>
                <th>Branch</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Owner</th>
                <th>Contact</th>
                <th>State</th>
                <th>District</th>
                <th>Created</th>
                <th>Status</th>
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
                url: "{{ route('company.index') }}",
                data: function(d) {
                    d.status = $('#status_filter').val();
                    d.branch_id = $('#branch_filter').val();
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
                },
                {
                    data: 'photo',
                    orderable: false,
                    searchable: false,
                    render: data => data
                },
                {
                    data: 'company_name'
                },
                {
                    data: 'branch_name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'phone'
                },
                {
                    data: 'owner_name',
                    render: (data, type, row) => data + '<br>Phone: ' + row.owner_phone
                },
                {
                    data: 'contact_person_name',
                    render: (data, type, row) => data + '<br>Phone: ' + row.contact_person_phone
                },
                {
                    data: 'state_name'
                },
                {
                    data: 'district_name'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'status',
                    orderable: false,
                    searchable: false,
                    render: data => data
                },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false,
                    render: data => data
                }
            ]
        });

        // Reload table on filter change
        $('#status_filter, #branch_filter, #state_filter, #district_filter, #created_from, #created_to, #updated_from, #updated_to').change(function() {
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