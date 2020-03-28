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
							
							@forelse($data['projects'] as $project)
							@php
								// dd($project->project->user->name);
								// $intervalId = Hashids::encode($project->id);
							$intervalId = $project->id;
								$query = DB::table('project_intervals')->where('id', $intervalId)->get();
						        $project_id = $query[0]->project_id;
						        $slug_query = DB::table('projects')->where('id', $project_id)->get();
						        $slug = $slug_query[0]->slug;
						        
							@endphp
							<div class="col-lg-4 col-sm-6 col-6">
								{{-- {{ $project }} --}}
								<div class="campaign-item">
									<a class="overlay" href="{{ url('projects/'.$slug) }}" style="height: 180px">
										{{-- <img src="images/placeholder/370x240.png" alt=""> --}}
										<img src="{{ asset('uploads').'/'.$project->project->image[0]->name }}"
										style="object-fit: cover;height: 100%">
										<span class="ion-ios-search-strong"></span>
									</a>
									<div class="campaign-box">
										{{-- <a href="#" class="category">Crafts</a> --}}
										<h3><a href="{{ url('projects/'.$slug) }}">{{ $project->title }}</a></h3>
										<div class="campaign-description">{{ $project->description }}</div>
										<div class="campaign-author">
											<a class="author-icon">
											{{-- <img src="{{ asset('uploads').'/'.$project->project->user->profile_image }}" alt=""> --}}

											@if(isset($project->project->user->profile_image))
												<img src="{{ asset('uploads').'/'.$project->project->user->profile_image }}" alt="">
											@else
												<img src="{{ asset('images').'/'.'one-inr.png' }}" alt="">
											@endif


										</a>by
											{{-- <a class="author-name" href="#"> --}}
											{{ $project->project->user->name }}
											{{-- </a> --}}
										</div>
										<div class="process">
											{{-- @php
											$completed = $project['funded'] / $project['target'] * 100;
											@endphp --}}
											<div class="raised"><span style="width: {{ $project->completed }}%"></span></div>
											<div class="process-info">
												<div class="process-pledged"><span>{{ $project->target }}</span>Goal</div>
												<div class="process-funded"><span>{{ $project->funded }}</span>Funded</div>
												<div class="process-time"><span>
													{{ $project->days_left }}</span>Days Left</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							@empty
							<div class="col-lg-12">
							<h3 class="text-center">No Project Found</h3>
							</div>
							@endforelse
							
						</div>
					</div>
					<div class="latest-button">
						{{ $data['projects']->links() }}
						{{-- <a href="#" class="btn-primary">Load more</a> --}}
					</div>
				</div>
			</div><!-- .latest -->

@endsection