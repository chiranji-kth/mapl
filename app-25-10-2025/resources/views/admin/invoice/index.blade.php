@extends('admin.master')
@section('content')
@section('title')
@lang('Invoice List')
@endsection

<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<ol class="breadcrumb">
				<li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i> @lang('dashboard.dashboard')</a></li>
				<li>Invoice</li>
			</ol>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="{{ route('invoice.create') }}" class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Invoice </a>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-info">
				<div class="panel-heading"><i class="mdi mdi-table fa-fw"></i> Invoice</div>
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
										<th>Invoice</th>
										<th>Company Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Total Amount</th>
										<th>Invoice Date</th>
										<th>Create Date</th>
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
                                                {{ date('Y') . '-' . date('y', strtotime('+1 year')) }}/{{ $invoice->invoice_id ?? $value->invoice_id }}
                                            @else
                                                {{ $invoice->invoice_id ?? $value->invoice_id }}
                                            @endif
                                        </td>
										<td style="text-transform:uppercase">{!! $value->name !!}</td>
										<td>{!! $value->email !!}</td>
										<td>{!! $value->contact !!}</td>
										<td>{!! $value->total_amount + $value->service_charge + $value->labour_surcharge !!}</td>
										<td>{!! $value->qdate !!}</td>
										<td>{!! $value->created_at !!}</td>
										<!-- <td>
											<select id="updateStatus" class="form-control status">
												<option value="0" <?= $value->status == 0 ? 'selected' : '' ?>>Inactive</option>
												<option value="1" <?= $value->status == 1 ? 'selected' : '' ?>>Active</option>
											</select>
											<input type="hidden" class="customer_id" value="{{$value->customer_id}}">
										</td> -->
										<td style="width: 100px;">
											<a title="View" href="{{ route('invoice.show', $value->id) }}" class="btn btn-primary btn-xs btnColor">
												<i class="glyphicon glyphicon-th-large" aria-hidden="true"></i>
											</a>
											<a href="{!! route('invoice.edit',$value->id ) !!}" class="btn btn-success btn-xs btnColor">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											</a>
											<a href="{!!route('invoice.delete',$value->id  )!!}" data-token="{!! csrf_token() !!}" data-id="{!! $value->id !!}" class="delete btn btn-danger btn-xs deleteBtn btnColor"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
</script>

@endsection