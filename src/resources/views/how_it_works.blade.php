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
	<h1>How It Works</h1>
		<div class="breadcrumbs" style="display: inline-flex; margin-bottom: 25px;">
			<a href="{{ url('/') }}">Home</a><span>/</span> How It Works
	</div><!-- .breadcrumbs -->
</div>

 <br><br>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h3>How It Works? :</h3><br>
			<p>If you want to be a part for the improvement of your nearby and the society you live with, give your <b>fundraising support</b> by joining hands with One INR.</p><br>

			<p>One INR being a <b>charitable donation</b> platform collects <b>funds for NGOs.</b> It offers you various <b>money donation</b> plans and options to choose and select the amount of money you want to donate. Our backend team attached with the concerned NGOs will make sure your contribution of money and care reaches in proper hand.</p><br>
			<h4>Small Effort Brings A Large Change</h4><br>
			<p>One INR begins offering you three choices :</p><br>
			<p>One Rupee per day</p>
			<p>Two Rupee per day</p>
			<p>Three Rupee per day</p>
			<p>You can choose and select any one of the given donation option to donate your money. Decide the plan among the three and daily it will deduct that particular amount of money from your account on a yearly basis. In the end, you can check and see what difference you created in someone’s life just by donating a single rupee in a day.</p><br>
			<p>If not yearly you can choose the custom donation option to manually enter the amount you want to donate. With this, you can donate your choice of money to the <b>NGO organization</b> you ardently want to help.</p>
		</div>	
	</div>
</div>

@endsection