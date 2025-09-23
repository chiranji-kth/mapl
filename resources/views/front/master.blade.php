<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

	<title>@yield('title', 'Home Page')</title>
	@yield('meta')
	
	<link rel="icon" type="image/png" href="{{ url('front-assets/img/favicon.png') }}">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700|Open+Sans:400,600" rel="stylesheet">
	<link rel="stylesheet" href="{{ url('front-assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ url('front-assets/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ url('front-assets/css/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ url('front-assets/css/magnific-popup.css') }}">
	<link rel="stylesheet" href="{{ url('front-assets/css/animate.css') }}">
	<link rel="stylesheet" href="{{ url('front-assets/css/main.css') }}">
	<link rel="stylesheet" href="{{ url('front-assets/css/meanmenu.min.css') }}">
	<link rel="stylesheet" href="{{ url('front-assets/css/responsive.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	
</head>

<body>	
<!--<div id="preloader">-->
<!--	<div id="preloader-status"></div>-->
<!--</div>-->
<header>
	<div class="hd-style1">
		<div class="hd-sec">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-sm-8">
						<div class="hd-lft">
							<ul>
								<li><i class="fa fa-comment-o"></i> 24x7 live Support</li>
								<li><i class="fa fa-phone"></i> <a class="mob" href="tel:9314030299">+91-9314030299</a></li>
								<li><i class="fa fa-phone"></i> <a class="mob" href="tel:7230842299">+91-7240600111</a></li>
								<!--<li><i class="fa fa-comment"></i>Live Chat</li>-->
							</ul>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="hd-rgt">
							<span class="follow-title">Follow Us</span>
							<ul>
								<li><a href="https://www.facebook.com/people/Mind-Assessors/pfbid02q76qjKMgKsHCS1VUKqrZpSwQb7p4pGqMDjUDdiZjfmSkYRfKCMdMd86hHs1HBo4Cl/" target="blank_"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://www.instagram.com/mapl.security/" target="blank_"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="https://www.maplbharat.com/" target="blank_"><i class="fa fa-globe"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="mnmenu-sec">
			<div class="container">
				<div class="row">
					<div class="col-md-12 nav-menu">
						<div class="col-md-3">
							<div class="logo">
								<a href="{{ url('/') }}"><img src="{{ url('front-assets/img/logo.png') }}" alt /></a>
							</div>
						</div>
						<div class="col-md-9">
							<div class="menu">
								<nav id="main-menu" class="main-menu">
									<ul>
										<li><a href="{{ url('/') }}">Home</a></li>
										<li><a href="{{ url('/about') }}">About</a></li>
										<li><a href="{{ url('/gallery') }}">Gallery</a></li>
										<li><a href="{{ url('/services') }}">Service</a></li>
										<li><a href="#">Govt. Approval </a></li>
										<li><a href="{{ url('/career') }}">Job Search</a></li>
										<!--<li><a href="{{ url('/company') }}">Company</a></li>-->
										<li><a href="{{ url('/contact') }}">Contact Us</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

@yield('content');


<footer>
<div class="footer-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="footer-wedget-one">
                    <a href="{{ url('/') }}"><img src="{{ url('front-assets/img/logo.png') }}" alt /></a>
                    <p>MAPL Security Services is PSAR Act registered, ensuring compliance with high-security standards. Our security audit identifies and corrects loopholes, optimizing security budgets for companies, retail, and educational institutions.</p>
                    <div class="footer-social-profile">
                        <ul>
                            <li><a href="https://www.facebook.com/people/Mind-Assessors/pfbid02q76qjKMgKsHCS1VUKqrZpSwQb7p4pGqMDjUDdiZjfmSkYRfKCMdMd86hHs1HBo4Cl/" target="blank_"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://www.instagram.com/mapl.security/" target="blank_"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="https://www.maplbharat.com/" target="blank_"><i class="fa fa-globe"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="footer-widget-menu">
                    <h2>Service links</h2>
                    <ul>
                        <li><a href="javascript:void()">Office Security</a></li>
                        <li><a href="javascript:void()">CCTV Security</a></li>
                        <li><a href="javascript:void()">House Security</a></li>
                        <li><a href="javascript:void()">Bank Security</a></li>
                        <li><a href="javascript:void()">Parking Security </a></li>
                        <li><a href="javascript:void()">Man Security</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="footer-widget-menu">
                    <h2>Support links</h2>
                    <ul>
                        <li><a href="javascript:void()">support link</a></li>
                        <li><a href="javascript:void()">faq & help center</a></li>
                        <li><a href="javascript:void()">about us</a></li>
                        <li><a href="javascript:void()">Create Account</a></li>
                        <li><a href="javascript:void()">service and help</a></li>
                        <li><a href="javascript:void()">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="footer-wedget-four">
                    <h2>contact us </h2>
                    <div class="inner-box">
                        <div class="media">
                            <div class="inner-item">
                                <div class="media-left">
                                    <span class="icon"><i class="fa fa-map-marker"></i></span>
                                </div>
                                <div class="media-body">
                                    <span style="font-size: 16px; font-weight: bold;">Head Office</span><br/>
                                    <span class="inner-text">Mind Assessors Pvt. Ltd. <br>"Rajrani Tower", H1-6, IT Park, I.P.I.A., Road No.-4, Behind City Mall, jhalawar Road, Kota -324005 (Raj.)</span>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="inner-item">
                                <div class="media-left">
                                    <span class="icon"><i class="fa fa-envelope-o"></i></span>
                                </div>
                                <div class="media-body">
                                    <span class="inner-text"><a href="email:maplbharat@gmail.com" class="__cf_email__">maplbharat@gmail.com</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="inner-item">
                                <div class="media-left">
                                    <span class="icon"><i class="fa fa-phone"></i></span>
                                </div>
                                <div class="media-body">
                                    <span class="inner-text">+91-7240600111, +91-7240600222</span>
                                    <span class="inner-text">+91-9314030299</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="footer-bottom-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="copy-right">
                    <p>Copyright © <script>document.write(new Date().getFullYear())</script> Security Guard. All Rights Reserved by
                        <a href="https://kriscent.in/" target="_blank">
                            <b>Kriscent Techno Hub Pvt. Ltd</b>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

</footer>

<script src="{{ url('front-assets/js/jquery-2.2.4.min.js') }}"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="{{ url('front-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ url('front-assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ url('front-assets/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ url('front-assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ url('front-assets/js/owl.animate.js') }}"></script>
<script src="{{ url('front-assets/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ url('front-assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ url('front-assets/js/modernizr.min.js') }}"></script>
<script src="{{ url('front-assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ url('front-assets/js/wow.min.js') }}"></script>
<script src="{{ url('front-assets/js/waypoints.min.js') }}"></script>
<script src="{{ url('front-assets/js/jquery.meanmenu.min.js') }}"></script>
<script src="{{ url('front-assets/js/jquery.sticky.js') }}"></script>
<script src="{{ url('front-assets/js/custom.js') }}"></script>

@yield('custom-section')

</body>

</html>
