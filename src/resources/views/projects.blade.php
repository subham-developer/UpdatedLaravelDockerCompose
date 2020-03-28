<?php	
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
?>

@extends('web_master')
@section('body')

<div class="container">
	<h1>Discover projects</h1>
	<div class="breadcrumbs" style="display: inline-flex; margin-bottom: 25px;">

		<a href="{{ url('/') }}">Home</a><span>&nbsp;/&nbsp;</span>
		Layout

	</div><!-- .breadcrumbs -->
</div>

{{-- <div class="campaigns-action clearfix">
	<div class="container">
		<div class="sort">
			<span>Sort by:</span>
			<ul>
				<li class="active"><a href="#">Recent Project</a></li>
				<li><a href="#">Most Project</a></li>
			</ul>
		</div><!-- .sort -->
		<div class="filter">
			<span>Filter by:</span>
			<form action="#">
				<div class="field-select">
					<select name="s">
						<option value="">All Stages</option>
						<option value="">Pending</option>
						<option value="">Cancel</option>
						<option value="">Completed</option>
					</select>
				</div>
				<div class="field-select">
					<select name="s">
						<option value="">All Category</option>
						<option value="">Design & Art</option>
						<option value="">Book</option>
						<option value="">Perfomances</option>
						<option value="">Technology</option>
					</select>
				</div>
			</form>
		</div><!-- .filter -->
	</div>
</div> --}}<!-- .campaigns-action -->
<div class="campaigns">
	<div class="container">
		<div class="campaign-content">
			<div class="row">

				<div class="col-lg-12">
					<div class="campaign-big-item clearfix">
						@if(isset($data['maxFunded']) )
						@php
						// $maxIntervalId = Hashids::encode($data['maxFunded']->id);
						$maxIntervalId = $data['maxFunded']->id;

						$query = DB::table('project_intervals')->where('id', $maxIntervalId)->get();
						$project_id = $query[0]->project_id;
						$slug_query = DB::table('projects')->where('id', $project_id)->get();
						$slug = $slug_query[0]->slug;

						@endphp
						<a href="{{ url('projects/'.$slug) }}" class="campaign-big-image">
							<img src="{{ asset('uploads').'/'.$data['maxFunded']->project->image[0]->name }}" alt="" style="max-width: 570px"></a>
							<div class="campaign-big-box">
								{{-- <a href="#" class="category">Design & Art</a> --}}
								<h3>
									<a href="{{ url('projects/'.$slug) }}">{{ $data['maxFunded']->title }}</a></h3>
									<div class="campaign-description">{{ $data['maxFunded']->description }}</div>
									<div class="campaign-author clearfix">
										<div class="author-profile">
											<a class="author-icon" >
												@if(isset($data['maxFunded']->project->user->profile_image))
												<img src="{{ asset('uploads').'/'.$data['maxFunded']->project->user->profile_image }}" alt="" style="width: 50px; height: 50px; border-radius: 50%; display: inline-block;">
												@else
												<img src="{{ asset('images').'/'.'one-inr.png' }}" alt="">
												@endif
											</a>
											by
											{{-- <a class="author-name" href="#"> --}}
												{{ $data['maxFunded']->project->user->name }}
											{{-- </a> --}}
										</div>
										{{-- <div class="author-address"><span class="ion-location"></span>Melbourne, Victoria, AU</div> --}}
									</div>
									<div class="process">

										<div class="raised">
											<span style="width: {{ $data['maxFunded']->completed }}%"></span>
										</div>
										<div class="row">
											<div class="col-4 text-center">
												<i class="fa fa-inr" aria-hidden="true"></i>
												<b>{{ $data['maxFunded']->project->target }}</b>
												<br>Goal
											</div>
											<div class="col-4 text-center">
												<i class="fa fa-inr" aria-hidden="true"></i>
												<b>{{ $data['maxFunded']->funded }}</b>
												<br>Funded
											</div>
											<div class="col-4 text-center">
												<b>{{ $data['maxFunded']->days_left }}</b>
												<br>Days Left
											</div>
										</div>

									</div>
								</div>
								@endif
							</div>
						</div>

						<div class="col-lg-12">
						</div>
						@foreach($data['projects'] as $key => $project)
						@php

						// $intervalId = Hashids::encode($project->id);
						$intervalId = $project->id;
						$query = DB::table('project_intervals')->where('id', $intervalId)->get();
						$project_id = $query[0]->project_id;
						$slug_query = DB::table('projects')->where('id', $project_id)->get();
						$slug = $slug_query[0]->slug;

						if(!empty($project->project->image) && isset($project->project->image) && !is_null($project->project->image) && $project->project->image != ''){	
						$cover_img = collect($project->project->image)->where('image_type','cover')->first();
						if($cover_img){
						$cover_img = $cover_img->toArray();
					}else{
					$cover_img_name = $project->project->image[0]->name;
				}

				if(isset($cover_img['name'])){
				$cover_img_name = $cover_img['name'];
			}else{
			$cover_img_name = $project->project->image[0]->name;
		}
	}else{
	$cover_img_name = $project->project->image[0]->name;
}


@endphp
<div class="col-lg-4 col-sm-6 col-6">
	{{-- {{ $project }} --}}
	<div class="campaign-item">
		<a class="overlay" href="{{ url('projects/'.$slug) }}" style="height: 180px">
			{{-- <img src="images/placeholder/370x240.png" alt=""> --}}
			<img src="{{ asset('uploads').'/'.$cover_img_name }}"
			style="object-fit: cover;height: 100%"
			>
			{{-- <span class="ion-ios-search-strong"></span> --}}
		</a>
		<div class="campaign-box">
			{{-- <a href="#" class="category">Crafts</a> --}}
			<h3>
				<a href="{{ url('projects/'.$slug) }}">{{ $project['title'] }}</a>
			</h3>
			<div class="campaign-description" style="max-height:67px">{{ $project['description'] }}</div>
			<div class="campaign-author">
				{{-- <a class="author-icon" href="#"> --}}
					{{-- <img src="{{ asset('uploads').'/'.$project->user['profile_image'] }}" height="30"> --}}
				{{-- </a> --}}
				{{-- <a class="author-name" href="#"> --}}
					By {{ $project->project->user->name }}
				{{-- </a> --}}
			</div>
			<div class="process">
				{{-- @php
					$completed = $project['funded'] / $project['target'] * 100;
					@endphp --}}
					<div class="raised"><span style="width: {{ $project['completed'] }}%"></span></div>
					<div class="process-info">
						<div class="row" style="margin-top: 20px;width:100%">
							<div class="col-4 text-center" style="font-size: 14px">
								<i class="fa fa-inr" aria-hidden="true"></i>
								<b>{{ $project['target'] }}</b>
								<br>
								Goal
							</div>
							<div class="col-4 text-center" style="font-size: 14px">
								<i class="fa fa-inr" aria-hidden="true"></i>
								<b>{{ $project['funded'] }}<br></b>
								Funded
							</div>
							<div class="col-4 text-center" style="font-size: 14px">
								<b>{{ $project['days_left'] }}<br></b>
								Days Left
							</div>
						</div>
						{{-- <div class="row">
							<div class="process-pledged col-md-4">
								<span style="margin-right: 0px !important">
									<i class="fa fa-inr" aria-hidden="true"></i>
								{{ $project['target'] }}</span>Goal
							</div>
							<div class="process-funded col-md-4"><span>{{ $project['funded'] }}</span>Funded</div>
							<div class="process-time col-md-4"><span>
							{{ $project['days_left'] }}</span>Days Left</div>
						</div> --}}
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach

</div>
</div>
<div class="latest-button">
	{{ $data['projects']->links() }}
	{{-- <a href="#" class="btn-primary">Load more</a> --}}
</div>
</div>
</div><!-- .latest -->
@endsection