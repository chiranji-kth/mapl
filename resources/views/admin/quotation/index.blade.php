@extends('admin.master')
@section('content')
@section('title')
@lang('Quotation List')
@endsection

<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<ol class="breadcrumb">
				<li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i> @lang('dashboard.dashboard')</a></li>
				<li>Quotation</li>
			</ol>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="{{ route('quotation.create') }}" class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Quotation </a>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-info">
				<div class="panel-heading"><i class="mdi mdi-table fa-fw"></i> Quotation</div>
				<div class="panel-wrapper collapse in" aria-expanded="true">
					<div class="panel-body">
						@if(session()->has('success'))
						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<i class="cr-icon glyphicon glyphicon-ok"></i>&nbsp;<strong>{{ session()->get('success') }}</strong>
						</div>
						@endif
						@if(session()->has('error'))
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<i class="glyphicon glyphicon-remove"></i>&nbsp;<strong>{{ session()->get('error') }}</strong>
						</div>
						@endif
						<div class="table-responsive">
							<table id="myTable" class="table table-bordered">
								<thead>
									<tr class="tr_header">
										<th>S/N</th>
										<th>Branch</th>
										<th>Quotation No</th>
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Total Amount</th>
										<th>Quotation Date</th>
										<th>Create Date</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									{!! $sl=null !!}
									@foreach($results AS $value)
									<tr class="{!! $value->lead_id !!}">
										<td style="width: 5px;">{!! ++$sl !!}</td>
										<td>{{ $value->branch_id == 1 ? 'MAPL' : 'AASTHA' }}</td>
										<td>@if($value->branch_id == 1)
											{{ date('Y') . '-' . date('y', strtotime('+1 year')) }}/{{ $quotation->quotation_no ?? $value->quotation_no }}
											@else
											{{ $quotation->quotation_no ?? $value->quotation_no }}
											@endif
										</td>
										<td style="text-transform:uppercase">{!! $value->name !!}</td>
										<td>{!! $value->email !!}</td>
										<td>{!! $value->contact !!}</td>
										<td>{!! $value->total_amount !!}</td>
										<td>{!! $value->qdate !!}</td>
										<td>{!! $value->created_at !!}</td>
										<td>
											@if ($value->status == 1)
											<a href="javascript:;" onclick="changeStatus({{ $value->id }}, 'Proceed')" data-target="#status-change" data-toggle="modal">
												<span class="label label-success">Final</span>
											</a>
											@else
											<a href="javascript:;" onclick="changeStatus({{ $value->id }}, 'Final')" data-target="#status-change" data-toggle="modal">
												<span class="label label-danger">Proceed</span>
											</a>
											@endif
										</td>
										<td style="width: 100px;">
											<a title="View" href="{{ route('quotation.show', $value->id) }}" class="btn btn-primary btn-xs btnColor">
												<i class="glyphicon glyphicon-th-large" aria-hidden="true"></i>
											</a>
											<a href="{!! route('quotation.edit',$value->id ) !!}" class="btn btn-success btn-xs btnColor">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											</a>
											<a href="{!!route('quotation.delete',$value->id  )!!}" data-token="{!! csrf_token() !!}" data-id="{!! $value->id !!}" class="delete btn btn-danger btn-xs deleteBtn btnColor"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="status-change" tabindex="-1">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="p-5 text-center mt-5">
					<div class="text-xl mt-5">
						<h2>Are You Sure?</h2>
					</div>
					<div class="text-slate-500 mt-2" style="padding-bottom: 20px;" id="active">
						<h5>You want change Status!</h5>
					</div>
				</div>
				<form action="{{ route('quotation.changestatus') }}" method="POST">
					{{ csrf_field() }}
					<input type="hidden" id="id" name="id">
					<input type="hidden" id="status" name="status">
					<div class="row">
						<div class="col-md-12">
							<label>Party Name <span class="validateRq">*</span></label>
							<div class="input-group col-md-12">
								<select class="form-control required" name="company_id" id="company_id" required>
									<option value="">-- Select Company --</option>

									@foreach($companys as $company)
									<option value="{{ $company->company_id }}"
										{{ (string) old('company_id', null) == (string) $company->company_id ? 'selected' : '' }}>
										{{ $company->company_name }}
									</option>
									@endforeach

									<option value="other" {{ old('company_id', null) === 'other' ? 'selected' : '' }}>Other</option>
								</select>

							</div>
						</div>
					</div><br />
					<div class="row">
						<center>
							<button type="submit" class="btn btn-primary" id="btnActive"></button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload();">Cancel</button>
						</center>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('page_scripts')
<script>
	$(function() {

		$('#updateStatus').on("change", function() {

			var status = $(this).parents('tr').find('.status').val();
			var customer_id = $(this).parents('tr').find('.customer_id').val();
			var action = "{{ URL::to('customer/updateStatus') }}";

			$.ajax({
				type: "get",
				url: action,
				data: {
					'customer_id': customer_id,
					'status': status,
					'_token': $('input[name=_token]').val()
				},
				success: function(data) {
					if (data == 'success') {
						$.toast({
							heading: 'success',
							text: 'Status successfully updated !',
							position: 'top-right',
							loaderBg: '#ff6849',
							icon: 'success',
							hideAfter: 3000,
							stack: 6
						});
					} else {
						$.toast({
							heading: 'Problem',
							text: 'Something error found !',
							position: 'top-right',
							loaderBg: '#ff6849',
							icon: 'error',
							hideAfter: 3000,
							stack: 6
						});
					}

				}
			});
		})

	});

	function changeStatus($orderId, $status) {
		$("#id").val($orderId);
		$("#status").val($status);
		$("#btnActive").html('Yes, ' + $status + ' it!');
		document.getElementById('active').innerHTML = "You want to " + $status;
	}
</script>

@endsection