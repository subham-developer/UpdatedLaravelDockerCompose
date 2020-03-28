@extends('web_master')
@section('css')
<style type="text/css">
	.site-main .sideshow{
		background: url('uploads/d3fWjeyBR0eeghdWHWwkmsUaw9W40C0tDy46ffHu.jpeg');
		background-size: cover;
	}
	.padding-top {
		padding-top: 10px;
	}
</style>
@endsection
@section('body')

	<div class="sideshow">
	</div><!--sideshow -->

	<div class="container padding-top">
		<h1>Say Hello!</h1>
		<div class="breadcrumbs" style="display: inline-flex; margin-bottom: 25px;">
			<a href="{{ url('/') }}">Home</a><span>&nbsp;/&nbsp;</span> Contact Us
		</div><!-- .breadcrumbs -->
	</div>
		
		<div class="page-content contact-content">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 main-content">
						<div class="entry-content">
							<div class="row">
								<div class="col-lg-8">
									<div class="form-contact">
										<h2>Drop us a line</h2><br>
										@if(session('success'))
										<div class="alert alert-success">
											{{ session('success') }}
										</div>
										@endif

										@if (session('failed'))
											<div class="alert alert-danger">
												{{ session('failed') }}
											</div>
										@endif
										
										@if ($errors->any())
										<div class="alert alert-danger">
											<ul>
												@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
												@endforeach
											</ul>
										</div>
										@endif
										<form action='{{ route('enquiry') }}' method="post" id="contactForm" class="clearfix">
											{!! Form::open(['route'=>'enquiry','id'=>"contactForm", 'class'=>"clearfix"]) !!}
											@csrf
											<div class="clearfix">
												<div class="field align-left">
													{{-- <input type="text" value="" name="name" placeholder="Your Name" required /> --}}
													{!! Form::text('name', null, ['placeholder'=>"Your Name"]) !!}
												</div>
												<div class="field align-right">
													{{-- <input type="text" value="" name="email" placeholder="Your Email" required /> --}}
													{!! Form::email('email', null, ['placeholder'=>"Your Email"]) !!}
												</div>
											</div>
											{{-- <div class="field">
												<input type="text" value="" name="s" placeholder="Subject" />
											</div> --}}
											<div class="field-textarea">
												{{-- <textarea rows="8" name="message" placeholder="Message" required></textarea> --}}
												{!! Form::textarea('message', null, ['placeholder'=>"Your Message"]) !!}
											</div>

											@if(env('GOOGLE_RECAPTCHA_KEY'))
										    <div style ="margin-bottom:25px;">
										        <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
										    </div>										    
										    @endif											

										    <div style ="margin-bottom:25px;">
											<button type="submit" value="Send Messager" class="btn-primary">Submit Message</button>
											</div>
										</form>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="contact-info">
										<h3>Contact Infomation</h3>
										<br>
										<ul>
											<li><i class="fa fa-map-marker" aria-hidden="true"></i>41, 4th floor A-wing, Todi Industrial Estate Sun Mill compound Road, Lower Parel, Mumbai, Maharashtra 400013</li>
											<li><i class="fa fa-phone" aria-hidden="true"></i>+91 22 66395181 / 82</li>
											<li><i class="fa fa-mobile" aria-hidden="true"></i>08030636437 / +91 9819312721</li>
											<li><i class="fa fa-envelope-o" aria-hidden="true"></i>enquiry@nimapinfotech.com</li>
										</ul>
										{{-- <div class="contact-desc"><p>Lorem Ipsum is simply dummy text of the printing & typesetting industry. Lorem Ipsum has been scrambled it to make type specimen book.</p></div> --}}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div><!-- .container -->
				</div><!-- .page-content -->
				{{-- <div class="maps">
					<div id="map"></div>
					</div> --}}<!-- .maps -->
					<br>
					
					@endsection
					@section('bottom-script')
					<script src='https://www.google.com/recaptcha/api.js'></script>
					<script type="text/javascript">
						$('body').addClass('contact-us');
					</script>
					@endsection