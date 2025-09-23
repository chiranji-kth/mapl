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
						<h1>MAPL Gallery</h1>
						<ul>
							<li><a href="{{ url('/') }}">Home</a></li>
							<li><a href>MAPL Gallery</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="project-sec pt-100 pb-70">
		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-sm-4 col-md-3">
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
				<div class="col-xs-6 col-sm-4 col-md-3">
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
				<div class="col-xs-6 col-sm-4 col-md-3">
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
				<div class="col-xs-6 col-sm-4 col-md-3">
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
				<div class="col-xs-6 col-sm-4 col-md-3">
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
				<div class="col-xs-6 col-sm-4 col-md-3">
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
				<div class="col-xs-6 col-sm-4 col-md-3">
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
				<div class="col-xs-6 col-sm-4 col-md-3">
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


 @endsection