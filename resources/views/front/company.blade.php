@php
$front_setting = getFrontData();
@endphp
@extends('front.master')

@section('title')
{{ $front_setting->company_title }}
@endsection

@section('meta')

<meta name="og:title" content="{{ $front_setting->company_title }}" />
<meta name="og:image" content="{{ url('uploads/front/'.$front_setting->logo) }}" />
<meta name="og:url" content="{{ url('/') }}" />
<meta name="og:description" content="{{ $front_setting->about_us_description }}" />
<meta name="description" content="{{ $front_setting->about_us_description }}" />

@endsection

@section('content')

	<div class="pagehding-sec">
		<div class="pagehding-overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="page-heading">
						<h1>Company</h1>
						<ul>
							<li><a href="{{ url('/') }}">Home</a></li>
							<li><a href>Company</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    @if($errors->any())
						<div class="alert alert-danger alert-dismissible mb-20" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							@foreach($errors->all() as $error)
								<strong>{!! $error !!}</strong><br>
							@endforeach
                        </div>
                    @endif

                    @if(session()->has('success'))
						<div class="alert alert-success alert-dismissable  mb-20">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<i class="cr-icon glyphicon glyphicon-ok"></i>&nbsp;<strong>{{ session()->get('success') }}</strong>
						</div>
					@endif
					@if(session()->has('error'))
						<div class="alert alert-danger alert-dismissable  mb-20">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<strong>{{ session()->get('error') }}</strong>
						</div>
					@endif
					
                   

                    <div class="row pt-50">
                        <div class="col-lg-12">
                            <h4 class="text-dark mt-4">Apply for this Job:</h4>
                        </div>
                    </div>

                    <div class="row cForm">
                        <div class="col-lg-12">
                            <div class="condidateForm job-detail border rounded mt-2 p-4">
                            <form action="{{ route('career.application') }}" method="post" enctype="multipart/form-data">
                               {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">COMPANY NAME <span>*</span></label>
                                        <input name="cname" value="{{ old('cname') }}" type="text" class="form-control" placeholder="Company Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">TYPE OF INDUSTRY <span>*</span></label>
                                        <input name="industry_type" value="{{ old('industry_type') }}" type="text" class="form-control" placeholder="Type of industry">
                                        
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Address  <span>*</span></label>
                                        <input name="address" value="{{ old('address') }}" type="text" class="form-control" placeholder="Address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Email Id. <span>*</span></label>
                                        <input name="email" value="{{ old('email') }}" type="email" class="form-control" placeholder="Email Id.">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Mobile No. <span>*</span></label>
                                        <input name="phone" value="{{ old('phone') }}" type="number" min="0" class="form-control" placeholder="Mobile No.">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">GST <span>*</span></label>
                                        <input name="gst" value="{{ old('gst') }}" type="text" class="form-control" placeholder="GST">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">PAN</label>
                                        <input name="pan" value="{{ old('pan') }}" type="text" class="form-control" placeholder="PAN">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">OWNER NAME <span>*</span></label>
                                        <input name="owner_name" value="{{ old('owner_name') }}" type="text" class="form-control" placeholder="Owner Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">OWNER CONTACT NO <span>*</span></label>
                                        <input name="owner_no" value="{{ old('owner_no') }}" type="number" min="0" class="form-control" placeholder="Owner Contact No">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">CONATCT PERSON NAME <span>*</span></label>
                                        <input name="cnt_prsn_name" value="{{ old('cnt_prsn_name') }}" type="text" class="form-control" placeholder="Contact Person Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">COANTACT PERSON NO. <span>*</span></label>
                                        <input name="cnt_prsn_no" value="{{ old('cnt_prsn_no') }}" type="number" min="0" class="form-control" placeholder="Contact Person No">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">SITE ADDRES <span>*</span></label>
                                        <input name="site_addr" value="{{ old('site_addr') }}" type="text" class="form-control" placeholder="Site Address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">DATE OF SERVICE (SERVICE START DATE) <span>*</span></label>
                                        <input name="service_date" value="{{ old('service_date') }}" type="date" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="form-group picture">
                                        <label class="text-muted">SITE PHOTOGRAPH</label>
                                        <input name="site_photo1" type="file" class="form-control" placeholder="Site Photograph">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group picture">
                                        <label class="text-muted">SITE PHOTOGRAPH</label>
                                        <input name="site_photo2" type="file" class="form-control" placeholder="Site Photograph">
                                    </div>
                                </div>
                                <div class="single-input-fieldsbtn">
                                    <div class="col-lg-12">
                                        <input type="submit" id="submit"  class="mt-0" value="Apply">
                                    </div>
                                </div>
                            </div>
                        </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

 @endsection