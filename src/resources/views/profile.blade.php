@extends('donoraccount_master')
@section('wallet-body')
@php
$user = Auth::user();
@endphp
<div class="col-lg-9">
	<div class="account-content profile">
		<h3 class="account-title">My Profiles</h3>
		<div class="account-main">
			@if (session('success'))
				<div class="alert alert-success">
					{{ session('success') }}
				</div>
				@endif
			{{-- <div class="author clearfix">
				<a class="author-avatar" href="#">
				<img src="{{ asset('uploads').'/'.$user->profile_image }}" alt=""></a>
				<div class="author-content">
					<div class="author-title"><h3><a href="#">{{ $user->name }}</a></h3></div>
					<div class="author-info">
						<p>Balance: {{ $user->balance }} </p>
						<p>Plan: <i class="fa fa-inr" aria-hidden="true"></i> {{ $user->plan }} / Day </p>
						<p>IdeaPress Member since July 2017</p>
					</div>
				</div>
			</div> --}}
			<div class="profile-box">
				<h3>Profile Information</h3>
				
				<ul>
					<li>
						<strong>Name</strong>
						<div class="profile-text"><p>{{ Auth::user()->name }}</p></div>
					</li>
					
					<li>
						<strong>Mobile:</strong>
						<div class="profile-text"><p>{{ Auth::user()->mobile }}</p></div>
					</li>
					<li>
						<strong>Email:</strong>
						<div class="profile-text"><p>{{ Auth::user()->email }}</p></div>
					</li>
				</ul>
			</div>
			
			
			
			<a href="{{ url('profile/edit') }}" class="btn-primary">Edit</a>
		</div>
	</div>
</div>
@endsection
@section('bottom-script')
<script type="text/javascript">
	$('#profile').addClass('active');
</script>
@endsection