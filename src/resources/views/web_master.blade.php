<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>One INR</title>
	<meta http-equiv="cache-control" content="no-cache" />
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/ionicons.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.theme.default.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.theme.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.transitions.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/carousel.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.bxslider.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/magicsuggest-min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/quill.bubble.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/quill.core.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/quill.snow.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    
    <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155080358-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-155080358-2');
</script>

	<link href="{{ asset('css/admin/sweetalert.css') }}" rel="stylesheet"/>
    <style type="text/css">
    	input::-webkit-calendar-picker-indicator {
		  display: none;
		}
    </style>

    {{-- @import url(libs/wow/css/animate.css);
@import url(libs/font-awesome/css/font-awesome.min.css);
@import url(libs/bootstrap/css/bootstrap.min.css);
@import url(libs/ionicons/css/ionicons.min.css);
@import url(libs/owl-carousel/assets/owl.carousel.css);
@import url(libs/owl-carousel/assets/owl.theme.default.css);
@import url(libs/owl-carousel/assets/owl.theme.min.css);
@import url(libs/owl-carousel/assets/owl.transitions.min.css);
@import url(libs/owl-carousel/assets/carousel.min.css);
@import url(libs/bxslider/jquery.bxslider.min.css);
@import url(libs/magicsuggest/magicsuggest-min.css);
@import url(libs/quilljs/css/quill.bubble.css);
@import url(libs/quilljs/css/quill.core.css);
@import url(libs/quilljs/css/quill.snow.css); --}}
    <link rel="icon" href="{{ asset('images/one-inr_old.png') }}" type="image/x-icon"/>
    @yield('css')
</head>

<body>
	<div id="wrapper">
		<header id="header" class="site-header">
			<div class="container">
				<div class="site-brand">
					<a href="{{ url('/') }}"><img src="{{ asset('images/one-inr.png') }}" alt="" style="width: 160px"></a>
				</div><!-- .site-brand -->
				<div class="right-header">					
					<nav class="main-menu">
						<button class="c-hamburger c-hamburger--htx"><span></span></button>
						<ul>
							<li>
								<a href="{{ url('/') }}">Home<i class="fa fa-caret-down" aria-hidden="true"></i></a>
								{{-- <ul class="sub-menu">
									<li><a href="index.html">Home v1</a></li>
									<li><a href="index_2.html">Home v2</a></li>
									<li><a href="index_3.html">Home v3</a></li>
									<li><a href="index_gradient.html">Home Gradient</a></li>
								</ul> --}}
							</li>
							<li>
								<a href="{{ url('about-us') }}">About Us<i class="fa fa-caret-down" aria-hidden="true"></i></a>
							</li>
							<li>
								<a href="{{ url('projects') }}">Campaigns<i class="fa fa-caret-down" aria-hidden="true"></i></a>
								{{-- <ul class="sub-menu">
									<li><a href="explore_layout_one.html">Explore Layout One</a></li>
									<li><a href="explore_layout_two.html">Explore Layout Two</a></li>
									<li><a href="explore_layout_three.html">Explore Layout Three</a></li>
								</ul> --}}
							</li>
							{{-- <li>
								<a href="#">Start a Campaigns<i class="fa fa-caret-down" aria-hidden="true"></i></a>
								<ul class="sub-menu">
									<li><a href="create_a_campaign.html">Create a campaign</a></li>
									<li><a href="update_a_campaign.html">Update a campaign</a></li>
								</ul>
							</li> --}}
							{{-- <li>
								<a href="#">Pages<i class="fa fa-caret-down" aria-hidden="true"></i></a>
								<ul class="sub-menu">
									<li><a href="coming_soon.html">Coming Soon</a></li>
									<li><a href="about_us.html">About Us</a></li>
									<li><a href="404.html">404</a></li>
									<li><a href="login.html">Login</a></li>
									<li><a href="register.html">Register</a></li>
									<li><a href="faq.html">Faq</a></li>
									<li><a href="campaign_detail.html">Campaign details</a></li>
								</ul>
							</li> --}}
							{{-- <li>
								<a href="#">Blog<i class="fa fa-caret-down" aria-hidden="true"></i></a>
								<ul class="sub-menu">
									<li><a href="blog_grid.html">Blog Grid</a></li>
									<li><a href="blog_list.html">Blog List</a></li>
									<li><a href="blog_list_sidebar.html">Blog Grid Sidebar</a></li>
									<li><a href="blog_details.html">Blog Details</a></li>
								</ul>
							</li> --}}
							{{-- <li>
								<a href="#">Shop<i class="fa fa-caret-down" aria-hidden="true"></i></a>
								<ul class="sub-menu">
									<li><a href="shop-grid.html">Shop Grid</a></li>
									<li><a href="shop-details.html">Shop Details</a></li>
									<li><a href="cart.html">Cart</a></li>
									<li><a href="checkout.html">Checkout</a></li>
								</ul>
							</li> --}}
							<li><a href="{{ url('contact') }}">Contact</a></li>
							@auth

							<li>
								<a href="#">{{ Auth::user()->name }}
									<i class="fa fa-caret-down" aria-hidden="true"></i></a>
								<ul class="sub-menu">
									{{-- <li><a href="dashboard.html">Dashboard</a></li> --}}
									<li><a href="{{ url('profile') }}">Account</a></li>
									{{-- <li><a href="account_my_campaigns.html">My Campaigns</a></li>
									<li><a href="account_pledges_received.html">Pledges Received</a></li>
									<li><a href="account_backed_campaigns.html">Backed Campaigns</a></li>
									<li><a href="account_rewards.html">Rewards</a></li> --}}
									<li>
										{!! Form::open(['route'=>'logout','id'=>'logout']) !!}
										{!! Form::close() !!}
										<a href="{{ route('logout') }}" 
										onclick="event.preventDefault();
                                                     $('#logout').submit();">Logout</a>
									</li>
								</ul>
							</li>
							@endauth
						</ul>
					</nav><!-- .main-menu -->
					<div class="search-icon" id="searchEl">
						<a href="#" id="searchIco" class="ion-ios-search-strong" onclick="vm.search=''"></a>
						<div class="form-search"></div>
						<form action="{{ url('projects/result') }}" id="searchForm" style="top:20%; max-width: 450px;">
					  		<input id="searchInput" list="hints" type="text" name="search" placeholder="Search..." v-model='search' {{-- onkeyup="vm.hint()" --}} />
						  <datalist id="hints">
						    <option v-bind:value="hint" v-for="hint in hints">
						  </datalist>
					  		{{-- <p>@{{search}}</p>
					  		<p v-for="hint in hints">@{{hint}}</p> --}}
					  		{{-- @{{ hints }} --}}
					  		{{-- <input name="search" list="hints" name="browser" placeholder="Search..." maxlength="50" v-model="search">
							  <datalist id="hints">
							    <option v-bind:value="hint" v-for="hint in hints">
							    
							  </datalist>
					  		
					    	<button type="submit" value="" style="height: 60px;"><span class="ion-ios-search-strong"></span></button> --}}
				
					  	</form>
					  	
					{{-- <form action="/action_page.php" method="get">
  <input list="browsers" name="search" style="border:1px solid red; width:400px;">
  <datalist id="browsers">
    <option value="Internet Explorer">
    <option value="Firefox">
    <option value="Chrome">
    <option value="Opera">
    <option value="Safari">
  </datalist>
  <input type="submit">
</form> --}}

					</div>	

					@guest
					<div class="login login-button">
						<a href="{{ url('login') }}" class="btn-primary">Login</a>
					</div>
					@endguest
					<!-- .login -->
				</div><!--. right-header -->
			</div><!-- .container -->
		</header><!-- .site-header -->

		<main id="main" class="site-main">
			@yield('body')
		</main><!-- .site-main -->

		<footer id="footer" class="site-footer">
			<div class="footer-menu">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-sm-4 col-4">
							<div class="footer-menu-item">
								<h3>Our company</h3>
								<ul>
									{{-- <li><a href="#">What is Startup Idea</a></li> --}}
									<li><a href="{{ url('/about-us') }}">About us</a></li>
									<li><a href="{{ url('/how-it-works') }}">How It Works</a></li>
									<li><a href="{{ url('/what-is-this') }}">What Is This</a></li>
									<li><a href="{{ url('/contact') }}">Contact Us</a></li>
									{{-- <li><a href="#">Jobs</a></li>
									<li><a href="#">Press</a></li>
									<li><a href="#">Starts</a></li> --}}
								</ul>
							</div>
						</div>
						<div class="col-lg-4 col-sm-4 col-4">
							<div class="footer-menu-item">
								<h3>Campaign</h3>
								<ul>
									<li><a href="{{ url('/start-your-campaign') }}	">Start Your Campaign</a></li>
									{{-- <li><a href="#">Pricing Campaign</a></li> --}}
									<!-- <li><a href="{{ url('/campaign-support') }}">Campaign Support</a></li>
									<li><a href="{{ url('/trust-and-safety') }}">Trust &amp; Safety</a></li>
									<li><a href="{{ url('/support') }}">Support</a></li> -->
									<li><a href="{{ url('/projects') }}">Donate to a cause</a></li>
									<li><a href="{{ url('/terms-of-use') }}">Terms of Use</a></li>
									<li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
								</ul>
							</div>
						</div>
						{{-- <div class="col-lg-4 col-sm-4 col-4">
							<div class="footer-menu-item">
								<h3>Explore</h3>
								<ul>
									<li><a href="#">Design &amp; Art</a></li>
									<li><a href="#">Crafts</a></li>
									<li><a href="#">Film &amp; Video</a></li>
									<li><a href="#">Food</a></li>
									<li><a href="#">Book</a></li>
									<li><a href="#">Games</a></li>
									<li><a href="#">Technology</a></li>
								</ul>
							</div>
						</div> --}}
						<div class="col-lg-3 col-sm-12 col-12">
							<div class="footer-menu-item newsletter">
								<h3>Newsletter</h3>
<!-- 								<div class="newsletter-description">Private, secure, spam-free</div>
 -->							<form action="{{url('subscibed')}}" method="POST" id="newsletterForm">


							  		<input type="email" value="" name="email" placeholder="Enter your email..." />
							  		@csrf
							    	<button type="submit" value=""><span class="ion-android-drafts"></span></button>
							  	</form>

							  	<!-- <div class="follow">
							  		<h3>Follow us</h3>
							  		<ul>
							  			<li class="facebook"><a target="_Blank" href="http://www.facebook.com"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							  			<li class="twitter"><a target="_Blank" href="http://www.twitter.com"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							  			<li class="instagram"><a target="_Blank" href="http://www.instagram.com"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							  			<li class="google"><a target="_Blank" href="http://www.google.com"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
							  			<li class="youtube"><a target="_Blank" href="http://www.youtube.com"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
							  		</ul>
							  	</div> -->
							</div>
						</div>
					{{-- <div class="footer-top">
						<p class="payment-img"><img src="images/assets/payment-methods.png" alt=""></p>
						<div class="footer-top-right">
						  	<div class="dropdow field-select">
						  		<select name="s">
						  			<option value="">$ US Dollar (USD)</option>
						  			<option value="">£ Pound Sterling (GBP)</option>
						  			<option value="">€ Euro (EUR)</option>
						  		</select>
						  	</div>
						  	<div class="dropdow field-select">
						  		<select name="s">
						  			<option value="">English</option>
						  			<option value="">Greek (Ελληνικά)</option>
						  			<option value="">Deutsch (German)</option>
						  			<option value="">العربية (Arabic)</option>
						  		</select>
						  	</div>
						</div>
					</div> --}}
				</div>
			</div>
			</div>

			<!-- .footer-menu -->
			<div class="footer-copyright">
				<div class="container">
					<p class="copyright">2018 by One INR. All Rights Reserved.</p>
					<a href="#" class="back-top">Back to top<span class="ion-android-arrow-up"></span></a>
				</div>
			</div>
		</footer><!-- site-footer -->
	</div><!-- #wrapper -->
	<!-- jQuery -->    
    <script src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/jquery.bxslider.min.js') }}"></script>
    <script src="{{ asset('js/magicsuggest-min.js') }}"></script>
    <script src="{{ asset('js/quill.core.js') }}"></script>
    <script src="{{ asset('js/quill.js') }}"></script>
    <!-- orther script -->
    <script src="{{ asset('js/main.js') }}"></script>
    {{-- <script src="{{ asset('js/admin/vue.min.js')}}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script src="{{ asset('js/admin/sweetalert.min.js')}}"></script>

    @yield('bottom-script')
    

    <script>
    	@if(session('subscribed'))
 		swal ("Done" ,  "Thankyou for Subscribed" ,  "success" );
 		@endif

    	$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
    	$(document).ready(function(){
        	$("form, input").attr('autocomplete', 'off');

	    	$('img').on('error', function(){
	            $(this).attr('src','{{ asset('uploads/no-image.png') }}');
	        });
    	});
        
    	function validate(evt) {
		  var theEvent = evt || window.event;
		  var key = theEvent.keyCode || theEvent.which;
		  key = String.fromCharCode( key );
		  var regex = /[0-9]|\./;
		  if( !regex.test(key) ) {
		    theEvent.returnValue = false;
		    if(theEvent.preventDefault) theEvent.preventDefault();
		  }
		}

		$('#searchIco').click(function(){
			$('#searchForm input').val(null);
		});


		vm = new Vue({
			el:'#searchEl',
			data:{
				search: '',
				hints: [],
				searchLength: 4,
			},
			methods:{
				// hint: function(){
				// 	val = this.search;
				// 	if(val.length >= 4){
				// 		// var hints = [];
				// 		// this.hints = hints;
				// 		$.ajax({
				// 			url: '{{url('search-hints')}}',
				// 			type:'post',
				// 			data:{search:this.search},
				// 			success: function(res){
				// 				// this.hints = res;
				// 				// this.hints = [3,4];
				// 				// hints = [3,4];
				// 				// this.hints = [3,4];
				// 				vm.hints = JSON.parse(res);
				// 				// console.log(this.hints);
				// 				// console.log(res);
				// 			},
				// 			error:function(error){
				// 				// console.log(error);
				// 			}
				// 		});
				// 	}
				// }
			},
			watch:{
				search: function($value){
					// console.log(this.searchLength);
					if($value.length >= 4){

						// console.log(length);
						// var hints = [];
						// this.hints = hints;
						$.ajax({
							url: '{{url('search-hints')}}',
							type:'post',
							data:{search:this.search},
							success: function(res){
								// this.hints = res;
								// this.hints = [3,4];
								// hints = [3,4];
								// this.hints = [3,4];
								vm.hints = JSON.parse(res);
								console.log(vm.searchLength);
								console.log(vm.search.length);
								if(vm.search.length - vm.searchLength > 1 || vm.search.length - vm.searchLength == 0){
									vm.hints = [];
								}
								vm.searchLength = vm.search.length


								// console.log(this.hints);
								// console.log(res);
							},
							error:function(error){
								// console.log(error);
							}
						});
					}
				}
			}
		});
    </script>

</body>
</html>