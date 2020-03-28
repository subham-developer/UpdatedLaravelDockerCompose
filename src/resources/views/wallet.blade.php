@extends('donoraccount_master')
@section('wallet-body')
<div class="col-lg-9" id="walletPage">
	@php
	$user = Auth::user();
	@endphp
	<div class="account-content profile" >
		<h3 class="account-title">One INR Wallet
			<span style="float: right;">Balance: {{ Auth::user()->balance }}</span></h3>
			<div class="account-main">
				@if (session('success'))
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
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#moneyTab">Add Money To Wallet</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#planTab">Change Plan</a>
					</li>

				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane container active" id="moneyTab">
						<br>

						<!-- {!! Form::open(['url'=>'wallet/add','id'=>'paymentForm']) !!} -->
						{!! Form::open(['url'=>'dopayment','id'=>'rzp-footer-form']) !!}
						<br>
						<div class="form-check form-check-inline">
							<input class="form-check-input" name="plan" type="radio" id="inlineRadio1" value="1"
							v-model='plan'>
							<label style="padding-left: 0px;" class="form-check-label" for="inlineRadio1">Select Plan</label>
						</div>
						<div class="form-check form-check-inline" style="margin-left: 30px;">
							<input class="form-check-input" name="plan" type="radio" id="custom"  value="2"
							v-model='plan'>
							<label style="padding-left: 0" class="form-check-label" for="custom">Custom Plan</label>
						</div>
						<div class="row" id="planFields" v-if='plan == 1'>
							<div class="col-md-12">
								<div class="radio">
									<label>{!! Form::radio('amount', 365, null, array('class'=>'pay-cost'), ['required']) !!} 1 Rs / Per Day ( Rs. 365)</label>
								</div>
								<div class="radio">
									<label>{!! Form::radio('amount', 730, null, array('class'=>'pay-cost'), ['required']) !!} 2 Rs / Per Day ( Rs. 730)</label>
								</div>
								<div class="radio">
									<label>{!! Form::radio('amount', 1095, null, array('class'=>'pay-cost'), ['required']) !!} 3 Rs / Per Day ( Rs. 1095)</label>
								</div>
							</div>
						</div>
						<div class="row" id="customFields" v-if='plan == 2'>
							<div class="col-md-4">
								<div class="form-group">
									<label>Amount: (min <i class="fa fa-inr" aria-hidden="true"></i> 365)</label>
									<input type="number" name="amount" class="form-control pay-custom-cost" min="365" placeholder="Amount" required>
								</div>
							</div>
						</div>
						<br>

						<div class="pay">
							<button class="razorpay-payment-button btn filled small btn-primary" id="paybtn" type="button">Pay with Razorpay</button>                        
						</div>

						<!-- <div id="paymentDetail" style="display: none">
							<center>
								<div>paymentID: <span id="paymentID"></span></div>
								<div>paymentDate: <span id="paymentDate"></span></div>
							</center>
						</div> -->
						<!-- {!! Form::submit('Add Money To Wallet', ['class'=>'btn-primary']) !!} -->
						{!! Form::close() !!}
					</div>
					<div class="tab-pane container fade" id="planTab">
						<br>
						<p>Your current plan is: <i class="fa fa-inr" aria-hidden="true"></i> {{ $user->plan }} / Day</p>
						<br>
						{!! Form::open(['route'=>'update.plan','method'=>'put']) !!}

						<div class="form-group">
							<input type="text" name="amount" class="form-control col-md-2" placeholder="Enter amount" style="display: inline;" required>
							<span style="display: inline;"> Per Day</span>
							{{-- <small class="form-text text-danger">We'll never share your email with anyone else.</small> --}}
							<br>
							<button class="btn-primary" style="margin-top: 20px;">Change Plan</button>
						</div>
						{!! Form::close() !!}
					</div>
				</div>

			</div>
		</div>
	</div>
	@endsection
	@section('bottom-script')
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  
	<script type="text/javascript">
		$('#wallet').addClass('active');
		new Vue({
			el:'#walletPage',
			data:{
				plan: '1',
			}
		});
	</script>


	<script>
		$('#rzp-footer-form').submit(function (e) {
			var button = $(this).find('button');
			var parent = $(this);
			button.attr('disabled', 'true').html('Please Wait...');
			$.ajax({
				method: 'get',
				url: this.action,
				data: $(this).serialize(),
				complete: function (r) {
					console.log('complete');
					console.log(r);
				}
			})
			return false;
		})
	</script>

	<script>
		function padStart(str) {
			return ('0' + str).slice(-2)
		}

		function demoSuccessHandler(transaction) {
        // You can write success code here. If you want to store some data in database.
        $("#paymentDetail").removeAttr('style');
        $('#paymentID').text(transaction.razorpay_payment_id);
        var paymentDate = new Date();
        $('#paymentDate').text(
        	padStart(paymentDate.getDate()) + '.' + padStart(paymentDate.getMonth() + 1) + '.' + paymentDate.getFullYear() + ' ' + padStart(paymentDate.getHours()) + ':' + padStart(paymentDate.getMinutes())
        	);

        $.ajax({
        	method: 'post',
        	url: "{!!route('dopayment')!!}",
        	data: {
        		"_token": "{{ csrf_token() }}",
        		"razorpay_payment_id": transaction.razorpay_payment_id
        	},
        	complete: function (r) {
        		// console.log('complete');
        		// var responseData = JSON.stringify(r.responseText);
        		var pay_cost = $('input[name="amount"]:checked').val();
        		var	pay_custom_cost = $('.pay-custom-cost').val();

        		// if (pay_cost == undefined && (pay_custom_cost== undefined || pay_custom_cost== '') ) {
        		// 	alert("Please enter some amount.");
        		// 	return false;
        		// }

        		if (pay_cost != undefined && (pay_custom_cost== undefined || pay_custom_cost== '') ) {
        			pay_cost = $('input[name="amount"]:checked').val();
        		}

        		if ( (pay_custom_cost != undefined || pay_custom_cost != '') && pay_cost == undefined ) {
        			pay_cost =  $('.pay-custom-cost').val();
        		}

        		$.ajax({
        			method: 'post',
        			url: "{{route('add_payment_details')}}",
        			data: {
        				// "_token": "{{ csrf_token() }}",
        				"razorpay_payment_id": transaction.razorpay_payment_id,
        				"paymentDate" : paymentDate,
        				"pay_cost" : pay_cost
        			},
        			complete: function (resData) {
        				// console.log('complete');
        				// console.log(resData);
        				// console.log('complete');
        				location.reload();
        			}
        		})

        	}
        })
      }
    </script>
    <script>
    	$(".razorpay-payment-button").click(function() {
    		var pay_cost = $('input[name="amount"]:checked').val();
    		var	pay_custom_cost = $('.pay-custom-cost').val();

    		if (pay_cost == undefined && (pay_custom_cost== undefined || pay_custom_cost== '') ) {
    			alert("Please enter some amount.");
    			return false;
    		}

    		if (pay_cost != undefined && (pay_custom_cost== undefined || pay_custom_cost== '') ) {
    			pay_cost = $('input[name="amount"]:checked').val();
    		}

    		if ( (pay_custom_cost != undefined || pay_custom_cost != '') && pay_cost == undefined ) {
    			pay_cost =  $('.pay-custom-cost').val();
    		}

    		// pay_cost = 10; //testing with 10rs. Please remove comment this line before pushing it on live.

    		var options = {
    			key: "{{$razorpaydata['RAZORPAY_KEY']}}",
    			amount: pay_cost * 100,
    			name: 'One INR',
    			description: 'Add money to wallet',
    			image: 'https://cdn.razorpay.com/logo.svg',
    			handler: demoSuccessHandler
    		}
    		window.r = new Razorpay(options);
    		document.getElementById('paybtn').onclick = function () {
    			r.open()
    		}
    	});
    </script>
    
    @endsection