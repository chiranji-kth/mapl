<div class="table-responsive">
	<table class="table table-hover manage-u-table" id="example">
		<thead>
			<tr class="tr_header">
				<th>@lang('common.serial')</th>
				<th>Month</th>
				<th>EMP ID</th>
				<th>Name</th>
				<th>Father Name</th>
				<th>Gender</th>
				<th>Post</th>
				<!-- <th>Shift</th> -->
				<th>Working Days</th>
				<th>Last Updated</th>
				<th>Advance</th>
				<th>Dress </th>
				<th>Other</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@php $serial = 1; @endphp
			@forelse($grouped as $companyName => $months)
			@foreach($months as $monthYear => $records)
			@foreach($records as $value)
			<tr data-id="{{ $value->id }}">
				<td>{{ $serial++ }}</td>
				<td>{{ \Carbon\Carbon::createFromDate($value->year, $value->month)->format('F, Y') }}</td>
				<td>{{ $value->employee->employee_id ?? '-' }}</td>
				<td>{{ $value->employee->name ?? '-' }}</td>
				<td>{{ $value->employee->father_name ?? '-' }}</td>
				<td>{{ $value->employee->gender ?? '-' }}</td>
				<td>{{ $value->employee->job->post ?? '-' }}</td>
				<!-- <td>{{ $value->assignJob->shift ?? '-' }}</td> -->
				<td>{{ $value->days_worked }}</td>
				<td>{{ $value->updated_at }}</td>
				<td><input type="number" class="advance" value="{{ $value->advance ?? 0 }}" style="width: 100px;" /></td>
				<td><input type="number" class="dress" value="{{ $value->dress_deduction ?? 0 }}" style="width: 100px;" /></td>
				<td><input type="number" class="other" value="{{ $value->other_deduction ?? 0 }}" style="width: 100px;" /></td>
				<td>
					<button type="button" class="btn btn-sm btn-success updateBtn">Update</button>
				</td>
			</tr>
			@endforeach
			@endforeach
			@empty
			<tr>
				<td colspan="13" class="text-center">@lang('common.no_data_available') !</td>
			</tr>
			@endforelse
		</tbody>
	</table>
</div>
@section('page_scripts')
<script>
	$(document).ready(function() {
		$('.updateBtn').on('click', function() {
			let row = $(this).closest('tr');
			let id = row.data('id');
			let advance = row.find('.advance').val();
			let dress = row.find('.dress').val();
			let other = row.find('.other').val();

			$.ajax({
				url: "{{ route('attendance.updateAmounts') }}",
				method: "POST",
				data: {
					_token: "{{ csrf_token() }}",
					id: id,
					advance: advance,
					dress: dress,
					other: other
				},
				success: function(response) {
					if (response.success) {
						alert('Updated successfully!');
						// Update Last Updated column
						row.find('td:nth-child(9)').text(response.updated_at);
					} else if (response.errors) {
						alert(JSON.stringify(response.errors));
					} else {
						alert('Update failed!');
					}
				},
				error: function(xhr) {
					alert('Something went wrong!');
				}
			});

		});
	});
</script>
@endsection