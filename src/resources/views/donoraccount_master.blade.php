@extends('web_master')

@section('body')

			
				<div class="container">
					<h1>My Profile</h1>
					<div class="breadcrumbs" style="display: inline-flex; margin-bottom: 25px;">
						
							<a href="{{ url('/') }}">Home</a><span>&nbsp;/&nbsp;</span>
							Profile
						
					</div><!-- .breadcrumbs -->
				</div>
			
			<div class="account-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-lg-3">
							<nav class="account-bar">
								<ul>
									{{-- <li id="dashboard"><a href="{{ url('dashboard') }}">Dashboard</a></li> --}}
									<li id="profile" {{-- class="active" --}}><a href="{{ url('profile') }}">Profile Info</a></li>
									<li id="profile_password" {{-- class="active" --}}><a href="{{ url('profile/password') }}">Profile Password</a></li>
									{{-- <li><a href="account_my_campaigns.html">My Campaigns</a></li> --}}
									{{-- <li><a href="account_backed_campaigns.html">Backed Campaigns</a></li> --}}
									{{-- <li><a href="account_pledges_received.html">Pledges Received</a></li> --}}
									<li id="campaigns"><a href="{{ url('backed-campaigns') }}">Backed Campaigns</a></li>
									<li id="wallet"><a href="{{ url('wallet') }}">Wallet</a></li>
								</ul>
							</nav>
						</div>
						@yield('wallet-body')
						
					</div>
				</div><!-- .container -->
			</div><!-- .account-content -->
		
@endsection
