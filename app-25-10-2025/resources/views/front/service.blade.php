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
						<h1>Our Service</h1>
						<ul>
							<li><a href="{{ url('/') }}">Home</a></li>
							<li><a href>Our Service</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="service-sec pt-100 pb-100">
		<div class="container">
			<div class="row">
				<div class="service-item">
					<div class="col-md-4 col-sm-6">
						<div class="service-inner">
							<div class="service-img" style="background-image: url( {{ url('front-assets/img/g1.jpg') }}); background-size: cover; background-position: center center;">
							</div>
							<div class="service-details">
								<h2>Security Officer </h2>
								<!--<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>-->
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service-inner">
							<div class="service-img" style="background-image: url({{ url('front-assets/img/g2.jpg') }}); background-size: cover; background-position: center center;">
							</div>
							<div class="service-details">
								<h2>Security Supervisor </h2>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service-inner">
							<div class="service-img" style="background-image: url({{ url('front-assets/img/g3.jpg') }}); background-size: cover; background-position: center center;">
							</div>
							<div class="service-details">
								<h2>Lady Security Guard </h2>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service-inner">
							<div class="service-img" style="background-image: url({{ url('front-assets/img/g4.jpg') }}); background-size: cover; background-position: center center;">
							</div>
							<div class="service-details">
								<h2>Security Guard</h2>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service-inner">
							<div class="service-img" style="background-image: url({{ url('front-assets/img/g5.jpg') }}); background-size: cover; background-position: center center;">
							</div>
							<div class="service-details">
								<h2>Bouncer</h2>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service-inner">
							<div class="service-img" style="background-image: url({{ url('front-assets/img/g6.jpg') }}); background-size: cover; background-position: center center;">
							</div>
							<div class="service-details">
								<h2>Gun Man </h2>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service-inner">
							<div class="service-img" style="background-image: url( {{ url('front-assets/img/g1.jpg') }}); background-size: cover; background-position: center center;">
							</div>
							<div class="service-details">
								<h2>Head Guard </h2>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service-inner">
							<div class="service-img" style="background-image: url({{ url('front-assets/img/g2.jpg') }}); background-size: cover; background-position: center center;">
							</div>
							<div class="service-details">
								<h2>Manpower Supply </h2>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service-inner">
							<div class="service-img" style="background-image: url({{ url('front-assets/img/g3.jpg') }}); background-size: cover; background-position: center center;">
							</div>
							<div class="service-details">
								<h2>House Keeping </h2>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service-inner">
							<div class="service-img" style="background-image: url({{ url('front-assets/img/g4.jpg') }}); background-size: cover; background-position: center center;">
							</div>
							<div class="service-details">
								<h2>Labour Supply</h2>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service-inner">
							<div class="service-img" style="background-image: url({{ url('front-assets/img/g5.jpg') }}); background-size: cover; background-position: center center;">
							</div>
							<div class="service-details">
								<h2>ATM Security</h2>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service-inner">
							<div class="service-img" style="background-image: url({{ url('front-assets/img/g6.jpg') }}); background-size: cover; background-position: center center;">
							</div>
							<div class="service-details">
								<h2>Mall Security Guard </h2>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service-inner">
							<div class="service-img" style="background-image: url({{ url('front-assets/img/g6.jpg') }}); background-size: cover; background-position: center center;">
							</div>
							<div class="service-details">
								<h2>Office Security Guard</h2>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service-inner">
							<div class="service-img" style="background-image: url({{ url('front-assets/img/g6.jpg') }}); background-size: cover; background-position: center center;">
							</div>
							<div class="service-details">
								<h2>Club & Party Security Guard</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

 @endsection