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

<style>
    .flip-card-container {
        perspective: 1000px;
        width: 100%;
        max-width: 350px;
        height: 210px;
        margin: 30px auto;
    }

    .flip-card {
        width: 100%;
        height: 100%;
        position: relative;
        transform-style: preserve-3d;
        transition: transform 0.8s ease;
    }

    .flip-card-container:hover .flip-card {
        transform: rotateY(180deg);
    }

    .flip-card-side {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 20px;
        box-sizing: border-box;
    }

    .flip-card-front {
        background-color: #ffc926; /* dark maroon */
        color: #000000; /* white text for contrast */
    }

    .flip-card-back {
        background-color: #f9f9f9; /* light background for back */
        color: #333;
        transform: rotateY(180deg);
    }

    .flip-contact-info-text h2 {
        font-size: 18px;
        margin-bottom: 10px;
        color: inherit;
    }

    .flip-contact-info-text span {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
        color: inherit;
    }

    .flip-contact-info-text a {
        color: red; /* soft light link for dark bg */
        text-decoration: none;
    }

    .flip-card-front .flip-contact-info-text a:hover {
        text-decoration: underline;
    }

    /* Specific styling for the email link on the back side */
    .flip-card-back .flip-contact-info-text a {
        color: #000000; /* black color for email on back */
    }

    .flip-card-back .flip-contact-info-text a:hover {
        text-decoration: underline;
    }
</style>


	<div class="pagehding-sec">
		<div class="pagehding-overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="page-heading">
						<h1>Contact</h1>
						<ul>
							<li><a href="{{ url('/') }}">Home</a></li>
							<li><a href>Contact</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="contact-page-sec pt-100 pb-100">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="contact-field">
						<h2>Write Your Message</h2>
						<form action="#" method="post">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="single-input-field">
									<input placeholder="First Name" type="text" required />
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="single-input-field">
									<input placeholder="Last Name" type="text" required />
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="single-input-field">
									<input placeholder="Phone" type="text" required />
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="single-input-field">
									<input placeholder="Your E-mail" type="email" required />
								</div>
							</div>
							<div class="col-md-12 message-input">
								<div class="single-input-field">
									<textarea placeholder="Message" required ></textarea>
								</div>
							</div>
							<div class="single-input-fieldsbtn">
								<input value="send now " type="submit" name="submit">
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-4">
					<!--<div class="contact-info">-->
					<!--	<div class="contact-info-item">-->
					<!--		<div class="contact-info-text">-->
					<!--			<h2><i class="fa fa-phone-square" aria-hidden="true"></i> phone</h2>-->
					<!--			<span>+91-9314030299 , +91-7240600111</span>-->
					<!--			<span>+91-7240600222</span>-->
					<!--		</div>-->
					<!--	</div>-->
					<!--</div>-->
					<div class="flip-card-container">
  <div class="flip-card">
    <!-- Front Side -->
    <div class="flip-card-side flip-card-front">
      <div class="flip-contact-info-text">
        <h2><i class="fa fa-map-marker" aria-hidden="true"></i> Head Office</h2>
        <span>"Rajrani Tower", H1-6, IT Park, I.P. I.A., Rd. No.-4, Behind City Mall, Jhalawar Road, Kota-324005 (Raj.)</span>
        <span>Mob: +91-9313228428, 9314030299</span>
        <span>Email: <a href="mailto:maplbharat@gmail.com">maplbharat@gmail.com</a></span>
      </div>
    </div>

    <!-- Back Side -->
    <div class="flip-card-side flip-card-back">
      <div class="flip-contact-info-text">
        <h2><i class="fa fa-map-marker" aria-hidden="true"></i> Head Office</h2>
        <span>"Rajrani Tower", H1-6, IT Park, I.P. I.A., Rd. No.-4, Behind City Mall, Jhalawar Road, Kota-324005 (Raj.)</span>
        <span>Mob: +91-9313228428, 9314030299</span>
        <span>Email: <a href="mailto:maplbharat@gmail.com">maplbharat@gmail.com</a></span>
      </div>
    </div>
  </div>
</div>

					<div class="flip-card-container">
  <div class="flip-card">
    <!-- Front Side for Regional Office -->
    <div class="flip-card-side flip-card-front">
      <div class="flip-contact-info-text">
        <h2><i class="fa fa-map-marker" aria-hidden="true"></i> Regional office - Jaipur</h2>
        <span>"27-B, Udai Nagar, Near Mansarovar Metro Station, Piller No.-7, Gopalpura Bypass, Mansarover, Jaipur (Raj.)-302018</span>
        <span>Mob: +91-9251496121, 9313228428</span>
        <span>Email: <a href="mailto:connectmapl@gmail.com">connectmapl@gmail.com</a></span>
      </div>
    </div>

    <!-- Back Side for Regional Office -->
    <div class="flip-card-side flip-card-back">
      <div class="flip-contact-info-text">
        <h2><i class="fa fa-map-marker" aria-hidden="true"></i> Regional office - Jaipur</h2>
        <span>"27-B, Udai Nagar, Near Mansarovar Metro Station, Piller No.-7, Gopalpura Bypass, Mansarover, Jaipur (Raj.)-302018</span>
        <span>Mob: +91-9251496121, 9313228428</span>
        <span>Email: <a href="mailto:connectmapl@gmail.com">connectmapl@gmail.com</a></span>
      </div>
    </div>
  </div>
</div>
				</div>
			</div>
		</div>
	</div>

 @endsection