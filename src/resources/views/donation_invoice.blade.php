<!-- <!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link href="{{ asset('css/admin/bootstrap.min.css') }}" rel="stylesheet">
		<style type="text/css">
			@media print {
			  button {
			    display: none;
			  }
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="col-xs-12">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td>
								Payee Name: {{ $data['project']['user']->name }}<br>
								Email: {{ $data['project']['user']->email }}<br>
								Contact: {{ $data['project']['user']->mobile }}<br>
								Address: {{ $data['project']['user']['ngo']->address }}<br>
							</td>
							<td>
								Payer Name: {{ $data['user']->name }}<br>
								Email: {{ $data['user']->email }}<br>
								Contact: {{ $data['user']->mobile }}<br>
							</td>
						</tr>
					</tbody>
				</table>
				<table class="table table-bordered">
					<thead>
						<th>Date</th>
						<th>Description</th>
						<th class="text-center">Amount</th>
					</thead>
					<tbody>
						<tr>
							<td class="col-xs-3">
								
							</td>
							<td class="col-xs-7">
								<p>{{ $data['project']->title }}</p>
							</td>
							<td class="col-xs-2">
								<p class="text-center">{{ $data['amountDonated']}}</p>
							</td>
						</tr>
					</tbody>
				</table>

				<div class="d-print-none">
				<center><button onclick="window.print();">Print</button></center>
				</div>
			</div>
		</div>
		{{-- <table style="width: 50%">
			<tr>
				<td>date</td>
				<td>amount</td>
			</tr>
			@foreach($data['donations'] as $donation)
			<tr>
				<td>{{ $donation['created_at'] }}</td>
				<td>{{ $donation['amount_donated']}}</td>
			</tr>
			@endforeach
		</table> --}}
	   

	</body>
	</html> -->

	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="style.css" media="all" />

		<link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/admin/favicon.png')}}">
		<title>1 INR</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

		<title>INVOICE</title>

		<style type="text/css">
			#logo img {
				height: 70px;
				padding-top: 10px;
			}

			.main{
				max-width: 65% !important;
			}

			.header {
				border-left: 7px solid #0187C3;
			}

			.donation {
				font-size: 25px;
				font-weight: 700;
			}

			.bor {
				border-left: 7px solid #57B223;
				background: #EEEEEE;
			}

			.total {

				background-color: #57B223;

			}

			.name {
				color: #57B223;
				/*font-weight: 600;*/
			}
			.font{
				font-size: 20px;
				font-weight: 600;
			}

			.footer{
				font-size: 14px;
				font-weight: 700;
			}

			.invo-number{
				color: #0087C3;
				font-size: 30px;

			}

			.invo{
				border-left:7px solid red;
			}

			.email{
				font-weight: 500;
			}

			.logo-text{
				font-size: 21px;
			}

			.hr{
				border-top: 2px solid gray;
			}
		</style>

	</head>

	<body>
		<div class="mt-3">
			<div class="container main ">

				<div id="logo" class="text-center">
					<img src="{{asset('images/one-inr_old.png')}}">

					<p class="font-italic logo-text">oneinr</p>

				</div>
				<hr class="hr">

				<div class="header">
					<div class="row">
						<div class="col">
							<div class="info  ml-2">
								<p class="text-uppercase text-muted m-1">invoice to</p>
								<p class="m-1">{{ $data['project']['user']->name }}</p>
								<p class="m-1">{{ $data['project']['user']->mobile }}</p>
								<p class="text-info m-1">{{ $data['project']['user']->email }}</p>
								<p class="m-1">
									{{ $data['project']['user']['ngo']->address }}
								</p>
							</div>
						</div>  
					</div>
				</div>

				<div class="col mt-4 invo">
					<p class="invo-number">INVOICE Number: {{ $data['invoice_id'] }}</p>
					<p class="text-muted">Date of Invoice: {{ $data['donationDate']->created_at }}</p>
				</div>

				<div class="text-center mt-3 text-uppercase donation">Donation Certifidate </div>

				<div class="mt-5 ">
					<div class="row pl-3">
						<div class="col-9 bor p-2">
							<p class="name font"> Name</p>
							<p>{{ $data['user']->name }}</p>
							<p>{{ $data['user']->email }}</p>
							<p>{{ $data['user']->mobile }}</p>
						</div>
						<div class="col-3 total text-center text-white p-2">
							<p class="font">Total</p>
							<p>{{ $data['amountDonated'] }}</p>
						</div>
					</div>
				</div>

				<h3 class="mt-5 font-italic">Thank You!</h3>

				<div class="mt-5 text-center footer">
					<hr class="hr">

					<p class="">41, 4th floor A-wing, Todi Industrial Estate Sun Mill compound Road, Lower Parel, Mumbai, Maharashtra 400013</p>

					<p>Contact No:<span class="email">+91 7021431876</span>

						<span>,
							Email: <span class="email">enquiry@nimapinfotech.com</span>
						</span>
					</p>
				</div>

				<div class="d-print-none">
					<center><button onclick="window.print();">Print</button></center>
				</div>
				<br>
				<br>

			</div>
		</div>
	</body>
</html>