@extends('web_master')
@section('body')

	<div class="container">
		<h1>Enquiry</h1>
		<div class="breadcrumbs" style="display: inline-flex; margin-bottom: 25px;">
			
				<a href="{{ url('/') }}">Home</a><span>&nbsp;/&nbsp;</span>
				Enquiry
			
			</div><!-- .breadcrumbs -->
		</div>
	
	<div class="container">
		<div class="row">
			<div class="col-lg-6">

				@if ($errors->any())
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
				{!! Form::open(['url'=>'ngo-enquiry']) !!}

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>NGO Name:</label>
								{{-- <input type="text" class="form-control"> --}}
								{!! Form::text('ngo_name', null, ['class'=>'form-control','required']) !!}
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Your Name:</label>
								{{-- <input type="text" class="form-control"> --}}
								{!! Form::text('contact_name', null, ['class'=>'form-control','required']) !!}

							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Phone:</label>
								{{-- <input type="text" class="form-control"> --}}
								{!! Form::tel('phone', null, ['class'=>'form-control','maxlength'=>10,'required']) !!}

							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Email:</label>
								{{-- <input type="text" class="form-control"> --}}
								{!! Form::email('email', null, ['class'=>'form-control','required']) !!}

							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>NGO Purposes:</label>
								{{-- <input type="text" class="form-control"> --}}
								{!! Form::text('purposes', null, ['class'=>'form-control','required']) !!}

							</div>
						</div>
						
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="address">NGO Address:</label>
								{{-- <textarea class="form-control" id="address" rows="3"></textarea> --}}
								{!! Form::textarea('address', null, ['class'=>'form-control','rows'=>3,'required' ]) !!}
							</div>
						</div>
						
					</div>
					
					
					
					
					
					<button type="submit" class="btn btn-primary">Submit</button>
				{!! Form::close() !!}
			</div>
			<div class="col-lg-6">
				
			</div>
		</div>
	</div>
	@endsection