<?php	
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

$image_name = '';
$home_project_name = '';
$home_project_desc = '';
$home_project_completed = '';
$home_project_target = '';
$home_project_funded = '';
$home_project_days_left = '';
$home_project_encodeId = '';

if(isset($data['project_1']) && (int) $data['project_1']['project']['display_on_home_status'] == 1) {
	$home_project_name = $data['project_1']['project']['title'];
	$home_project_desc = $data['project_1']['project']['description'];
	$home_project_completed = $data['project_1']['completed'];
	$home_project_target = $data['project_1']['project']['target'];
	$home_project_funded = $data['project_1']['funded'];
	$home_project_days_left = $data['project_1']['days_left'];
	$home_project_encodeId = $data['project_1']['encodeId'];

	$i=0;
	for($i=0; $i< count($data['project_1']['project']['image']); $i++){
		if($data['project_1']['project']['image'][$i]['image_type']=="feature") {
			$image_name = $data['project_1']['project']['image'][$i]['name'];		
		}
	}
}
?>

@extends('web_master')
@section('css')
<style type="text/css">
	.site-main .sideshow{
		/*background: url('uploads/{{ $image_name }}');*/
		background: url('uploads/{{ $image_name }}');
		background-size: cover;
	}
</style>
@endsection
@section('body')


<div class="sideshow">
	<div class="container">
		<div class="sideshow-content">
			{{-- {{ $data['project_1']}} --}}
			@if(isset($data['project_1']))
			<h1 class="wow fadeInUp" data-wow-delay=".1s">{{ $home_project_name}}</h1>
			<div class="sideshow-description wow fadeInUp" data-wow-delay=".1s">
				{{ $home_project_desc}}
			</div>
			<div class="process wow fadeInUp" data-scroll-nav="1">
				<div class="raised"><span style="width: {{$home_project_completed}}%"></span></div>
				<div class="process-info">
					<div class="process-pledged"><span><i class="fa fa-inr" aria-hidden="true"></i>
					{{$home_project_target}}</span>Goal</div>
					<div class="process-funded"><span>
						<i class="fa fa-inr" aria-hidden="true"></i>
					{{ $home_project_funded }}</span>funded</div>
					{{-- <div class="process-backers"><span>32</span>backers</div> --}}
					<div class="process-time"><span>{{ $home_project_days_left }}</span>Days Left</div>
				</div>
			</div>

			<div class="button wow fadeInUp" data-wow-delay="0.1s">
				<a href="projects/{{ $home_project_encodeId}}" class="btn-secondary">See Campaign</a>
				{{-- <a href="#" class="btn-primary"></a> --}}
			</div>
			@endif
		</div><!-- .sideshow-content -->
	</div>
</div><!-- .sideshow -->

				<!-- <div class="how-it-work">
					<div class="container">
						<h2 class="title">See How It Works</h2>
						<div class="description">The sole motive of 1INR is to have a certain amount of money deducted for donations towards your chosen campaign, starting from just 1 Rupee a day!</div>
						<div class="row">
							<div class="col-lg-4">
								<div class="item-work">
									<div class="item-icon"><span>01</span><i class="fa fa-flask" aria-hidden="true"></i></div>
									<div class="item-content">
										<h3 class="item-title">Select The Cause!</h3>
										<div class="item-desc"><p>1INR have multiple campaigns for the poor and needy people. You can select any campaign to your liking that you can donate to.</p></div>
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="item-work">
									<div class="item-icon"><span>02</span><i class="fa fa-leaf" aria-hidden="true"></i></div>
									<div class="item-content">
										<h3 class="item-title">Choose Your Donation plan</h3>
										<div class="item-desc"><p>The sole motive of 1INR is to have a certain amount of money deducted for donations towards your selected charity project. This amount can be as low as Rs 1 and as high as you wish it to be.</p></div>
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="item-work">
									<div class="item-icon"><span>03</span><i class="fa fa-money" aria-hidden="true"></i></div>
									<div class="item-content">
										<h3 class="item-title">Smile Please! </h3>
										<div class="item-desc"><p>In this step you set up for making automatic payments. The set amount will be deducted from your <u>wallet</u> or your <u> bank account</u>. Enjoy and thank you for bringing a smile on the face of the needy.</p></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> -->
				<div class="text-center mt-5">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<h2 class="title">THE 1 INR PROMISE</h2>
								<p>Our vision is to change the lives of the ones who are in need and we are actively working on to meet this goal. You can donate as low as 1INR per day. Your per day 1 rupee benefits in 2 ways: Firstly, it runs the house of one person and secondly helps the one who needs it.</p>
							</div>
						</div>
					</div>
				</div>
				<div class=" mt-5">
					<h2 class="title">HOW IT WORKS</h2>
					<div class="container">
						<div class="row text-center">
							<div class="col-lg-3 col-md-6 col-sm-12">
								<div class="step_1 steps">
									<h4>Select The Cause!</h4>
									<p>1INR supports multiple causes that help to bring light in the lives of the needy. Consider a noble cause, donate and share your happiness with them!</p>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 col-sm-12">
								<div class="step_2 steps">
									<h4>Support Their Living</h4>
									<p>1INR helps you in becoming a ray of hope for the ones who are in need to run their house. You can choose a cause that you wish to support and join.</p>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 col-sm-12">
								<div class="step_3 steps">
									<h4>Help A Need</h4>
									<p>Making sure the needy one survives every day, gives you pleasure and makes you happier bringing a positive & uplifting effect on you.</p>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 col-sm-12">
								<div class="step_4 steps">
									<h4>Share Happiness</h4>
									<p>Surprise them from time to time with 1INR that would be the reason for them to survive and gift a new life. Thank you for sharing the happiness!  </p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- .how-it-work -->
				<div class="latest campaign">
					<div class="container">
						<h2 class="title">Discover Campaigns</h2>
						<br>
						{{-- <div class="campaign-tabs filter-theme">
							<button class="button is-checked" data-filter=".filterinteresting">Interesting</button>
							<button class="button" data-filter=".filtersuccessful">Successful</button>
							<button class="button" data-filter=".filterpopular">Popular</button>
							<button class="button" data-filter=".filterlatest">Latest</button>
						</div> --}}
						<div class="campaign-content grid">
							<div class="row">
								@foreach($data['intervals'] as $key => $interval)
								@php
								
								$intervalId = $interval->id;
								$cover_img_name = '';
								$query = DB::table('project_intervals')->where('id', $intervalId)->get();
								$project_id = $query[0]->project_id;
								$slug_query = DB::table('projects')->where('id', $project_id)->get();
								$slug = $slug_query[0]->slug;

								if(isset($interval->project->image) ){
								$cover_img = collect($interval->project->image)->where('image_type','cover')->first();

								$cover_img = (array)$cover_img;
								
								if(isset($cover_img['name'])){
								$cover_img_name = $cover_img['name'];
							}else{
							$cover_img_name = $interval->project->image[0]->name;
						}
					}else{
					$cover_img_name = $interval->project->image[0]->name;
				}

				@endphp

				<div class="col-lg-4 col-md-6 col-sm-6 col-6 filterinteresting filterpopular filterlatest">

					<div class="campaign-item">
						<a class="overlay" href="{{ url('projects/'.$slug) }}" style="height: 180px;">

							<img src="{{ asset('uploads').'/'.$cover_img_name }}" alt=""
							style="height: 100%;object-fit: cover;">

						</a>
						<div class="campaign-box">
							{{-- <a href="#" class="category">Crafts</a> --}}
							<h3><a href="{{ url('projects/'.$slug) }}">{{ $interval->title }}</a></h3>
							<div class="campaign-description">{{ $interval->description }}</div>
							<div class="campaign-author">
								{{-- <a class="author-icon" href="#">
									<img src="" alt="">
								</a> --}}
								By {{ $interval->project->user->name }}
								{{-- <a class="author-name" href="#"></a> --}}
							</div>
							<div class="process">
								<div class="raised"><span style="width:{{ $interval->completed }}%"></span></div>
								<div class="row">
									<div class="col-4 text-center">
										<b><i class="fa fa-inr" aria-hidden="true"></i>
											{{ $interval->project->target}}</b>
											<br>Goal
										</div>
										<div class="col-4 text-center">
											<b><i class="fa fa-inr" aria-hidden="true"></i>
												{{ $interval->funded }}</b>
												<br>Funded
											</div>
											<div class="col-4 text-center">
												<b>{{ $interval->days_left }}</b>
												<br>Days Left
											</div>
										</div>
										{{-- <div class="process-info">
											<div class="process-pledged col-md-4"><span style="margin-right: 0px !important">
												<i class="fa fa-inr" aria-hidden="true"></i>
												{{ $interval->project->target}}</span>Goal</div>
												<div class="process-funded col-md-4">
													<span style="margin-right: 0px !important">
														<i class="fa fa-inr" aria-hidden="true"></i>
														{{ $interval->funded }}</span>Funded</div>
														<div class="process-time col-md-4">
															<span>{{ $interval->days_left }}</span>Days Left</div>
														</div> --}}
													</div>
												</div>
											</div>
										</div>
										@endforeach
										{{-- <div class="col-lg-4 col-md-6 col-sm-6 col-6 filterinteresting filterlatest">
											<div class="campaign-item">
												<a class="overlay" href="campaign_detail.html">
													<img src="images/placeholder/370x240.png" alt="">
													<span class="ion-ios-search-strong"></span>
												</a>
												<div class="campaign-box">
													<a href="#" class="category">Book</a>
													<h3><a href="campaign_detail.html">The Everlast Notebook</a></h3>
													<div class="campaign-description">One smart, reusable notebook to last the rest of your life? That's not magic, that's the Everlast.</div>
													<div class="campaign-author"><a class="author-icon" href="#"><img src="images/placeholder/35x35.png" alt=""></a>by <a class="author-name" href="#">Samino</a></div>
													<div class="process">
														<div class="raised"><span></span></div>
														<div class="process-info">
															<div class="process-pledged"><span>$370</span>pledged</div>
															<div class="process-funded"><span>9%</span>funded</div>
															<div class="process-time"><span>9</span>days ago</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-4 col-md-6 col-sm-6 col-6 filterinteresting filterpopular">
											<div class="campaign-item">
												<a class="overlay" href="campaign_detail.html">
													<img src="images/placeholder/370x240.png" alt="">
													<span class="ion-ios-search-strong"></span>
												</a>
												<div class="campaign-box">
													<a href="#" class="category">Perfomances</a>
													<h3><a href="campaign_detail.html">Uncompromising Ski Gear</a></h3>
													<div class="campaign-description">The Orsden Slope Pants don't compromise delivering performance, fit, and value directly to you</div>
													<div class="campaign-author"><a class="author-icon" href="#"><img src="images/placeholder/35x35.png" alt=""></a>by <a class="author-name" href="#">Andrew Noah</a></div>
													<div class="process">
														<div class="raised"><span></span></div>
														<div class="process-info">
															<div class="process-pledged"><span>$610</span>pledged</div>
															<div class="process-funded"><span>73%</span>funded</div>
															<div class="process-time"><span>14</span>days ago</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-4 col-md-6 col-sm-6 col-6 filterinteresting filterlatest">
											<div class="campaign-item">
												<a class="overlay" href="campaign_detail.html">
													<img src="images/placeholder/370x240.png" alt="">
													<span class="ion-ios-search-strong"></span>
												</a>
												<div class="campaign-box">
													<a href="#" class="category">Technology</a>
													<h3><a href="campaign_detail.html">Smart Wallet with Solar Charge</a></h3>
													<div class="campaign-description">A wonderful serenity has taken possession of my entire soul, like these sweet mornings.</div>
													<div class="campaign-author"><a class="author-icon" href="#"><img src="images/placeholder/35x35.png" alt=""></a>by <a class="author-name" href="#">Andrew Noah</a></div>
													<div class="process">
														<div class="raised"><span></span></div>
														<div class="process-info">
															<div class="process-pledged"><span>$3670</span>pledged</div>
															<div class="process-funded"><span>58%</span>funded</div>
															<div class="process-time"><span>21</span>days ago</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-4 col-md-6 col-sm-6 col-6 filterinteresting">
											<div class="campaign-item">
												<a class="overlay" href="campaign_detail.html">
													<img src="images/placeholder/370x240.png" alt="">
													<span class="ion-ios-search-strong"></span>
												</a>
												<div class="campaign-box">
													<a href="#" class="category">Technology</a>
													<h3><a href="campaign_detail.html">Redefine Your VR Experience</a></h3>
													<div class="campaign-description">I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot.</div>
													<div class="campaign-author"><a class="author-icon" href="#"><img src="images/placeholder/35x35.png" alt=""></a>by <a class="author-name" href="#">Sabato Alterio</a></div>
													<div class="process">
														<div class="raised"><span></span></div>
														<div class="process-info">
															<div class="process-pledged"><span>$1950</span>pledged</div>
															<div class="process-funded"><span>70%</span>funded</div>
															<div class="process-time"><span>23</span>days ago</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-4 col-md-6 col-sm-6 col-6 filterinteresting filterpopular">
											<div class="campaign-item">
												<a class="overlay" href="campaign_detail.html">
													<img src="images/placeholder/370x240.png" alt="">
													<span class="ion-ios-search-strong"></span>
												</a>
												<div class="campaign-box">
													<a href="#" class="category">Design &amp; Art</a>
													<h3><a href="campaign_detail.html">Bring back Fun House</a></h3>
													<div class="campaign-description">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</div>
													<div class="campaign-author"><a class="author-icon" href="#"><img src="images/placeholder/35x35.png" alt=""></a>by <a class="author-name" href="#">Samino</a></div>
													<div class="process">
														<div class="raised"><span></span></div>
														<div class="process-info">
															<div class="process-pledged"><span>$3900</span>pledged</div>
															<div class="process-funded"><span>69%</span>funded</div>
															<div class="process-time"><span>33</span>days ago</div>
														</div>
													</div>
												</div>
											</div>
										</div> --}}
									</div>
								</div>
								<div class="latest-button"><a href="{{ url('projects') }}" class="btn-primary">View all Campaigns</a></div>
							</div>
						</div><!-- .latest -->
						{{-- <div class="blognews">
							<div class="container">
								<h2 class="title">From the Journal</h2>
								<div class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</div>
								<div class="blognews-content">
									<div class="row">
										<div class="col-lg-4">
											<article class="post">
												<div class="blognews-thumb">
													<a class="overlay" href="blog_details.html">
														<img src="images/placeholder/370x240.png" alt="">
														<span class="ion-ios-search-strong"></span>
													</a>
												</div>
												<div class="blognews-info">
													<a href="#" class="blognews-cat">Tips & Insights</a>
													<h3 class="blognews-title"><a href="#">Create gallery post types as well</a></h3>
													<div class="blognews-content"><p>Always strive for better work. Never stop learning. Have fun a clear plan for a new project or just an idea on a napkin?</p></div>
												</div>
											</article>
										</div>
										<div class="col-lg-4">
											<article class="post">
												<div class="blognews-thumb">
													<a class="overlay" href="blog_details.html">
														<img src="images/placeholder/370x240.png" alt="">
														<span class="ion-ios-search-strong"></span>
													</a>
												</div>
												<div class="blognews-info">
													<a href="#" class="blognews-cat">Case Studies</a>
													<h3 class="blognews-title"><a href="#">Win a Set of TouchPoints Basic</a></h3>
													<div class="blognews-content"><p>TouchPoints are neuroscientific wearables that are worn on either side of the body for 15 minutes to reduce stress and anxiety.</p></div>
												</div>
											</article>
										</div>
										<div class="col-lg-4">
											<article class="post">
												<div class="blognews-thumb">
													<a class="overlay" href="blog_details.html">
														<img src="images/placeholder/370x240.png" alt="">
														<span class="ion-ios-search-strong"></span>
													</a>
												</div>
												<div class="blognews-info">
													<a href="#" class="blognews-cat">Products</a>
													<h3 class="blognews-title"><a href="#">This Smart Eye Mask Could Be The Answer</a></h3>
													<div class="blognews-content"><p>Waking up is hard to do. That’s why this company is making sleep a priority by giving the classic face mask an upgrade.</p></div>
												</div>
											</article>
										</div>
									</div>
								</div>
							</div>
						</div> --}}<!-- .story -->
						{{-- <div class="partners">
							<div class="container">
								<div class="partners-slider owl-carousel">
									<div><a href="#"><img src="images/partner-01.png" alt=""></a></div>
									<div><a href="#"><img src="images/partner-02.png" alt=""></a></div>
									<div><a href="#"><img src="images/partner-03.png" alt=""></a></div>
									<div><a href="#"><img src="images/partner-04.png" alt=""></a></div>
									<div><a href="#"><img src="images/partner-05.png" alt=""></a></div>
									<div><a href="#"><img src="images/partner-06.png" alt=""></a></div>
								</div>
							</div>
						</div> --}}<!-- .partners -->

						@endsection
						@section('bottom-script')
						<script type="text/javascript">

							$('body').addClass('home');
							@if(session('registered'))
							swal ("Done" ,  "Registered Successfully!" ,  "success" );
												// alert('Registered Successfully!');
												@endif
											</script>
											@endsection