@extends('web_master')
@section('css')
@endsection
@section('body')
@guest
<!-- Modal -->
<style>
	#campaign p span{
		font-size:14pt !important;
	}

</style>
<div id="signInModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="main-content">
						<div class="form-login">
							<h2>Log in with your account</h2>
							<form action="{{ route('login') }}" method="POST" id="loginForm" class="clearfix">
								@csrf
								<div class="field">
									{{-- <input type="email" value="" name="s" placeholder="E-mail Address" /> --}}
									<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="E-Mail Address" name="email" value="{{ old('email') }}" required autofocus>
									@if ($errors->has('email'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
									@endif
									
								</div>
								<div class="field">
									{{-- <input type="text" value="" name="s" placeholder="Password" /> --}}
									<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
									@if ($errors->has('password'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
									@endif
								</div>
								<div class="inline clearfix">
									<button type="submit" value="Send Messager" class="btn-primary">Login</button>
									<p>Not a member yet? <a href="{{ url('register') }}">Register Now</a></p>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
@endguest
{{-- donation modal --}}
@if(Auth::check())
<!-- Modal -->
<div id="donateModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			{{-- <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Donate</h4>
			</div> --}}

			<div class="modal-body">
				<h3>Your current plan is {{ Auth::user()->plan }}<br></h3>
				<p>You can donate more</p><br>
			<!--  -->
				<form action="{{ url('donate',$data->slug ) }}" id="priceForm" method="post" class="campaign-price quantity">
					@csrf
					<input type="number" value="{{ Auth::user()->plan }}" min="0" name="amount" required />
					
					<button class="btn-primary" type="button" id="pledgeNow">Donate</button>
					
					@if($errors->has('amount'))
						<span class="text-danger">{{ $errors->first('amount') }}</span>
					@endif
					
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endif

<?php

$image_name = '';
$i=0;

for($i=0; $i< count($data['project']['project']['image']); $i++){
	//if($data['project']['project']['image'][$i]['image_type']=="cover")
	//$image_name = $data['project']['project']['image'][$i]['name'];

	if($data['project']['project']['image'][$i]['image_type']=="slide")
	$slide_image_name[] = $data['project']['project']['image'][$i]['name'];
}

?>

{{-- <div class="page-title background-campaign" style="background: url('{{ asset('uploads').'/'.$data['project']['project']['image'][0]['name'] }}');background-repeat: no-repeat;background-size: cover;"> --}}

	
	<div class="container">
		{{-- <h1>{{ $data['project']['project']['title'] }}</h1> --}}
		<div class="breadcrumbs" style="display: inline-flex; margin-bottom: 25px;">
			
				<a href="{{ asset('/') }}">Home &nbsp;</a><span> / </span>&nbsp; {{ $data['project']['project']['title'] }}
			
			</div><!-- .breadcrumbs -->
		</div>
		
		<div class="campaign-content">
			<div class="container">
				<div class="campaign">
					<div class="campaign-item clearfix">
						<div class="campaign-image">
							<div id="owl-campaign" class="campaign-slider">
								
								
								{{-- @foreach($data['project']['project']['image'] as $image) --}}
								@if(count($data['project']['project']['image']) > 0)
								@foreach($slide_image_name as $image)
								<div class="item">
									<img src="{{ asset('uploads').'/'.$image }}" alt="">
								</div>
								@endforeach
								@else
								<div class="item">
									<img src="}" alt="">
								</div>
								@endif
							</div>
						</div>
						<div class="campaign-box">
							{{-- {{ $data['project']['project']['image'] }} --}}
							
							{{-- <a href="#" class="category">Crafts</a> --}}
							<h3>{{ $data['project']['project']['title'] }}</h3>
							<div class="campaign-description"><p>{{ $data['project']['project']['description'] }}</p></div>
							<div class="campaign-author clearfix">
								<div class="author-profile">
									<a class="author-icon" >
										@if(isset($data['project']['project']->user->profile_image))
											<img src="{{ asset('uploads').'/'.$data['project']['project']->user->profile_image }}" alt="">
										@else
											<img src="{{ asset('images').'/'.'one-inr.png' }}" alt="">
										@endif
									</a>
										by 
										{{-- <a class="author-name" href="#"> --}}
										{{ $data['project']['project']['user']->name }}
									{{-- </a> --}}
								</div>
								{{-- <div class="author-address"><span class="ion-location"></span>Melbourne, Victoria, AU</div> --}}
							</div>
							<div class="process">
								<div class="raised">
									
									<span style="width: {{ $data['project']['completed'] }}%"></span>
								</div>
								<div class="process-info">
									<div class="process-funded">
										<span><i class="fa fa-inr" aria-hidden="true"></i> {{ $data['project']['project']['target']}}</span>Goal</div>
										<div class="process-pledged"><span><i class="fa fa-inr" aria-hidden="true"></i> {{ $data['project']['funded'] }}</span>Funded</div>
										{{-- <div class="process-time"><span>37</span>backers</div> --}}
										<div class="process-time">
											<span>{{ $data['project']['days_left'] }}</span>
										Days Left</div>
									</div>
								</div>
								<div class="button">
									@if(Auth::check())
										@if(Auth::user()->balance == 0)
										<a href="{{ url('wallet') }}" style="display: inline;">
											<button class="btn-primary" type="button">Donate Now</button>
										</a>
										@else
										<button class="btn-primary" type="button" id="pledgeNow" data-toggle="modal" data-target="#donateModal">Donate Now</button>
										{{-- <button class="btn-primary" type="button" id="pledgeNow">Donate Now</button> --}}
										@endif
										@else
										<button type="button" class="btn-primary" data-toggle="modal" data-target="#signInModal">Donate Now</button>
										@endif
										<br>
										@if($errors->has('amount'))
										<span class="text-danger">{{ $errors->first('amount') }}</span>
										@endif
									
									{{-- <a href="#" class="btn-secondary"><i class="fa fa-heart" aria-hidden="true"></i>Remind me</a> --}}
								</div>
								{{-- <div class="share">
									<p>Share this project</p>
									<ul>
										<li class="share-facebook"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
										<li class="share-twitter"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
										<li class="share-google-plus"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
										<li class="share-linkedin"><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
										<li class="share-code"><a href="#"><i class="fa fa-code" aria-hidden="true"></i></a></li>
									</ul>
								</div> --}}
							</div>
						</div>
					</div>
				</div>
				</div><!-- .campaign-content -->
				<div class="campaign-history">
					<div class="container">
						<div class="row">
							<div class="col-lg-8">
								<div class="campaign-tabs">
									<ul class="tabs-controls">
										@if($data['project']['project']['long_description'])
										<li class="active" data-tab="campaign"><a href="#">Campaign Story</a></li>
										@endif
										{{-- <li data-tab="backer"><a href="#">Backer List</a></li> --}}
										{{-- <li data-tab="faq"><a href="#">FAQ</a></li> --}}
										{{-- <li data-tab="updates"><a href="#">Updates</a></li> --}}
										@php $active = $data['project']['project']['long_description']?'':'active'; @endphp
										<li class="{{$active}}" data-tab="comment"><a href="#">Comments</a></li>
									</ul>
									<div class="campaign-content" style="text-align: justify" >
										<div id="campaign" class="tabs active">
											{!! $data['project']['project']['long_description'] !!}
										</div>
										{{-- <div id="backer" class="tabs">
											<table>
												<tr>
													<th>Name</th>
													<th>Donate Amount</th>
													<th>Date</th>
												</tr>
												<tr>
													<td>Andrew</td>
													<td>$100</td>
													<td>June 25, 2017</td>
												</tr>
												<tr>
													<td>Andrew</td>
													<td>$60</td>
													<td>December 25, 2017</td>
												</tr>
												<tr>
													<td>Andrew</td>
													<td>$70</td>
													<td>November 25, 2017</td>
												</tr>
												<tr>
													<td>Andrew</td>
													<td>$90</td>
													<td>February 25, 2017</td>
												</tr>
												<tr>
													<td>Andrew</td>
													<td>$30</td>
													<td>January 25, 2017</td>
												</tr>
												<tr>
													<td>Andrew</td>
													<td>$80</td>
													<td>June 15, 2017</td>
												</tr>
											</table>
										</div> --}}
										{{-- <div id="faq" class="tabs">
											<h2>Frequently Asked Questions</h2>
											<p>Looks like there aren't any frequently asked questions yet. Ask the project creator directly.</p>
											<a href="#" class="btn-primary">Ask a question</a>
										</div> --}}
										{{-- <div id="updates" class="tabs">
											<ul>
												<li>
													<p class="date">30-06-2017</p>
													<h3>New Project Launches in Bangalore</h3>
													<div class="desc"><p>Bacon spare ribs rump chuck turkey, ham hock capicola. Strip steak tongue kielbasa, boudin hamburger t-bone capicola turducken. Landjaeger meatloaf pork belly spare ribs chuck.</p></div>
												</li>
												<li>
													<p class="date">31-05-2018</p>
													<h3>Our First Office Start</h3>
													<div class="desc"><p>Corned beef leberkas fatback porchetta, strip steak salami turkey short loin flank ham hock landjaeger. Leberkas pork belly kevin shoulder filet mignon. Bacon spare ribs rump chuck turkey, ham hock capicola. Strip steak tongue kielbasa, boudin hamburger t-bone capicola turducken. Landjaeger meatloaf pork belly spare ribs chuck.</p></div>
												</li>
												<li>
													<p class="date">31-05-2018</p>
													<h3>We Touch the Million Dollar Milestone</h3>
													<div class="desc"><p>Corned beef leberkas fatback porchetta, strip steak salami turkey short loin flank ham hock landjaeger. Leberkas pork belly kevin shoulder filet mignon. Bacon spare ribs rump chuck turkey, ham hock capicola. Strip steak tongue kielbasa, boudin hamburger t-bone capicola turducken. Landjaeger meatloaf pork belly spare ribs chuck.</p></div>
												</li>
												<li>
													<p class="date">31-05-2018</p>
													<h3>Our Employee Reach 100 Person</h3>
													<div class="desc"><p>Sed cursus hendrerit odio, at aliquet leo hendrerit a. Nulla ultricies sagittis dolor, quis maximus magna consectetur eu. Cras pharetra aliquam fringilla. Integer placerat sapien dapibus varius luctus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in aliquam urna, ultrices lobortis lacus. Praesent mi enim, congue semper volutpat ut, bibendum tempor arcu.</p></div>
												</li>
											</ul>
										</div> --}}
										<div id="comment" class="tabs comment-area {{ $active}}">
											{{-- <h3 class="comments-title">1 Comment</h3> --}}
											@if(Auth::check())
											<div id="respond" class="comment-respond">
												<h3 id="reply-title" class="comment-reply-title">Leave A Comment?</h3>
												@php
												$projectId = $data['project']['project_id'];
												@endphp
												<form action="{{ url('comments').'/'.$projectId }}" id="commentForm" method="post">
													@csrf
													<div class="field-textarea">
														<textarea name="comment" rows="2" placeholder="Your Comment..." required=""></textarea>
													</div>
													{{-- <div class="row">
														<div class="col-md-4 field">
															<input type="text" value="" name="s" placeholder="Your Name" />
														</div>
														<div class="col-md-4 field">
															<input type="text" value="" name="s" placeholder="Your Email" />
														</div>
														<div class="col-md-4 field">
															<input type="text" value="" name="s" placeholder="Website" />
														</div>
													</div> --}}
													<button type="submit" value="Send Messager" class="btn-primary">Post Comment</button>
												</form>
											</div>
											@endif
											<ol class="comments-list" style="margin-top: 100px;">
												
												@foreach($data['comments'] as $comment)
												<li class="comment clearfix">
													<div class="comment-body">
														<div class="comment-avatar">
															<img src="{{ asset('uploads').'/'.$comment['user']['profile_image'] }}" class="rounded"
														style="height: 80px;border-radius:50% !important"></div>
														<div class="comment-info">
														<header class="comment-meta"></header>
														<cite class="comment-author">{{ $comment->user->name }}</cite>
														<div class="comment-inline">
															<span class="comment-date">{{ $comment->created_at }}</span>
															{{-- <a href="#" class="comment-reply">Reply</a> --}}
														</div>
														<div class="comment-content"><p>{{ $comment['comment'] }}</p></div>
													</div>
												</div>
											</li>
											@endforeach
											
										</ol>
										<div id="respond" class="comment-respond">
											{{-- {{ $data['project'] }} --}}
											@php
											$projectId = $data['project']->project_id;
											@endphp
											@if(count($data['comments']))
											<a href="{{ url('projects/').'/'.$projectId.'/comments' }}">
												<button class="btn-primary">
												All Review</button>
											</a>
											@endif
											
										</div>
									</div>
								</div>
								</div><!-- .main-content -->
								{{-- <div class="col-lg-4">
									<div class="support support-campaign">
										<h3 class="support-campaign-title">Back this Campaign</h3>
										<div class="plan">
											<a href="javascript:void(0)">
												<h4>Pledge $100 - $200</h4>
												<div class="plan-desc"><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master builder of human happiness.</p></div>
												<div class="plan-date">May, 2017</div>
												<div class="plan-author">Estimated Delivery</div>
												<div class="backer">2 backer</div>
											</a>
										</div>
										<div class="plan">
											<a href="javascript:void(0)">
												<h4>Pledge $200 - $300</h4>
												<div class="plan-desc"><p>No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself</p></div>
												<div class="plan-date">May, 2017</div>
												<div class="plan-author">Estimated Delivery</div>
												<div class="backer">35 backer</div>
											</a>
										</div>
									</div>
									</div> --}}<!-- .sidebar -->
								</div>
							</div>
							</div><!-- .campaign-history -->
							
							@endsection
							@section('bottom-script')
							<script type="text/javascript">
								$('body').addClass('campaign-detail');
								$('#pledgeNow').click(function(e){
									swal({
								title: "Are you sure?",
								text: "You want to donate!",
								type: "warning",
								showCancelButton: true,
								confirmButtonColor: "#DD6B55",
								confirmButtonText: "Yes!",
								cancelButtonText: "No!",
								closeOnConfirm: false,
								closeOnCancel: false
								}, function(isConfirm) {
								if (isConfirm) {
								$('#priceForm').submit();
								// swal("Deleted!", "Your imaginary file has been deleted.", "success");
								} else {
								swal.close();
								// swal("Cancelled", "Your imaginary file is safe :)", "error");
								}
								});
								});
								$(document).ready(function(){
									@guest
									@if($errors->any())
										$('#signInModal').modal('show');
									@endif
									@endguest
									@if(session('success'))
									swal ( "Done" ,  "Thanx for donation!" ,  "success" );
									@endif
									@if(session('fail'))
									swal ( "Ooops" ,  "{{ session('fail') }}" ,  "error" );
									@endif
								});
							</script>
							@endsection