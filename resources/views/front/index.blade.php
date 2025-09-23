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

	<div class="slider index2">
		<div class="all-slide owl-item">
			<div class="single-slide">
			    <img src="front-assets/img/slide0.1.webp" alt="images" />
			</div>
			<div class="single-slide">
			    <img src="front-assets/img/slide0.2.webp" alt="images" />
			</div>
			<div class="single-slide">
			    <img src="front-assets/img/slide1.png" alt="images" />
			</div>
			<div class="single-slide">
				<img src="front-assets/img/slide2.png" alt="images" />
			</div>
			<div class="single-slide">
				<img src="front-assets/img/slide3.png" alt="images" />
			</div>
			<div class="single-slide">
				<img src="front-assets/img/slide4.png" alt="images" />
			</div>
			<div class="single-slide">
				<img src="front-assets/img/slide5.png" alt="images" />
			</div>
			<div class="single-slide">
				<img src="front-assets/img/slide6.png" alt="images" />
			</div>
			<div class="single-slide">
				<img src="front-assets/img/slide7.png" alt="images" />
			</div>
			<div class="single-slide">
				<img src="front-assets/img/slide8.png" alt="images" />
			</div>
			<div class="single-slide">
				<img src="front-assets/img/slide9.png" alt="images" />
			</div>
			<div class="single-slide">
				<img src="front-assets/img/slide10.png" alt="images" />
			</div>
			<div class="single-slide">
				<img src="front-assets/img/slide11.png" alt="images" />
			</div>
			<div class="single-slide">
				<img src="front-assets/img/slide12.png" alt="images" />
			</div>
		</div>
	</div>

	<div class="about-sec pt-100 pb-100">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<div class="about-desc">
						<div class="sec-title">
							<h1><span>About </span>Our Company</h1>
							<div class="about_block">
							    <div class="sp mb-3">REGISTRATION UNDER PSAR ACT (Private Security Agencies Act 2016)</div>
							    <p class="mb-3">MAPL Security Services is registered under PSAR Act. In fact, MAPL is one of the few Security Guard Agencies in Rajasthan & Delhi that are registered under the Private Security Agencies Act 2005.</p>
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
			</div>
		</div>
	</div>

	<div class="service2-sec pt-100 pb-100">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="sec-title">
						<h1>We Provide Following <span>Security</span> Services</h1>
						<p>MAPL Security Services is an acclaimed firm of security & Manpower Services with a reputation of providing effective security solutions in the protection of life and property.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="service2-item">
					<div class="col-md-4 col-sm-6">
						<div class="service2-inner">
							<div class="media">
								<div class="media-body">
									<div class="service2-details">
										<h2><a href="javascript:void()">Security Officer</a></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service2-inner">
							<div class="media">
								<div class="media-body">
									<div class="service2-details">
										<h2><a href="javascript:void()">Security Supervisor </a></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service2-inner">
							<div class="media">
								<div class="media-body">
									<div class="service2-details">
										<h2><a href="javascript:void()">Lady Security Guard </a></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service2-inner">
							<div class="media">
								<div class="media-body">
									<div class="service2-details">
										<h2><a href="javascript:void()">Security Guard</a></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service2-inner">
							<div class="media">
								<div class="media-body">
									<div class="service2-details">
										<h2><a href="javascript:void()">Bouncer </a></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service2-inner">
							<div class="media">
								<div class="media-body">
									<div class="service2-details">
										<h2><a href="javascript:void()">Gun Man</a></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service2-inner">
							<div class="media">
								<div class="media-body">
									<div class="service2-details">
										<h2><a href="javascript:void()">Head Guard  </a></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service2-inner">
							<div class="media">
								<div class="media-body">
									<div class="service2-details">
										<h2><a href="javascript:void()">Manpower Supply </a></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service2-inner">
							<div class="media">
								<div class="media-body">
									<div class="service2-details">
										<h2><a href="javascript:void()">House Keeping </a></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service2-inner">
							<div class="media">
								<div class="media-body">
									<div class="service2-details">
										<h2><a href="javascript:void()">Labour Supply</a></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service2-inner">
							<div class="media">
								<div class="media-body">
									<div class="service2-details">
										<h2><a href="javascript:void()">ATM Security</a></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service2-inner">
							<div class="media">
								<div class="media-body">
									<div class="service2-details">
										<h2><a href="javascript:void()">Mall Security Guard</a></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service2-inner">
							<div class="media">
								<div class="media-body">
									<div class="service2-details">
										<h2><a href="javascript:void()">Office Security Guard</a></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service2-inner">
							<div class="media">
								<div class="media-body">
									<div class="service2-details">
										<h2><a href="javascript:void()">Club & Party Security Guard</a></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="project-sec pt-100 pb-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="sec-title">
						<h1><span>Our Gallery </span>Photo</h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-3 col-lg-3 col-md-4 col-sm-4 col-md-4">
					<div class="item">
						<div class="project-thumb">
							<img src="{{ url('front-assets/img/gallery/g1.jpg') }}" alt />
						</div>
						<div class="project-hoverlay">
							<div class="project-text">
								<a href="{{ url('front-assets/img/gallery/g1.jpg') }}" class="gallery-photo"><i class="fa fa-expand"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-lg-3 col-md-4 col-sm-4 col-md-4">
					<div class="item">
						<div class="project-thumb">
							<img src="{{ url('front-assets/img/gallery/g2.jpg') }}" alt />
						</div>
						<div class="project-hoverlay">
							<div class="project-text">
								<a href="{{ url('front-assets/img/gallery/g2.jpg') }}" class="gallery-photo"><i class="fa fa-expand"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-lg-3 col-md-4 col-sm-4 col-md-4">
					<div class="item">
						<div class="project-thumb">
							<img src="{{ url('front-assets/img/gallery/g3.jpg') }}" alt />
						</div>
						<div class="project-hoverlay">
							<div class="project-text">
								<a href="{{ url('front-assets/img/gallery/g3.jpg') }}" class="gallery-photo"><i class="fa fa-expand"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-lg-3 col-md-4 col-sm-4 col-md-4">
					<div class="item">
						<div class="project-thumb">
							<img src="{{ url('front-assets/img/gallery/g4.jpg') }}" alt />
						</div>
						<div class="project-hoverlay">
							<div class="project-text">
								<a href="{{ url('front-assets/img/gallery/g4.jpg') }}" class="gallery-photo"><i class="fa fa-expand"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-lg-3 col-md-4 col-sm-4 col-md-4">
					<div class="item">
						<div class="project-thumb">
							<img src="{{ url('front-assets/img/gallery/g5.jpg') }}" alt />
						</div>
						<div class="project-hoverlay">
							<div class="project-text">
								<a href="{{ url('front-assets/img/gallery/g5.jpg') }}" class="gallery-photo"><i class="fa fa-expand"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-lg-3 col-md-4 col-sm-4 col-md-4">
					<div class="item">
						<div class="project-thumb">
							<img src="{{ url('front-assets/img/gallery/g6.jpg') }}" alt />
						</div>
						<div class="project-hoverlay">
							<div class="project-text">
								<a href="{{ url('front-assets/img/gallery/g6.jpg') }}" class="gallery-photo"><i class="fa fa-expand"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-lg-3 col-md-4 col-sm-4 col-md-4">
					<div class="item">
						<div class="project-thumb">
							<img src="{{ url('front-assets/img/gallery/g7.jpg') }}" alt />
						</div>
						<div class="project-hoverlay">
							<div class="project-text">
								<a href="{{ url('front-assets/img/gallery/g7.jpg') }}" class="gallery-photo"><i class="fa fa-expand"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-lg-3 col-md-4 col-sm-4 col-md-4">
					<div class="item">
						<div class="project-thumb">
							<img src="{{ url('front-assets/img/gallery/g8.jpg') }}" alt />
						</div>
						<div class="project-hoverlay">
							<div class="project-text">
								<a href="{{ url('front-assets/img/gallery/g8.jpg') }}" class="gallery-photo"><i class="fa fa-expand"></i></a>
							</div>
						</div>
					</div>
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

	<div class="appoitment-area">
		<div class="images-overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="faq-sec">
						<div class="faq-single">
							<div class="media">
								<div class="media-left">
									<div class="icon">
										<img src="{{ url('front-assets/img/icon/question.png') }}" alt />
									</div>
								</div>
								<div class="media-body">
									<h2>Can I help 24/7</h2>
									<p>Lorem ipsum dolor sit amet, luctus posuere semper felis consectetuer hendrerit, enim varius enim, tellus tincidunt tellus est sed mattis, libero elit mi suscipit.</p>
								</div>
							</div>
						</div>
						<div class="faq-single">
							<div class="media">
								<div class="media-left">
									<div class="icon">
										<img src="{{ url('front-assets/img/icon/question.png') }}" alt />
									</div>
								</div>
								<div class="media-body">
									<h2>Can I refund payment</h2>
									<p>Lorem ipsum dolor sit amet, luctus posuere semper felis consectetuer hendrerit, enim varius enim, tellus tincidunt tellus est sed mattis, libero elit mi suscipit.</p>
								</div>
							</div>
						</div>
						<div class="faq-single">
							<div class="media">
								<div class="media-left">
									<div class="icon">
										<img src="{{ url('front-assets/img/icon/question.png') }}" alt />
									</div>
								</div>
								<div class="media-body">
									<h2>How many year's exprience</h2>
									<p>Lorem ipsum dolor sit amet, luctus posuere semper felis consectetuer hendrerit, enim varius enim, tellus tincidunt tellus est sed mattis, libero elit mi suscipit.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="appointment-form">
						<h2>Get A Quote</h2>
						<form action="#!" method="post">
							<fieldset>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="sngl-field">
										<input placeholder="Name" name="name" type="text" />
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="sngl-field">
										<input placeholder="E-mail" name="email" type="email" required />
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="sngl-field">
										<input placeholder="Phone" name="phone" type="text" />
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="sngl-field">
										<input placeholder="Time" name="time" type="text" />
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="sngl-field">
										<input placeholder="Date" name="date" type="text" />
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="sngl-field">
										<div class="select-arrow">
											<select name="location">
												<option selected disabled hidden>Type of location</option>
												<option value="Albania">Albania</option>
												<option value="Algeria">Algeria</option>
												<option value="Andorra">Andorra</option>
												<option value="Argentina">Argentina</option>
												<option value="Australia">Australia</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="sngl-field">
										<textarea placeholder="Message" name="message"></textarea>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="filed-submitbtn">
										<input value="Submit Message" name="submit" type="submit" />
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- popup start --
    <div id="bkgOverlay" class="backgroundOverlay"></div>
    <div id="delayedPopup" class="delayedPopupWindow">
        <a href="#" id="btnClose" title="Click here to close this deal box.">x</a>
        <img src="{{ url('front-assets/img/popup/mapl-krishna-janmashtami.webp') }}" class="rounded" style="width: 100%; height: 100%;" />
    </div>
    <!-- popup end -->
    
 @endsection