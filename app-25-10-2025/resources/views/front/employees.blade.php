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
						<h1>Our Employees</h1>
						<ul>
							<li><a href="{{ url('/') }}">Home</a></li>
							<li><a href>Our Employees</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="team-sec pt-100 pb-70">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="team-member">
						<div class="team-thumb">
							<img src="{{ url('front-assets/img/tm.jpg') }}" alt />
							<div class="team-overlay">
								<ul>
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fa fa-google"></i></a></li>
									<li><a href="#"><i class="fa fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
						<h2>Adalberto</h2>
						<h3>Office Security</h3>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="team-member">
						<div class="team-thumb">
							<img src="{{ url('front-assets/img/tm2.jpg') }}" alt />
							<div class="team-overlay">
								<ul>
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fa fa-google"></i></a></li>
									<li><a href="#"><i class="fa fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
						<h2>Alejandro</h2>
						<h3>House Security</h3>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="team-member">
						<div class="team-thumb">
							<img src="{{ url('front-assets/img/tm3.jpg') }}" alt />
							<div class="team-overlay">
								<ul>
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fa fa-google"></i></a></li>
									<li><a href="#"><i class="fa fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
						<h2>Ambrose</h2>
						<h3>Bank Security</h3>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="team-member">
						<div class="team-thumb">
							<img src="{{ url('front-assets/img/tm4.jpg') }}" alt />
							<div class="team-overlay">
								<ul>
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fa fa-google"></i></a></li>
									<li><a href="#"><i class="fa fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
						<h2>Arnoldo</h2>
						<h3>Parking Security </h3>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="team-member">
						<div class="team-thumb">
							<img src="{{ url('front-assets/img/tm.jpg') }}" alt />
							<div class="team-overlay">
								<ul>
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fa fa-google"></i></a></li>
									<li><a href="#"><i class="fa fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
						<h2>Adalberto</h2>
						<h3>Office Security</h3>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="team-member">
						<div class="team-thumb">
							<img src="{{ url('front-assets/img/tm2.jpg') }}" alt />
							<div class="team-overlay">
								<ul>
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fa fa-google"></i></a></li>
									<li><a href="#"><i class="fa fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
						<h2>Alejandro</h2>
						<h3>House Security</h3>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="team-member">
						<div class="team-thumb">
							<img src="{{ url('front-assets/img/tm3.jpg') }}" alt />
							<div class="team-overlay">
								<ul>
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fa fa-google"></i></a></li>
									<li><a href="#"><i class="fa fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
						<h2>Ambrose</h2>
						<h3>Bank Security</h3>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="team-member">
						<div class="team-thumb">
							<img src="{{ url('front-assets/img/tm4.jpg') }}" alt />
							<div class="team-overlay">
								<ul>
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fa fa-google"></i></a></li>
									<li><a href="#"><i class="fa fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
						<h2>Arnoldo</h2>
						<h3>Parking Security </h3>
					</div>
				</div>
			</div>
		</div>
	</div>


 @endsection