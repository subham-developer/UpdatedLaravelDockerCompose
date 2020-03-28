@extends('donoraccount_master')
@section('wallet-body')
@php
$user = Auth::user();
@endphp
<div class="col-lg-9">
	<div class="account-content profile">
		<h3 class="account-title">My Profiles</h3>
		<div class="account-main">
			{{-- <div class="author clearfix">
				<a class="author-avatar" href="#">
				<img src="{{ asset('uploads').'/'.$user->profile_image }}" alt=""></a>
				<div class="author-content">
					<div class="author-title"><h3><a href="#">{{ $user->name }}</a></h3></div>
					<div class="author-info">
						<p>Balance: {{ $user->balance }} </p>
						<p>IdeaPress Member since July 2017</p>
					</div>
				</div>
			</div> --}}
			<div class="profile-box">
				<div class="row">
					<div class="col-lg-12">
						@if ($errors->any())
						    <div class="alert alert-danger">
						        <ul>
						            @foreach ($errors->all() as $error)
						                <li style="margin-bottom: 0px;">{{ $error }}</li>
						            @endforeach
						        </ul>
						    </div>
						@endif
					</div>
					<div class="col-lg-6">
						<h3>Profile Infomations</h3>
						
						{!! Form::model($data['user'],['url'=>'profile/update']) !!}
						<div class="form-group">
							<label>Name</label>
							{!! Form::text('name', $data['user']['name'], ['class'=>'form-control','placeholder'=>'Name']) !!}
						</div>
						<div class="form-group">
							<label>Mobile</label>
							{!! Form::text('mobile', $data['user']['mobile'], ['class'=>'form-control','placeholder'=>'Mobile','maxlength'=>10]) !!}
						</div>
						<div class="form-group">
							<label>Email</label>
							{!! Form::email('email', $data['user']['email'], ['class'=>'form-control','placeholder'=>'Email']) !!}
						</div>
						
						<button type="submit" class="btn-primary">Update</button>


						{!! Form::close() !!}
					</div>
{{-- 
					<div class="col-lg-6">
						<h3>Change Password</h3>
						{!! Form::open(['url'=>'profile/password']) !!}
						<div class="form-group">
							<label>Current Password</label>
							<input type="password" name="current_password" class="form-control" placeholder="Current Password" required>

						</div>

						<div class="form-group">
							<label>New Password</label>
							<input type="password" name="new_password" class="form-control"  placeholder="New Password">

						</div>
						<div class="form-group">
							<label>Confirmed Password</label>
							<input type="password" name="new_password_confirmation" class="form-control" 
							placeholder="Confirmed Password">



						</div>
							<button type="submit" class="btn-primary pull-right">Update</button>
							{!! Form::close() !!}
					</div> --}}
					
				</div>
			</div>
			
			
			
		</div>
	</div>
</div>
@endsection
@section('bottom-script')
<script type="text/javascript">
	$('#profile').addClass('active');
</script>
@endsection