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
						<h1>About Page</h1>
						<ul>
							<li><a href="{{ url('/') }}">Home</a></li>
							<li><a href>About Us</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="about-sec pt-100 pb-100">
		<div class="about-sec-overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<div class="about-desc">
						<div class="sec-title">
							<h1><span>About </span>Our Company</h1>
							<div class="about_block">
							    <div class="sp mb-3">REGISTRATION UNDER PSAR ACT (Private Security Agencies Act 2016)</div>
							    <p>MAPL Security Services is registered under PSAR Act. In fact, MAPL is one of the few Security Guard Agencies in Rajasthan & Delhi that are registered under the Private Security Agencies Act 2005.</p>
							</div>     
							<div class="about_block">
							    <div class="sp mb-3">SECURITY AUDIT (that establish high-security standards and offers clients cost efficiency in their security budget).</div>
							    <p>In India lot of companies, business units’ retail and educational institutions are either under guarded (less number of guards) or employ more than required numbers of guards. Sometimes some intuitions are even guarded by less experienced and trained guards. With MAPL excellent security audit and planning such security loopholes are completely removed PLUS the audit also makes sure that the company spends optimized security budget.</p>
							</div>
						</div>
						
					</div>
				</div>
				<div class="col-md-5">
					<div class="about-us-img">
						<img src="{{ url('front-assets/img/about.jpg') }}" alt />
					</div>
				</div>
				<div class="col-md-12">
				    <p class="mb-3">MAPL Company Established in the year 2016. MAPL Security Services has provided security solutions to the Corporate as well as individuals. Today Company’s name is synonymous with the highest perfection coupled with stellar efficiency in providing surveillance & security to large Establishments both in Public & Private Sectors.</p>
					<p>Our endeavour is to provide efficient yet cost effective solutions to all the security related requirements of the Clients through carefully selected, medically fit, highly trained & proactive guarding personnel who are impeccably uniformed, suitably equipped & supervised closely. Our manpower is responsible to create a safe & secure environment by ruthlessly guarding assets, property & preventing fire accidents, thereby contributing to the growth & prosperity of our Clients.</p>
				</div>
			</div>
		</div>
	</div>


	<div class="testimonial-sec pt-100 pb-100">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="testimonial-text">
						<span class="tst-sbtitle">What's say about our client</span>
						<div class="sec-title">
							<h1><span>Client</span> Review</h1>
						</div>
						<p>Lorem ipsum dolor sit amet, luctus posuere semper felis consectetuer hendrerit, enim varius enim, tellus tincidunt tellus est sed enim varius enim, tellus tincidunt tellus est sed </p>
						<!-- <a href="#">See All</a> -->
					</div>
				</div>
				<div class="col-md-8 no-padding">
					<div class="all-testimonial2">
						<div class="single-testimonial2">
							<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec ac nec.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec ac nec.</p>
							<div class="testimonial2">
								<div class="inner">
									<div class="client-info">
										<h2>David Max</h2>
										<h3>Ceo & Founder</h3>
									</div>
								</div>
								<div class="inner">
									<div class="testimonial2-client-img">
										<img src="{{ url('front-assets/img/testimonial1.jpg') }}" alt />
									</div>
								</div>
							</div>
						</div>
						<div class="single-testimonial2">
							<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec ac nec.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec ac nec.</p>
							<div class="testimonial2">
								<div class="inner">
									<div class="client-info">
										<h2>David Max</h2>
										<h3>Ceo & Founder</h3>
									</div>
								</div>
								<div class="inner">
									<div class="testimonial2-client-img">
										<img src="{{ url('front-assets/img/testimonial2.jpg') }}" alt />
									</div>
								</div>
							</div>
						</div>
						<div class="single-testimonial2">
							<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec ac nec.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec ac nec.</p>
							<div class="testimonial2">
								<div class="inner">
									<div class="client-info">
										<h2>David Max</h2>
										<h3>Ceo & Founder</h3>
									</div>
								</div>
								<div class="inner">
									<div class="testimonial2-client-img">
										<img src="{{ url('front-assets/img/testimonial3.jpg') }}" alt />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="team-sec pt-100 pb-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="sec-title">
						<h1><span>Our Expert </span>Employees</h1>
						<p>Lorem ipsum dolor sit amet, pellentesque enim lorem quis vivamus amet.</p>
					</div>
				</div>
			</div>
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
			</div>
		</div>
	</div>


	<div class="all-patner-sec">
		<div class="container">
			<div class="row">
				<div class="all-patner">
					<div class="single-patner">
						<img src="{{ url('front-assets/img/patner1.png') }}" alt />
					</div>
					<div class="single-patner">
						<img src="{{ url('front-assets/img/patner2.png') }}" alt />
					</div>
					<div class="single-patner">
						<img src="{{ url('front-assets/img/patner3.png') }}" alt />
					</div>
					<div class="single-patner">
						<img src="{{ url('front-assets/img/patner4.png') }}" alt />
					</div>
					<div class="single-patner">
						<img src="{{ url('front-assets/img/patner3.png') }}" alt />
					</div>
					<div class="single-patner">
						<img src="{{ url('front-assets/img/patner2.png') }}" alt />
					</div>
				</div>
			</div>
		</div>
	</div>
	
 @endsection