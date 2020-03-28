<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<!-- <base href="../../../"> -->
		<meta charset="utf-8" />
		<title>Metronic | Login Page 2</title>
		<meta name="description" content="Login page example">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

		<!--end::Fonts -->

		<!--begin::Page Custom Styles(used by this page) -->
		<link href="{{ asset('/css/pages/login/login-2.css')}}" rel="stylesheet" type="text/css" />

		<!--end::Page Custom Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->

		<!--begin:: Vendor Plugins -->
		<link href="{{ asset('/plugins/general/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/tether/dist/css/tether.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/bootstrap-timepicker/css/bootstrap-timepicker.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/nouislider/distribute/nouislider.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/owl.carousel/dist/assets/owl.carousel.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/owl.carousel/dist/assets/owl.theme.default.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/quill/dist/quill.snow.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/@yaireo/tagify/dist/tagify.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/summernote/dist/summernote.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/animate.css/animate.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/toastr/build/toastr.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/dual-listbox/dist/dual-listbox.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/morris.js/morris.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/sweetalert2/dist/sweetalert2.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/socicon/css/socicon.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/plugins/line-awesome/css/line-awesome.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/plugins/flaticon/flaticon.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/plugins/flaticon2/flaticon.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/general/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css" />

		<!--end:: Vendor Plugins -->
		<link href="{{ asset('/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />

		<!--begin:: Vendor Plugins for custom pages -->
		<link href="{{ asset('/plugins/custom/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/custom/@fullcalendar/core/main.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/custom/@fullcalendar/daygrid/main.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/custom/@fullcalendar/list/main.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/custom/@fullcalendar/timegrid/main.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/custom/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/custom/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/custom/datatables.net-autofill-bs4/css/autoFill.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/custom/datatables.net-colreorder-bs4/css/colReorder.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/custom/datatables.net-fixedcolumns-bs4/css/fixedColumns.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/custom/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/custom/datatables.net-keytable-bs4/css/keyTable.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/custom/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/custom/datatables.net-rowgroup-bs4/css/rowGroup.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/custom/datatables.net-rowreorder-bs4/css/rowReorder.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/custom/datatables.net-scroller-bs4/css/scroller.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/custom/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/custom/jstree/dist/themes/default/style.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/custom/jqvmap/dist/jqvmap.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/plugins/custom/uppy/dist/uppy.min.css')}}" rel="stylesheet" type="text/css" />

		<!--end:: Vendor Plugins for custom pages -->

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->
		<link href="{{ asset('/css/skins/header/base/light.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/css/skins/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/css/skins/brand/dark.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/css/skins/aside/dark.css')}}" rel="stylesheet" type="text/css" />

		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="{{ asset('/media/logos/favicon.ico')}}" />
		<style>

			/* BASIC */

			html {
			background-color: #56baed;
			}

			body {
			font-family: "Poppins", sans-serif;
			height: 100vh;
			}

			a {
			color: #92badd;
			display:inline-block;
			text-decoration: none;
			font-weight: 400;
			}

			h2 {
			text-align: center;
			font-size: 16px;
			font-weight: 600;
			text-transform: uppercase;
			display:inline-block;
			margin: 40px 8px 10px 8px; 
			color: #cccccc;
			}



			/* STRUCTURE */

			.wrapper {
			display: flex;
			align-items: center;
			flex-direction: column; 
			justify-content: center;
			width: 100%;
			min-height: 100%;
			padding: 20px;
			}

			#formContent {
				-webkit-border-radius: 10px 10px 10px 10px;
				border-radius: 10px 10px 10px 10px;
				background: #fff;
				padding: 30px;
				width: 90%;
				max-width: 450px;
				position: relative;
				padding: 0px;
				-webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
				box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
				text-align: center;
			}

			#formContent2 {
				-webkit-border-radius: 10px 10px 10px 10px;
				border-radius: 10px 10px 10px 10px;
				background: #fff;
				padding: 30px;
				width: 90%;
				max-width: 450px;
				position: relative;
				padding: 0px;
				-webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
				box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
				text-align: center;
			}

			#formFooter {
			background-color: #f6f6f6;
			border-top: 1px solid #dce8f1;
			padding: 25px;
			text-align: center;
			-webkit-border-radius: 0 0 10px 10px;
			border-radius: 0 0 10px 10px;
			}



			/* TABS */

			h2.inactive {
			color: #cccccc;
			}

			h2.active {
			color: #0d0d0d;
			border-bottom: 2px solid #5fbae9;
			}



			/* FORM TYPOGRAPHY*/

			input[type=button], input[type=submit], input[type=reset]  {
				background-color: #56baed;
				margin-top: 15px !important;
				border: none;
				color: white;
				padding: 10px 30px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				text-transform: uppercase;
				font-size: 13px;
				-webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
				box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
				-webkit-border-radius: 5px 5px 5px 5px;
				border-radius: 5px 5px 5px 5px;
				margin: 5px 20px 40px 20px;
				-webkit-transition: all 0.3s ease-in-out;
				-moz-transition: all 0.3s ease-in-out;
				-ms-transition: all 0.3s ease-in-out;
				-o-transition: all 0.3s ease-in-out;
				transition: all 0.3s ease-in-out;
			}

			input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
			background-color: #39ace7;
			}

			input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
			-moz-transform: scale(0.95);
			-webkit-transform: scale(0.95);
			-o-transform: scale(0.95);
			-ms-transform: scale(0.95);
			transform: scale(0.95);
			}

			input[type=text], input[type=password], input[type=email] {
				background-color: #f6f6f6;
				border: none;
				color: #0d0d0d;
				padding: 10px 15px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 16px;
				margin: 5px;
				width: 85%;
				border: 2px solid #f6f6f6;
				-webkit-transition: all 0.5s ease-in-out;
				-moz-transition: all 0.5s ease-in-out;
				-ms-transition: all 0.5s ease-in-out;
				-o-transition: all 0.5s ease-in-out;
				transition: all 0.5s ease-in-out;
				-webkit-border-radius: 5px 5px 5px 5px;
				border-radius: 5px 5px 5px 5px;
			}

			input[type=text]:focus, input[type=password]:focus, input[type=email]:focus {
			background-color: #fff;
			border-bottom: 2px solid #5fbae9;
			}

			input[type=text]:placeholder, input[type=password]:placeholder, input[type=email]:placeholder {
			color: #cccccc;
			}



			/* ANIMATIONS */

			/* Simple CSS3 Fade-in-down Animation */
			.fadeInDown {
			-webkit-animation-name: fadeInDown;
			animation-name: fadeInDown;
			-webkit-animation-duration: .5s;
			animation-duration: .5s;
			-webkit-animation-fill-mode: both;
			animation-fill-mode: both;
			}

			@-webkit-keyframes fadeInDown {
			0% {
				opacity: 0;
				-webkit-transform: translate3d(0, -100%, 0);
				transform: translate3d(0, -100%, 0);
			}
			100% {
				opacity: 1;
				-webkit-transform: none;
				transform: none;
			}
			}

			@keyframes fadeInDown {
			0% {
				opacity: 0;
				-webkit-transform: translate3d(0, -100%, 0);
				transform: translate3d(0, -100%, 0);
			}
			100% {
				opacity: 1;
				-webkit-transform: none;
				transform: none;
			}
			}

			/* Simple CSS3 Fade-in Animation */
			@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
			@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
			@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

			.fadeIn {
				opacity:0;
				-webkit-animation:fadeIn ease-in 1;
				-moz-animation:fadeIn ease-in 1;
				animation:fadeIn ease-in 1;

				-webkit-animation-fill-mode:forwards;
				-moz-animation-fill-mode:forwards;
				animation-fill-mode:forwards;

				-webkit-animation-duration:.5s;
				-moz-animation-duration:.5s;
				animation-duration:.5s;
			}

			.fadeIn.first {
			-webkit-animation-delay: 0.4s;
			-moz-animation-delay: 0.4s;
			animation-delay: 0.4s;
			}

			.fadeIn.second {
			-webkit-animation-delay: 0.6s;
			-moz-animation-delay: 0.6s;
			animation-delay: 0.6s;
			}

			.fadeIn.third {
			-webkit-animation-delay: 0.8s;
			-moz-animation-delay: 0.8s;
			animation-delay: 0.8s;
			}

			.fadeIn.fourth {
			-webkit-animation-delay: 1s;
			-moz-animation-delay: 1s;
			animation-delay: 1s;
			}

			/* Simple CSS3 Fade-in Animation */
			.underlineHover:after {
			display: block;
			left: 0;
			bottom: -10px;
			width: 0;
			height: 2px;
			background-color: #56baed;
			content: "";
			transition: width 0.2s;
			}

			.underlineHover:hover {
			color: #0d0d0d;
			}

			.underlineHover:hover:after{
			width: 100%;
			}



			/* OTHERS */

			*:focus {
				outline: none;
			} 

			#icon {
				width: 40%;
				padding: 25px 0px;
			}

			.or-seperator {
				margin: 20px 0 10px;
				text-align: center;
				border-top: 1px solid #ccc;
			}
		</style>
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root">
			<div class="kt-grid kt-grid--hor kt-grid--root kt-login kt-login--v2 kt-login--signin" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url('{{asset('/media/bg/bg-1.jpg')}}');">
					<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
						<div class="kt-login__container">

						<div class="wrapper fadeInDown">
							<div id="formContent">
								<!-- Tabs Titles -->

								<!-- Icon -->
								<div class="fadeIn first">
									<img src="{{ url('/docs/logo.png') }}" id="icon" alt="User Icon" />
								</div>

								<div class="kt-login__head">
									<!-- <h3 class="kt-login__title">Sign In</h3> -->
									@if ($alert = Session::get('error'))
									<div class="alert alert-warning">
										{{ $alert }}
									</div>
									@elseif($alert = Session::get('Success'))
									<div class="alert alert-success">
											{{ $alert }}
									</div>
									@endif
								</div>

								<!-- Login Form -->
								<form method="post" action="{{ route('reset-new-password') }}">
									{{ csrf_field() }}
                                    <input type="hidden" name="unique" value="{{ $unique }}">
									<input type="password" id="login" class="fadeIn second" name="password" placeholder="password" required="">
									<input type="password" id="password" class="fadeIn third" name="confirm_password" placeholder="confirm password" required="">
									<input type="submit" class="fadeIn fourth" value="Reset" style="margin: 0px 0px 20px 0px">
								</form>

								<!-- Remind Passowrd -->
								<div id="formFooter">
									<a class="underlineHover" href="{{ route('login-page') }}">Login</a>
								</div>
							</div>
						</div>
							<!-- <div class="kt-login__logo">
								<a href="#">
									<img src="{{ url('/docs/logo.png') }}">
								</a>
							</div>
							<div class="kt-login__signin">
								<div class="kt-login__head">
									<h3 class="kt-login__title">Sign In</h3>
									@if ($alert = Session::get('error'))
									<div class="alert alert-warning">
										{{ $alert }}
									</div>
									@elseif($alert = Session::get('Success'))
									<div class="alert alert-success">
											{{ $alert }}
									</div>
									@endif
								</div>
								<form class="kt-form" action="">
									<div class="kt-login__actions">
										<a href="{{url('login_redirect')}}" class="btn btn-pill kt-login__btn-primary">Google Sign In</a>
									</div>
								</form>
							</div> -->
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": [
							"#c5cbe3",
							"#a1a8c3",
							"#3d4465",
							"#3e4466"
						],
						"shape": [
							"#f0f3ff",
							"#d9dffa",
							"#afb4d4",
							"#646c9a"
						]
					}
				}
			};
		</script>

		<!-- end::Global Config -->

		<!--begin::Global Theme Bundle(used by all pages) -->

		<!--begin:: Vendor Plugins -->
		<script src="{{ asset('/plugins/general/jquery/dist/jquery.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/popper.js/dist/umd/popper.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/js-cookie/src/js.cookie.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/moment/min/moment.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/tooltip.js/dist/umd/tooltip.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/perfect-scrollbar/dist/perfect-scrollbar.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/sticky-js/dist/sticky.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/wnumb/wNumb.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/jquery-form/dist/jquery.form.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/block-ui/jquery.blockUI.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/js/global/integration/plugins/bootstrap-datepicker.init.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/js/global/integration/plugins/bootstrap-timepicker.init.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/bootstrap-maxlength/src/bootstrap-maxlength.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/plugins/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/bootstrap-select/dist/js/bootstrap-select.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/bootstrap-switch/dist/js/bootstrap-switch.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/js/global/integration/plugins/bootstrap-switch.init.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/ion-rangeslider/js/ion.rangeSlider.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/typeahead.js/dist/typeahead.bundle.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/handlebars/dist/handlebars.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/inputmask/dist/jquery.inputmask.bundle.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/inputmask/dist/inputmask/inputmask.date.extensions.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/nouislider/distribute/nouislider.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/owl.carousel/dist/owl.carousel.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/autosize/dist/autosize.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/clipboard/dist/clipboard.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/dropzone/dist/dropzone.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/js/global/integration/plugins/dropzone.init.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/quill/dist/quill.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/@yaireo/tagify/dist/tagify.polyfills.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/@yaireo/tagify/dist/tagify.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/summernote/dist/summernote.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/markdown/lib/markdown.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/bootstrap-markdown/js/bootstrap-markdown.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/js/global/integration/plugins/bootstrap-markdown.init.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/bootstrap-notify/bootstrap-notify.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/js/global/integration/plugins/bootstrap-notify.init.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/jquery-validation/dist/jquery.validate.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/jquery-validation/dist/additional-methods.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/js/global/integration/plugins/jquery-validation.init.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/toastr/build/toastr.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/dual-listbox/dist/dual-listbox.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/raphael/raphael.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/morris.js/morris.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/chart.js/dist/Chart.bundle.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/plugins/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/plugins/jquery-idletimer/idle-timer.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/waypoints/lib/jquery.waypoints.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/counterup/jquery.counterup.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/es6-promise-polyfill/promise.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/sweetalert2/dist/sweetalert2.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/js/global/integration/plugins/sweetalert2.init.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/jquery.repeater/src/lib.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/jquery.repeater/src/jquery.input.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/jquery.repeater/src/repeater.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/general/dompurify/dist/purify.js')}}" type="text/javascript"></script>

		<!--end:: Vendor Plugins -->
		<script src="{{ asset('/js/scripts.bundle.js')}}" type="text/javascript"></script>

		<!--begin:: Vendor Plugins for custom pages -->
		<script src="{{ asset('/plugins/custom/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/@fullcalendar/core/main.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/@fullcalendar/daygrid/main.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/@fullcalendar/google-calendar/main.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/@fullcalendar/interaction/main.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/@fullcalendar/list/main.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/@fullcalendar/timegrid/main.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/gmaps/gmaps.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/flot/dist/es5/jquery.flot.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/flot/source/jquery.flot.resize.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/flot/source/jquery.flot.categories.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/flot/source/jquery.flot.pie.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/flot/source/jquery.flot.stack.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/flot/source/jquery.flot.crosshair.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/flot/source/jquery.flot.axislabels.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net/js/jquery.dataTables.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net-bs4/js/dataTables.bootstrap4.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/js/global/integration/plugins/datatables.init.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net-autofill/js/dataTables.autoFill.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net-autofill-bs4/js/autoFill.bootstrap4.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/jszip/dist/jszip.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/pdfmake/build/pdfmake.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/pdfmake/build/vfs_fonts.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net-buttons/js/dataTables.buttons.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net-buttons/js/buttons.colVis.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net-buttons/js/buttons.flash.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net-buttons/js/buttons.html5.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net-buttons/js/buttons.print.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net-colreorder/js/dataTables.colReorder.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net-fixedcolumns/js/dataTables.fixedColumns.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net-keytable/js/dataTables.keyTable.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net-responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net-rowgroup/js/dataTables.rowGroup.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net-rowreorder/js/dataTables.rowReorder.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net-scroller/js/dataTables.scroller.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/datatables.net-select/js/dataTables.select.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/jstree/dist/jstree.js')}}" type="text/javascript"></script>
		<script src="{{ asset('/plugins/custom/uppy/dist/uppy.min.js')}}" type="text/javascript"></script><!--  -->

		<!--end:: Vendor Plugins for custom pages -->

		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts(used by this page) -->
		<script src="{{ asset('/js/pages/custom/login/login-general.js')}}" type="text/javascript"></script>

		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>